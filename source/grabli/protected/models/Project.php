<?php


class Project extends CActiveRecord
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
        return 'projects';
    }

    
    public static function findByCode ($code)
    {
    	$criteria = new CDbCriteria(); 
    	$criteria->addCondition("code = :code");
    	$criteria->params = array (":code" => $code);
    	
    	return Project::model()->find($criteria);
    }



	/**
	 * Владелец проекта
	 *
	 * @return array|CActiveRecord|mixed|null
	 */
	public function getOwner (){
    	return User::model()->findByPk($this->owner_id);
    }

	/**
	 * Может ли пользователь просматривать проект
	 *
	 * @param $userId
	 */
	public function canUserViewProject ($userId)
	{
		if ($this->owner_id == $userId){
			return true;
		}

		$users = $this->getUsers();
		foreach ($users as $u) {
			if ($u->id == $userId){
				return true;
			}
		}

		return false;
	}

	/**
	 * Количество пользователей проекта
	 *
	 * @return CDbDataReader|mixed|string
	 */
	public function usersCount () 
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition("project_id = :id");
		$criteria->params = array (':id' => $this->id);
		
		return UserHasProjects::model()->count($criteria);
	}

	/**
	 * Пользователи проекта
	 *
	 * @return array
	 */
	public function getUsers ()
	{
		$users = array ();
		
		$criteria = new CDbCriteria();
		$criteria->addCondition("project_id = :id");
		$criteria->params = array (':id' => $this->id);
		
		$userIds = UserHasProjects::model()->FindAll($criteria);
		foreach ($userIds as $uid) {
			$user = User::model()->findByPk($uid->user_id);
			if ($user != null) $users[] = $user;
		}
		
		return $users;
	}

	/**
	 * Добавляем связку польвателя в проект
	 * 
	 * @param unknown_type $uid
	 */
	public function addUser ($uid)
	{
		// 
		$user = User::model()->findByPk($uid);
		if ($user == null){
			// throw new CHttpException('User id '.$uid.' not found');
			return false;
		}
		
		// проверемяем добавлен ли пользователь
		$users = $this->getUsers();
		$found = false;
		foreach ($users as $u) {
			if ($u->id == $uid) return false;
		}
		
		// добавляем
		$l = new UserHasProjects();
		$l->project_id = $this->id;
		$l->user_id = $uid;
		$l->save();
		
		return true;
	}
	
	/**
	 * Удаляем связку с пользователем
	 *
	 * @param unknown_type $uid
	 */
	public function removeUser ($uid)
	{	
		$criteria = new CDbCriteria();
		$criteria->addCondition('project_id = :pid');
		$criteria->addCondition('user_id = :uid');
		$criteria->params = array(
			':pid'	=> $this->id, 
			':uid'	=> $uid		
		);
		
		return UserHasProjects::model()->deleteAll($criteria);
	}



	/**
	 * Получаем баги из проекта за 
	 * асайненые на пользователя
	 * 
	 * @param unknown_type $userId
	 */
	public function getActiveBugsAssignedToUser ($userId)
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition("project_id = :id");
		$criteria->addCondition("assigned_to = :userId");
		$criteria->addCondition('steps_id != :active');
		// $criteria->params = array (':id' => $this->id, ':userId' => $userId);
		$criteria->params = array (':id' => $this->id, ':active' => 6, ':userId' => $userId);
		
		return Issue::model()->findAll($criteria);
	}


	/**
	 * Получаем все баги по проекту
	 *
	 * @param CDbCriteria $criteria
	 * @return array|CActiveRecord|mixed|null
	 */
	public function getIssues (CDbCriteria $criteria = null)
	{
		if ($criteria == null){
			$criteria = new CDbCriteria();
		}

		$criteria->addCondition("project_id = :id");
		$criteria->params[':id'] = $this->id;

		return Issue::model()->findAll($criteria);
	}

	/**
	 * Количество заданий в проекте
	 *
	 * @param CDbCriteria $criteria
	 * @return int
	 */
	public function getIssuesCount (CDbCriteria $criteria = null)
	{
		if ($criteria == null){
			$criteria = new CDbCriteria();
		}

		$criteria->addCondition("project_id = :id");
		$criteria->params[':id'] = $this->id;

		return Issue::model()->count($criteria);
	}


	/**
	 * Получаем только открытые баги для проекта
	 *
	 * @return array|CActiveRecord|mixed|null
	 */
	public function getOpenIssues (CDbCriteria $criteria = null)
	{
		if ($criteria == null) {
			$criteria = new CDbCriteria();
		}

		$criteria->addCondition("project_id = :id");
		$criteria->addCondition("steps_id <> 6");
		$criteria->params[':id'] = $this->id;

		if ($criteria->order == ''){
			$criteria->order = 'last_activity DESC';
		}

		return Issue::model()->findAll($criteria);
	}

	/**
	 * Получаем количество пользователей ассициотивны для пользователя
	 *
	 * @param unknown_type $userId
	 */
	public function getOpenIssuesCount ()
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition("project_id = :id");
		// $criteria->addCondition("assigned_to = :userId");
		$criteria->addCondition('steps_id != :active');
		// $criteria->params = array (':id' => $this->id, ':userId' => $userId);
		$criteria->params = array (':id' => $this->id, ':active' => 6);

		return Issue::model()->count($criteria);
	}

	/**
	 * Количество закрытых багов
	 *
	 * @param unknown_type $userId
	 */
	public function getClosedIssuesCount ()
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition("project_id = :id");
		$criteria->addCondition('steps_id = 6');
		$criteria->params = array (':id' => $this->id);

		return Issue::model()->count($criteria);
	}


	/*
	public function insertByModel ($model)
	{	
		$this->owner_id		= $model->owner_id;
		$this->name			= $model->name;
		$this->code			= $model->code;
		$this->description	= $model->description;
	
		$this->save();
	
		return $this;
	}
	
	public function updateByModel ($model)
	{
		$data = array (		
			'owner_id'		=> $model->owner_id,
			'name'			=> $model->name,
			'code'			=> $model->code,
			'description'	=> $model->description
		);
		
		Yii::app()->db->createCommand()->update($this->tableName(), $data, 'id=:id', array(':id' => $model->id));
	
		
		return $this;
	}*/
	
}
