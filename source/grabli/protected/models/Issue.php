<?php


class Issue extends CActiveRecord
{
	/**
	 *
	 *
	 * @var string
	 */
	private $primaryKey = 'id';

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'bugs';
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
    	$number = 1;
    	
    	$criteria = new CDbCriteria();
    	$criteria->select = array ('MAX(number) as number');
    	$criteria->addCondition('project_id = :pid');
    	$criteria->params = array (':pid' => $projectId);
    	$criteria->order = 'number DESC';
    	
    	$bug = Issue::model()->find($criteria);
    	
    	if ($bug != null) $number = $bug->number + 1;
    
    	return $number;
    }

	/**
	 * Получаем бар по коду проекта и номеру
	 *
	 * @param $project_id
	 * @param $number
	 * @return array|CActiveRecord|mixed|null
	 */
	public static function getBugByProjectAndnumber ($project_id, $number)
    {
    	$criteria = new CDbCriteria();
    	$criteria->addCondition('project_id = :pid');
    	$criteria->addCondition("number = :number");
    	$criteria->params = array (':pid' => $project_id, ':number' => $number);
    	 
    	return Issue::model()->find($criteria);
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

	/**
	 * получаем родительское задание
	 *
	 */
	public function getParent ()
	{
		if ($this->parent_id == 0) return null;

		return Issue::model()->findByPk($this->parent_id);
	}

	/**
	 * Дочерние таски
	 *
	 * @return array|CActiveRecord|mixed|null
	 */
	public function getChildrens ()
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition('parent_id = :parent');
		$criteria->params = array (':parent' => $this->id);
		$criteria->order = "number asc";

		return Issue::model()->findAll($criteria);
	}


    public function updateByAddModel ($model) 
    {
   		$this->steps_id 	= $model->step_id;
		$this->project_id	= $model->project_id;
		
		if ($this->assigned_to == 0) $this->assigned_to = null;
		else $this->assigned_to	= $model->assigned_to;
		
		$this->owner_id		= $model->owner_id;

		if ($model->parent_id == 0) $this->parent_id = null;
		else $this->parent_id	= $model->parent_id;
		
		$this->title		= $model->title;
		$this->type			= $model->type;
		$this->description	= $model->description;
		$this->rep_steps	= $model->rep_steps;
		
		$this->number		= $model->number;

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

		// обновляем последнюю активность
		$this->updateLastActivity();
    	
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

		// обновляем последнюю активность
		$this->updateLastActivity();
    }

	/**
	 * Обновляем счетчик последней активности
	 *
	 */
	public function updateLastActivity () {
		$this->last_activity = time();
		$this->save ();
	}

}
