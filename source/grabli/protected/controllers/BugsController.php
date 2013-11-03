<?php

class BugsController extends Controller
{

	
	protected function beforeAction($action) 
	{
		
		
		switch ($action->getId()) 
		{
			case 'index' :
			case 'view' :
			case 'create' :
			case 'viewbyid' : 
				$this->breadcrumbs['Мои проекты'] = array ('/projects');
				break;
			default : 
				break;
		}
		
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
			throw new CHttpException('Project by code "'.$projectCode.'" not found');
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
		
		
		
		$this->breadcrumbs['Проект: '.$project->name] = array('/project/'.$project->code); 
		$this->breadcrumbs[$bug->title] = array('/bug/'.$project->code.'/'.$bug->nomber);
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
					
					yii::app()->user->setFlash ('good_news', 'Bug status changed.');
					
					$url = $this->createUrl('/bug/'.$project->code.'/'.$bug->nomber);
					$this->redirect($url);
				}
			}
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
				
				$url = $this->createUrl('/bug/'.$project->code.'/'.$bug->nomber);
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
		
				$bug->createUserComment($mess, yii::app()->user->getId());
		
				
				//$bug->updateByPk ($bug->id, array('assigned_to' => $u->id));
				//$bug->assigned_to = $u->id;
				//$bug->save ();
		
				$bug->updateAll(array('steps_id' => $newStep->id), 'id = :id', array(':id' => $bug->id));

				yii::app()->user->setFlash ('good_news', 'Step setted.');
		
				$url = $this->createUrl('/bug/'.$project->code.'/'.$bug->nomber);
				$this->redirect($url);
			}
				
		}
		
		if ($command == 'post-comment') {
			$comment = yii::app()->request->getParam ('comment', '');
			
			if ($comment != '')
			{
				$bug->createUserComment($comment, yii::app()->user->getId());
	
				yii::app()->user->setFlash ('good_news', 'New comment posted.');
		
				$url = $this->createUrl('/bug/'.$project->code.'/'.$bug->nomber);
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
			throw new CHttpException('Bug id "'.$id.'" not found');
		}
		
		$project = $bug->getProject ();
		if ($project == null) {
			throw new CHttpException('Project for bug id "'.$id.'" not found');
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
		$this->breadcrumbs['New issue: '.ucfirst($type)] = array('/bugs/create/'.$type);
		
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

				$item = Bug::model()->findByPk ($item->id);
				
				$item->save();
				
				
				$project = Project::model()->findByPk ($model->project_id);
				
				// $this->redirect('/bugbyid/'.$item->id);
				$this->redirect('/bug/'.$project->code.'/'.$item->nomber);
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

}
