<?php

class ProjectsController extends Controller
{

	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('deny',
				'actions'=>array('index', 'create', 'edit', 'users', 'issues', 'view'),
				// 'roles'=>array('admin'),
				'users'=>array('?'),
			),
			/*
			array('allow',
				'actions'=>array('create', 'edit','delete'),
				'users'=>array('@'),
			),*/
		);
	}

	/**
	 * Добавляем проект
	 * 
	 */
	public function actionAdd ()
	{
		if (yii::app()->user->isGuest) {
			throw new CHttpException('403 Auth required');
		}
		
		$this->pageTitle = 'Создание нового проекта'; 
		$this->breadcrumbs['Мои проекты'] = array('/projects/');
		$this->breadcrumbs['Новый проект'] = array('/projects/add/');
		
		$model = new ProjectForm();
		$model->setScenario('create');
		$model->id = 0;
		$model->owner_id = yii::app()->user->getId();
		
		
		if (isset($_POST['ProjectForm']) && count(($_POST['ProjectForm'])) > 0) :
			$model->attributes = $_POST['ProjectForm'];
			if ($model->validate())
			{
				$item = new Project();
				$item->insertByModel ($model);	
				
				$this->redirect('/project/'.$item->code.'/');
			}
		endif;
		
		
		$data = array (
			'model' => $model
		);
		
		$this->render('create', $data);
	}
	
	

	/**
	 * Список проектов для пользователя
	 */
	public function actionIndex()
	{
		if (yii::app()->user->isGuest) {
			throw new CHttpException('403 Auth required');
		} 

		$this->pageTitle = 'User projects ';
		
		$data = array (
			'user'			=> yii::app()->user->getUserObject(), 
			'ownedUsers'	=> yii::app()->user->getUserObject()->getOwnedUsers(),
			'projects'		=> yii::app()->user->getUserObject()->getProjects(),
			'ownedProjects'	=> yii::app()->user->getUserObject()->getProjectByOwner(),
		);

		$this->render('user', $data);
	}

	/**
	 * Отображение проекта
	 *
	 * @param $code
	 * @throws CHttpException
	 */
	public function actionView ($code) 
	{
		if ($code == '') {
			throw new CHttpException('Project code not sended');
		}

		$project = Project::findByCode($code);
		
		if ($project == null) {
			throw new CHttpException('Project code "'.$code.'" not found');
		}

		if (!$project->canUserViewProject(yii::app()->user->getId())){
			throw new CHttpException(302, 'You can\'t view this project');
		}

		$this->pageTitle = $project->name;
		$this->breadcrumbs['Проект: '.$project->name] = array('/project/'.$project->code); 
		
		$this->render('view', array('project'=>$project));
	}

	/**
	 * Редактироавние проекта
	 *
	 * @param $code
	 * @throws CHttpException
	 */
	public function actionEdit ($code)
	{
		if ($code == '') {
			throw new CHttpException('Project code not sended');
		}
		
		$project = Project::findByCode($code);
		
		if ($project == null) {
			throw new CHttpException('Project code "'.$code.'" not found');
		}
		
		if ($project->owner_id != yii::app()->user->getId()) {
			throw new CHttpException('Only owner can edit project "'.$code.'"');
		}


		$this->breadcrumbs[$project->name] = array('/project/'.$project->code);
		$this->breadcrumbs['Edit'] = array('/project/'.$project->code.'/edit');
		$this->pageTitle = 'Edit: '.$project->name;


		$model = new ProjectForm();
		$model->setScenario('edit');
		
		if (isset($_POST['ProjectForm']) && count(($_POST['ProjectForm'])) > 0) {
			$model->attributes = $_POST['ProjectForm'];
			if ($model->validate()) {
				$project->updateByModel ($model);
				$this->redirect('/project/'.$model->code.'/');
			}
		}
		else {
			$model->attributes = $project->attributes;
		}
		
		$data = array (
			'model'	=> $model
		);
		
		$this->render('edit', $data);
	}

	/**
	 * Список участников проекта
	 * 
	 * @param unknown_type $code
	 * @throws CHttpException
	 */
	public function actionUsers ($code)
	{
		if (yii::app()->user->isGuest) {
			throw new CHttpException('403 Auth required');
		}
			
		$project = Project::findByCode($code);
	
		if ($project == null) {
			throw new CHttpException('404 project whitch code "'.$code.'" not found');
		}
		
		$this->actionUserCommandor($project);
	
		if ($project->owner_id != yii::app()->user->getId()) {
			throw new CHttpException('403 only owner can manage users for project "'.$code.'"');
		}
		
		$this->pageTitle = 'Участники проекта : '.$project->name;
		$this->breadcrumbs['Мои проекты'] = array('/projects/');
		$this->breadcrumbs['Проект: '.$project->name] = array('/project/'.$project->code.'/');
		$this->breadcrumbs['Участники проекта'] = array('/project/'.$project->code.'/users');
				
		$data = array (
			'project'		=> $project, 
				
		);
		
		// ищим пользователей
		$search = $data['search'] =  yii::app()->request->getParam('search', '');
		$modelAddUser = new AddUserForm();
		
		if ($search != '') :
			$modelAddUser->name = $search;
			if ($modelAddUser->validate()) {
				$data['foundUsers'] = User::search ($modelAddUser->name);
				$data['searched'] = true; 
			}
		endif;
		
		$data['modelAddUser'] = $modelAddUser;
		
		$this->render('users', $data);
	}
	
	
	protected function actionUserCommandor ($project)
	{
		$command = yii::app()->request->getParam('command', '');
		
		if ($command == 'add_users') 
		{
			$users = yii::app()->request->getParam('user', array());
			if (count($users) == 0) return;
			
			$messages = array();
			foreach ($users as $uid => $shit) {
				
				$added = $project->addUser($uid);
				if ($added) {
					$user = User::model()->findByPk($uid);
					$messages[] = 'User <b>'.$user->name.'</b> added to project <b>'.$project->name.'</b>'; 
				}
			}
			
			if (count($messages) > 0){
				yii::app()->user->setFlash('users_to_project', $messages);
				$this->refresh();
			}
			
			
		}
		
		// clear_users
		if ($command == 'clear_users') 
		{
			$users = yii::app()->request->getParam('user', array());
			if (count($users) == 0) return;
			
			$messages = array();
			foreach ($users as $uid => $shit) {
			
				$removed = $project->removeUser($uid);
				if ($removed) {
					$user = User::model()->findByPk($uid);
					if ($user == null) continue;
					$messages[] = 'User <b>'.$user->name.'</b> removed from project <b>'.$project->name.'</b>';
				}
			}
			
			if (count($messages) > 0){
				yii::app()->user->setFlash('users_to_project', $messages);
				
				$url = $this->createUrl('/project/lodb/users');
				$this->redirect($url);
			}
			
		}
	}

	/**
	 * Список участников проекта
	 *
	 * @param unknown_type $code
	 * @throws CHttpException
	 */
	public function actionIssues ($code)
	{
		if (yii::app()->user->isGuest) {
			throw new CHttpException('403 Auth required');
		}
			
		$project = Project::findByCode($code);
	
		if ($project == null) {
			throw new CHttpException('404 project whitch code "'.$code.'" not found');
		}
	
		// $this->actionUserCommandor($project);
	
		$this->pageTitle = 'Issues : '.$project->name;
		//$this->breadcrumbs['Мои проекты'] = array('/projects/');
		$this->breadcrumbs['Проект: '.$project->name] = array('/project/'.$project->code.'/');
		$this->breadcrumbs['Issues for project : '.$project->name] = array('/project/'.$project->code.'/users');
	
		$data = array (
			'project'		=> $project,
		);
	
		// ищим задачи по проекту
		// $search = $data['search'] =  yii::app()->request->getParam('search', '');
		// $modelAddUser = new AddUserForm();
	
		$this->render('issues', $data);
	}
}
