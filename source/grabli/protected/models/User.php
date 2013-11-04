<?php


class User extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'user';
    }
    
    public function getPrimaryKey() {
    	$pk = parent::getPrimaryKey();
    	return 'id';
    }
    
    public function findByPk($pk, $condirion = '', $params = '') 
    {
    	$criteria = new CDbCriteria();
    	$criteria->addCondition("id = :id");
    	$criteria->params = array (':id' => $pk);

    	return User::model()->find ($criteria);
    }
    
    /**
     *
     *
     * @param unknown_type $email
     * @return User
     */
    public static function getByEmail ($email)
    {
    	$crit = new CDbCriteria();
    
    	$crit->addCondition("email = :email");
    	$crit->params = array (':email' => $email);
    
    	return User::model()->find($crit);
    }

	/**
	 * Поиск по строке
	 *
	 * @param $searchString
	 * @return array|CActiveRecord|mixed|null
	 */
	public static function search ($searchString)
    {
    	$crit = new CDbCriteria();
    	
    	$crit->addCondition("email LIKE (:search) OR name LIKE (:search) ");
    	$crit->params = array (':search' => '%'.$searchString.'%');
    	
    	return User::model()->findAll($crit);    	
    }

	/**
	 * Создаем учетную запись пользователя
	 * по данным модели
	 *
	 * @param RegistrationForm $model
	 */
	public static function addUserByRegistrationModel (RegistrationForm $model)
    {
    	$u = new User();

    	$u->name			= $model->name;
    	$u->email			= $model->email;
    	$u->password 		= WebUser::hashPassword($model->password);
    	
    	$u->status 			= 'worked';
    	$u->last_activaty 	= time();

    	$u->save();
    }
    
    
    
    
    public function getAvataraUrl () 
    {
    	array ('.jpg', '.jpeg', '.gif', ',png');
    	//$path = dirname (APPPATH);
    	
    	$filename = $this->id;
    	$path = yii::getPathOfAlias('webroot.images.avatars');
  
    	$preFilePath = $path.'/'.$filename;
    	
    	$url = '/images/avatara.jpg';
    	return $url;
    	
    	return $path.'/avatara.jpg';
    	
    	die ($preFilePath);
    	//fb ('333');
    }
    
   
    public function getIcoUrl() 
    {
    	$extensions = array ('.jpg', '.jpeg', '.gif', ',png');
    	
    	$filename = $this->id.'_ico';
    	$path = yii::getPathOfAlias('webroot.images.avatars');
    	
    	$preFilePath = $path.'/'.$filename;
    	foreach ($extensions as $ext) {
    		$fillPath =  $preFilePath.$ext;
    		if (file_exists($fillPath)){
    			return '/images/avatars/'.$filename.$ext;
    		}
    	}
    	 
    	return '/images/icons/user.png';
    	
    }
    
    
    public function getBugs () 
    {
    	$criteria = new CDbCriteria();
    	$criteria->addCondition("owner_id = :userid OR assigned_to = :userid");
    	$criteria->params = array (':userid' => $this->id);
    	
    	return Bug::model()->findAll($criteria);
    }
    
    /**
     * Проекты в которых учствует пользователь
     * 
     */
    public function getProjects () 
    {
    	$projects = array ();
		
		$criteria = new CDbCriteria();
		$criteria->addCondition("user_id = :id");
		$criteria->params = array (':id' => $this->id);
		
		$projetsIds = UserHasProjects::model()->FindAll($criteria);
		
		foreach ($projetsIds as $uid) {
			$project = Project::model()->findByPk($uid->project_id);
			if ($project != null) $projects[] = $project;
		}
		
		return $projects;
    }
   
    /**
     * Получаем провекты в которых пользователь являе тся владельцем
     * 
     */
    public function getProjectByOwner ()
    {
    	$projects = array ();
		
		$criteria = new CDbCriteria();
		$criteria->addCondition("owner_id = :id");
		$criteria->params = array (':id' => $this->id);
		
		return Project::model()->findAll($criteria);
    	
    }
    
    public function getOwnedUsers () 
    {
    	$projects = array ();
    	
    	$criteria = new CDbCriteria();
    	$criteria->addCondition("owner_id = :id");
    	$criteria->params = array (':id' => $this->id);
    	
    	return User::model()->findAll($criteria);
    }
    
    
    
    public function isInProject ($projectId)
    {
    	$criteria = new CDbCriteria();
		$criteria->addCondition("user_id = :user_id");
		$criteria->addCondition('project_id = :pid');
		
		$criteria->params = array (':user_id' => $this->id, ':pid' => $projectId);
		
		$cnt = UserHasProjects::model()->count($criteria);
		if ($cnt > 0) return true;
		
		$project = Project::model()->findByPk ($projectId);
		if ($project != null) {
			if ($project->owner_id != $this->id) return true;
		}
    	
    	return false;
    }
    
    /**
     * Обновляем на основании модели
     * 
     * @param unknown_type $model
     */
    public function updateByModel ($model)
    {
    	$data = array (
    			'owner_id'		=> $model->owner_id,
    			'name'			=> $model->name,
    			'code'			=> $model->code,
    			'description'	=> $model->description
    	);
    
    	Yii::app()->db->createCommand()->update($this->tableName(), $data, 'id=:id', array(':id' => $model->id));
    
    }
    
    
    
    public function setNewPassword ($password)
    {
    	$passwordHash = WebUser::hashPassword($password);
    	$data = array (
    			'password'		=> $passwordHash
    	);
    
    	Yii::app()->db->createCommand()->update($this->tableName(), $data, 'id=:id', array(':id' => $this->id));
    
    }
    
}
