<?php

class IssuesController extends Controller
{


	protected function beforeAction($action) 
	{
		

		
		return parent::beforeAction($action);
	}
	

	/**
	 * Список проектов для пользователя
	 */
	public function actionIndex()
	{
		if (yii::app()->user->isGuest) {
			throw new CHttpException('Только для авторизованых пользователей');
		}
		
		$data = array (
			'user'	=> yii::app()->user->getUserObject(),
		);

		$this->render('user', $data);
	}
	
	
	public function actionView ($projectCode, $nomber) 
	{
		if (yii::app()->user->isGuest) {
			throw new CHttpException('Только для авторизованых пользователей');
		}
		
		$project = Project::findByCode($projectCode);
		if ($project == null) {
			throw new CHttpException(304, 'Project by code "'.$projectCode.'" not found');
		}
		
		$bug = Bug::getBugByProjectAndNomber($project->id, $nomber);
		if ($bug == null){
			throw new CHttpException('Bug not found; project code : "'.$projectCode.'"; bug number : "'.$nomber.'"', 404);
		}
		
		// проверяем есть ли упользователя доступ к провекту
		if (!yii::app()->user->getUserObject()->isInProject($project->id)){
			throw new CHttpException('You can\'t see this assign, вы не являетесь участником проекта', 403);
		}

		$this->viewCommandor($bug, $project);

		$this->breadcrumbs[$project->name] = array('/project/'.$project->code);
		$t = IssueHelper::getIssueNameByType($bug->type).' #'.$bug->nomber.' '.$bug->title;
		$this->breadcrumbs[$t] = array('/issue/'.$project->code.'/'.$bug->nomber);
		$this->pageTitle = "#".$bug->nomber." ".$bug->title;
		
		$data = array (
			'bug'		=> $bug, 
			'project'	=> $project
		);
		
		$this->render('view', $data);
	}
	
	protected function viewCommandor ($bug, $project)
	{
		$command = yii::app()->request->getParam ('command', '');
		yii::app()->firephp->log ($command, 'command');
		yii::app()->firephp->log ($_POST, 'post');

		
		if ($command == 'set_status') {
			$statusId = yii::app()->request->getParam('step', 0);
			if ($statusId > 0) {
				if ($bug->canSetStep($statusId)) 
				{
					$currentStep = $bug->getStep();
					$nextStep = Step::model()->findByPk ($statusId);

					$mess = 'User <b>'.yii::app()->user->getUserObject()->name.'</b> ';
					$mess .= 'change status from <b>'.$currentStep->title.'</b> ';
					$mess .= ' to <b>'.$nextStep->title.'</b> ';
					
					$bug->createSystemComment($mess, yii::app()->user->getId());
					
					/*
					$bug->steps_id = $nextStep->id;
					$bug->save ();*/
					$bug->updateAll(array('steps_id' => $nextStep->id), 'id = :id', array(':id' => $bug->id));
					
					yii::app()->user->setFlash ('good_news', 'Issue status changed.');
					
					$url = $this->createUrl('/issue/'.$project->code.'/'.$bug->nomber);
					$this->redirect($url);
				}
			}
		}

		if ($command == 'set-deadline')
		{
			$date = yii::app()->request->getParam('date', '');
			$dt = date_parse($date);

			if (isset($dt['error_count']) && $dt['error_count'] > 0){
				return;
			}

			$bug->dedline_date = DateTimeHelper::dateToTimeStamp($date);
			$bug->save();

			$mess = 'User <b>'.yii::app()->user->getUserObject()->name.'</b> ';
			$mess .= 'set dead line ';
			$bug->createSystemComment ($mess);

			$this->refresh();
		}

		if ($command == 'clear-deadline')
		{

			$bug->dedline_date = 0;
			$bug->save();

			$mess = 'User <b>'.yii::app()->user->getUserObject()->name.'</b> ';
			$mess .= 'clear dead line ';
			$bug->createSystemComment ($mess);


			$this->refresh();
		}

		if ($command == 'set_assigned_user') 
		{
			$selectedUser = yii::app()->request->getParam ('select_user_assigned_user', 0);	
			if ($selectedUser > 0) 
			{
				echo $selectedUser;
				$u = User::model()->findByPk($selectedUser);
				
				$mess = 'User <b>'.yii::app()->user->getUserObject()->name.'</b> ';
				$mess .= 'set assigned user <b>'.$u->name.'</b> ';
				
				$bug->createSystemComment($mess, yii::app()->user->getId());
				
				//$bug->updateByPk ($bug->id, array('assigned_to' => $u->id));
				//$bug->assigned_to = $u->id;
				//$bug->save ();
				
				$bug->updateAll(array('assigned_to' => $u->id), 'id = :id', array(':id' => $bug->id));
				
				yii::app()->user->setFlash ('good_news', 'Assigned user changed.');
				
				$url = $this->createUrl('/issue/'.$project->code.'/'.$bug->nomber);
				$this->redirect($url);
			}
			
		}
		
		if ($command == 'set_status')
		{
			$newStatus = yii::app()->request->getParam ('status', 0);
			if ($newStatus > 0)
			{
				echo $newStatus;
				$newStep = Step::model()->findByPk($newStatus);
		
				$mess = 'User <b>'.yii::app()->user->getUserObject()->name.'</b> ';
				$mess .= 'set status <b>'.$newStep->title.'</b> ';
		
				$bug->createSystemComment ($mess);
		
				$bug->updateAll(array('steps_id' => $newStep->id), 'id = :id', array(':id' => $bug->id));

				yii::app()->user->setFlash ('good_news', 'Status changed.');

				$this->refresh();
			}
				
		}
		
		if ($command == 'post-comment') {
			$comment = yii::app()->request->getParam ('comment', '');
			
			if ($comment != '')
			{
				$bug->createUserComment($comment, yii::app()->user->getId());
	
				yii::app()->user->setFlash ('good_news', 'New comment posted.');
		
				$url = $this->createUrl('/issue/'.$project->code.'/'.$bug->nomber);
				$this->redirect($url);
			}
		}
		
		if ($command == 'show_system_comments') 
		{
			$currentValue = yii::app()->user->getState('show_system_comments', false);
			
			if ($currentValue == false) yii::app()->user->setState ('show_system_comments', true);
			else yii::app()->user->setState ('show_system_comments', false);				
				
			$this->refresh();
		}
		
	} 
	
	public function actionViewbyid ($id)
	{
		$bug = Bug::model()->findByPk ($id);
		
		if ($bug == null) {
			throw new CHttpException('Issue id "'.$id.'" not found');
		}
		
		$project = $bug->getProject ();
		if ($project == null) {
			throw new CHttpException('Project for issue id "'.$id.'" not found');
		}
		
		$this->actionView($project->code, $bug->nomber);
		
	}

	/**
	 * Акшн создания бага
	 * 
	 * @param string $projectCode код проекта
	 * @param string $type тип создаваемого бага
	 * @throws CHttpException
	 */
	public function actionCreate ($projectCode, $type)
	{
		
		if (yii::app()->user->isGuest) {
			throw new CHttpException('Только для авторизованых пользователей');
		}

		if ($projectCode == '') {
			throw new CHttpException('Url wrong project code not setted');
		}
		
		// определяем выбраный проект
		$project = Project::findByCode($projectCode);
		if ($project == null) {
			throw new CHttpException('Project "'.$projectCode.'" not found');
		}

		$this->breadcrumbs[$project->name] = array('/project/'.$project->code.'/');
		$this->breadcrumbs['New issue: '.ucfirst($type)] = array('/issues/create/'.$type);
		$this->pageTitle = 'Create '.IssueHelper::getIssueNameByType($type);
		
		// проверяем 
		$projectUser = $project->getUsers();
		$found = false;
		foreach ($projectUser as $u) {
			if ($u->id == yii::app()->user->getId()) $found = true;
		}
		if (!$found) {
			// throw new CHttpException('Вы не можете создавать Issues, вы не являетесь участником проекта');
			throw new CHttpException('You can\'t create Issues, you have no access to this project.');
		}

		$model = new IssueForm();
		$model->setScenario('create');
		$model->id = 0;
		$model->owner_id = yii::app()->user->getId();
		$model->assigned_to = 0;
		$model->step_id = 1;
		$model->type = $type;

		if ($project != null) {
			$model->project_id = $project->id;
		}



		
		if (isset($_POST['IssueForm']) && count(($_POST['IssueForm'])) > 0) :
			$model->attributes = $_POST['IssueForm'];
		
			if (isset($_POST['assigned_to']))
				$model->assigned_to = intVal($_POST['assigned_to']);
				
			if ($model->validate())
			{
				$model->nomber = Bug::getNextFreeNumberByProject($model->project_id);
				
				$item = new Bug();
				$item->added_date = time();
				$item->updateByAddModel ($model);
				
				$item->save();


				//
				$item->createSystemComment ('Issue created');
				
				// $this->redirect('/bugbyid/'.$item->id);
				$this->redirect('/issue/'.$project->code.'/'.$item->nomber);
			}
		endif;
		
		$data = array (
			'project'	=> $project,
			'type' 		=> $type,
			'model'		=> $model, 
			'user'		=> yii::app()->user->getUserObject()
		);
		$this->render('create', $data);
	}

	public function actionEdit ($projectCode, $number)
	{
		yii::app()->firephp->log ('333');
		if (yii::app()->user->isGuest) {
			throw new CHttpException('Только для авторизованых пользователей');
		}

		$project = Project::findByCode($projectCode);
		if ($project == null) {
			throw new CHttpException('Project by code "'.$projectCode.'" not found');
		}

		$bug = Bug::getBugByProjectAndNomber($project->id, $number);
		if ($bug == null){
			throw new CHttpException('Bug not found; project code : "'.$projectCode.'"; bug number : "'.$number.'"', 404);
		}
		yii::app()->firephp->log ($bug, '$bug');

		// проверяем есть ли упользователя доступ к провекту
		if (!yii::app()->user->getUserObject()->isInProject($project->id)){
			throw new CHttpException('You can\'t see this assign, вы не являетесь участником проекта', 403);
		}

		// проверяем
		// $projectUser = $project->getUsers();

		$this->breadcrumbs[$project->name] = array('/project/'.$project->code);
		$this->breadcrumbs[$bug->title] = array('/issue/'.$project->code.'/'.$bug->nomber);
		$this->breadcrumbs['Edit'] = array('/issue/'.$project->code.'/'.$bug->nomber.'/edit');
		$this->pageTitle = "Edit: #".$bug->nomber." ".$bug->title;

		$model = new IssueForm();
		$model->setScenario('edit');
		$model->attributes = $bug->attributes;

		if (isset($_POST['IssueForm']) && count(($_POST['IssueForm'])) > 0) :
			$model->attributes = $_POST['IssueForm'];
			$model->step_id = $bug->steps_id;

			if (isset($_POST['assigned_to'])) {
				$model->assigned_to = intVal($_POST['assigned_to']);
			}

			if ($model->validate())
			{
				$bug->updateByAddModel ($model);
				$bug->save();


				$mess = 'Issue updated by  <b>'.yii::app()->user->getUserObject()->name.'</b> ';
				$bug->createSystemComment($mess);

				$this->redirect('/issue/'.$project->code.'/'.$bug->nomber);

				/*
				$item = new Bug();
				$item->added_date = time();
				$item->updateByAddModel ($model);

				$item = Bug::model()->findByPk ($item->id);

				$item->save();


				$project = Project::model()->findByPk ($model->project_id);

				// $this->redirect('/bugbyid/'.$item->id);
				*/
			}
		endif;

		if ($project != null) {
			$model->project_id = $project->id;
		}

		$data = array (
			'issue'		=> $bug,
			'project'	=> $project,
			'user'		=> yii::app()->user->getUserObject(),
			'model'		=> $model
		);

		$this->render('edit', $data);
	}
}
