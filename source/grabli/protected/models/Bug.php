<?php


class Bug extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'bugs';
    }
    
    public function getPrimaryKey() {
    	$pk = parent::getPrimaryKey();
    	return 'id';
    }
    
    public function findByPk($pk, $condition = '', $params = '')
    {
    	$criteria = new CDbCriteria();
    	$criteria->addCondition("id = :id");
    	$criteria->params = array (':id' => $pk);
    
    	return Bug::model()->find ($criteria);
    }

	/**
	 * Получаем следующий свободный номер
	 * для бага по проекту
	 *
	 * @param $projectId
	 * @return array|int|mixed|null
	 */
	public static function getNextFreeNumberByProject ($projectId)
    {
    	$nomber = 1;
    	
    	$criteria = new CDbCriteria();
    	$criteria->select = array ('MAX(nomber) as nomber');
    	$criteria->addCondition('project_id = :pid');
    	$criteria->params = array (':pid' => $projectId);
    	$criteria->order = 'nomber DESC';
    	
    	$bug = Bug::model()->find($criteria);
    	
    	if ($bug != null) $nomber = $bug->nomber + 1;
    
    	return $nomber;
    }

	/**
	 * Получаем бар по коду проекта и номеру
	 *
	 * @param $project_id
	 * @param $nomber
	 * @return array|CActiveRecord|mixed|null
	 */
	public static function getBugByProjectAndNomber ($project_id, $nomber)
    {
    	$criteria = new CDbCriteria();
    	$criteria->addCondition('project_id = :pid');
    	$criteria->addCondition("nomber = :nomber");
    	$criteria->params = array (':pid' => $project_id, ':nomber' => $nomber);
    	 
    	return Bug::model()->find($criteria);
    }
    
    /**
     * Формируем урл иконки на основании типа 
     * 
     */
    public static function getIconUrlByBugType ($type)
    {
    	return '/images/icons/bugs/'.$type.'.png';
    }
    
    
    public function getSmallIconUrl () {
    	return self::getIconUrlByBugType($this->type);
    }
    
    
    /**
     * Проверяет можно ли установить статус
     * 
     * @param unknown_type $stepId
     */
    public function canSetStep($stepId){
    	return true;
    }
    
    
    public function getStep ()
    {
    	return Step::model()->findByPk($this->steps_id);
    }
    
    
    public function getOwner () 
    {
    	return User::model()->findByPk ($this->owner_id);	
    }
    
    public function getAssigned () 
    {
    	return User::model()->findByPk ($this->assigned_to);	
    }
    
    public function getProject () 
    {
    	if ($this->project_id == 0) return null;

    	return Project::model()->findByPK ($this->project_id);
    }
    
    public function getComments ()
    {
    	$criteria = new CDbCriteria();
    	$criteria->addCondition('bugs_id = :bug');
    	$criteria->params = array (':bug' => $this->id);
    	
    	return Comment::model()->findAll($criteria); 	
    }
    
    
    
    public function updateByAddModel ($model) 
    {
   		$this->steps_id 	= $model->step_id;
		$this->project_id	= $model->project_id;
		
		if ($this->assigned_to == 0) $this->assigned_to = null;
		else $this->assigned_to	= $model->assigned_to;
		
		$this->owner_id		= $model->owner_id;
		
		$this->title		= $model->name;
		$this->type			= $model->type;
		$this->description	= $model->description;
		$this->posled		= $model->posled;
		
		$this->nomber		= $model->nomber;
		
		$this->save();
		
		
		$this->createSystemComment (ucfirst($this->type).' created');

    	return $this;
    }
    
    public function createSystemComment ($message, $userId = null)
    {
    	if ($userId == null) {
    		$userId = yii::app()->user->getUserObject()->id;
    	}
    	
    	$c = new Comment();
    	
    	$c->user_id		= $userId;
    	$c->bugs_id		= $this->id;
    	$c->time		= time();
    	$c->type 		= 'system';
    	$c->description	= $message;
    	
    	$c->save();
    	
    }
    
    /**
     * 
     * 
     * @param unknown_type $message
     * @param unknown_type $userId
     */
    public function createUserComment ($message, $userId = null)
    {
    	if ($userId == null) {
    		$userId = yii::app()->user->getUserObject()->id;
    	}
    	 
    	$c = new Comment();
    	 
    	$c->user_id		= $userId;
    	$c->bugs_id		= $this->id;
    	$c->time		= time();
    	$c->type 		= 'user';
    	$c->description	= $message;
    	 
    	$c->save();
    	 
    }

}
