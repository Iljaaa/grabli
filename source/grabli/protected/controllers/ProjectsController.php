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

		$this->pageTitle = 'New project';
		$this->breadcrumbs['New project'] = array('/projects/add/');
		
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
		$this->breadcrumbs[$project->name] = array('/project/'.$project->code); 

		$issuesCriteria = new CDbCriteria();
		$issuesCriteria->limit = 10;

		$this->render('view', array(
			'project'	=> $project,
            'issues'    => $project->getOpenIssues ($issuesCriteria)
		));
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
		$project = Project::findByCode($code);

		if ($project == null) {
			throw new CHttpException('404 project whitch code "'.$code.'" not found');
		}

		$this->actionUserCommandor($project);

		if ($project->owner_id != yii::app()->user->getId()) {
			throw new CHttpException('403 only owner can manage users for project "'.$code.'"');
		}

		$this->pageTitle = 'Project users : '.$project->name;
		$this->breadcrumbs[$project->name] = array('/project/'.$project->code.'/');
		$this->breadcrumbs['Project users'] = array('/project/'.$project->code.'/users');

		$data = array (
			'project'		=> $project,
		);

		$this->render('users', $data);
	}


	protected function actionUserCommandor ($project)
	{
		$command = yii::app()->request->getParam('command', '');

		// пакетнаое добавление пользователей
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

		// добавление одного пользователя
		if ($command == 'add_user')
		{
			$userId = yii::app()->request->getParam('userForAdd', 0);
			if ($userId == 0) return;

			$user = User::model()->findByPk($userId);
			if ($user == null) return;

			$added = $project->addUser($user->id);
			$messages = array();
			if ($added) {
				$messages[] = 'User <b>'.$user->name.'</b> added to project <b>'.$project->name.'</b>';
			} else {
				$messages[] = 'User <b>'.$user->name.'</b> not added ';
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
				$this->refresh ();
			}

		}
	}

	/**
	 * Список участников проекта
	 *
	 * @param string $code
	 * @throws CHttpException
	 */
	public function actionIssues ($code)
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

		$this->pageTitle = 'Issues : '.$project->name;
		//$this->breadcrumbs['Мои проекты'] = array('/projects/');
		$this->breadcrumbs[$project->name] = array('/project/'.$project->code.'/');
		$this->breadcrumbs['Issues for project : '.$project->name] = array('/project/'.$project->code.'/users');

		$form = IssueFilterForm::factory($_GET);
		$form->setScenario ('project-based');
		$form->setProject ($project);
		$form->setActionUrl('/project/'.$project->code.'/issues');

		$valid = $form->validate();

		/*
		$form->show = yii::app()->getRequest()->getParam('show', 'groups');
		$form->sorting = yii::app()->getRequest()->getParam('sorting', 'number');
		$form->direction = yii::app()->getRequest()->getParam('direction', 'asc');
		$form->assigned_to = yii::app()->getRequest()->getParam('assigned_to', 0);
		$form->posted_by = yii::app()->getRequest()->getParam('posted_by', 0);
		$form->page = yii::app()->getRequest()->getParam('page', 1);
		$form->pagesize = yii::app()->getRequest()->getParam('pagesize', 20);*/


		$criteria = $form->buildCriteria($_GET);

		$data = array (
			'project'	=> $project,
			'count'		=> $project->getIssuesCount ($criteria),
			'form'		=> $form
		);

		if ($form->page > 0 && $form->pagesize > 0 && $data['count'] > $form->pagesize) {
			$pagesCount = ceil($data['count'] / $form->pagesize);
			if ($form->page > $pagesCount) $form->page = 1;
			$criteria->limit = $form->pagesize;
			$criteria->offset = ($form->page - 1) * $form->pagesize;
		}

		$form->project = $project->id;



		$data['bugs'] = $project->getIssues ($criteria);


		// ищим задачи по проекту
		// $search = $data['search'] =  yii::app()->request->getParam('search', '');
		// $modelAddUser = new AddUserForm();

		$this->render('issues', $data);
	}
}
