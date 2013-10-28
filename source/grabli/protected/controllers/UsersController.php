<?php

class UsersController extends Controller
{


	/**
	 * Данные пользователя
	 * 
	 * 
	 */
	public function actionIndex()
	{
		
	}
	
	/**
	 * 
	 * 
	 * @param unknown_type $id
	 */
	public function actionEdit ($id)
	{
		$users = Project::model()->findAll();
		
		$data = array (
				'projects'	=> $projects,
		);
		
		$this->render('user', $data);
	}

	public function actionView ($id)
	{
		$user = User::findByPk($id);

		$this->pageTitle = $user->name;
		$this->breadcrumbs[$user->name] = array('/user/'.$user->id);

		$this->render('view', array('user'=>$user));
	}

	/**
	 * Отправляем письмо пользователю с 
	 * 
	 */
	public function actionSendrequest () 
	{
		$this->pageTitle = 'Приглашение пользователей';
		
		if (yii::app()->user->isGuest) {
			throw new CHttpException('403 Auth required');
		}
		
		
		$model = new AddUserForm();

		$email = yii::app()->request->getParam ('email', '');
		$model->name = $email;
		
		$data = array (
			'model'	=> $model
		);
		
		
		$submitSend = yii::app()->request->getParam ('submitSend', false);
		if ($submitSend) {
			
			$this->sendRequestMessage($model->name, yii::app()->user->getId());
			
			$url = $this->createUrl ('/users/sendrequest', array('email'=>$model->name, 'emailsended' => 1));
			$this->redirect($url);
		}
		
		
		
		$this->render('sendrequest', $data);
	} 
	
	
	protected function sendRequestMessage ($email, $ownerId)
	{
		$data = array (
			'url'	=> WebUser::generateRegistratonUrl($email, $ownerId, time()),  
			'email'	=> $email		
		);
		
		$body = $this->renderPartial('/emails/userrequest', $data, true);
				
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: grablyBot <noreply@".$_SERVER["HTTP_HOST"].">\r\n";
		
		$title = 'Приглашение к регистрации на граблях';
		
		$em = mail($email, $title, $body, $headers);
	} 
	
	
	public function actionRegistration ()
	{
		$this->pageTitle = 'Регистрация';
		
		$model = new RegistrationForm();
		$model->setScenario('checkrequest');
		
		$r = yii::app()->request;
		$model->email 		= $r->getParam('email', '');
		$model->owner_id	= $r->getParam('owner', '');
		$model->code		= $r->getParam('code', '');
		$model->time		= $r->getParam('time', '');
		
		$data = array (
			'model'		=> $model,
			'urlValid'	=> true	
		);
		
		if (!$model->validate()) {
			$data['urlValid'] = false;
			$this->render('registration', $data);
			return;
		}
		
		// проверяем форму регистрации
		$model->setScenario('registration');
		if (isset($_POST['RegistrationForm']) && count($_POST['RegistrationForm'])) {
			$model->attributes = $_POST['RegistrationForm'];
			
			if ($model->validate()) {
				User::addUserByRegistrationModel ($model);

				$url = $this->createUrl('/users/registrationcomplite');
				$this->redirect($url);
			}
			
		}
		
		$data['model'] = $model;
		$this->render('registration', $data);
		
			
	}
	

	public function actionRegistrationcomplite()
	{
		$this->pageTitle = 'Регистрация завершена';
		$this->render ('registratuioncomplite');	
	}
	
	
	public function actionRestore () 
	{
		$data = array();
		
		$model = new RestorePasswordForm();
		
		if (isset($_POST['RestorePasswordForm']) && count($_POST['RestorePasswordForm']) > 0) {
			$model->attributes = $_POST['RestorePasswordForm'];
			if ($model->validate()) 
			{
				
				
				$user = User::getByEmail($model->email);
				
				if ($user == null) {
					$model->addError('email', 'User email : "'.$model->email."' not found");
				}
					
				if (!$model->hasErrors()) 
				{
					$this->updateUserPassword ($user);
					
					$url = $this->createUrl('/users/restore/', array ('emailsended' => 1));
					$this->redirect($url);
				}
			}
		}
		
		$data['model'] = $model;
		$this->render('restore', $data);
	}
	
	/**
	 * 
	 * 
	 * @param User $user
	 */
	protected function updateUserPassword (User $user)
	{
		$newPassword = WebUser::generatePassword();

		$user->setNewPassword ($newPassword);
		
		$this->sendRestorePasswordEmail ($user, $newPassword);
	}
	
	protected function sendRestorePasswordEmail ($user, $newPassword)
	{
		$data = array (
			'user'			=> $user,
			'newPassword'	=> $newPassword
		);
		
		$body = $this->renderPartial('/emails/restorepassword', $data, true);
		
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "From: grablyBot <noreply@".$_SERVER["HTTP_HOST"].">\r\n";
		
		$title = 'Восстановление пароля на граблях';
		
		$em = mail($user->email, $title, $body, $headers);
	}
	
	/**
	 *
	 *
	 
	public function actionAdd ()
	{
			

		if (yii::app()->user->isGuest) {
			throw new CHttpException('403 Auth required');
		}

		$this->pageTitle = 'Приглашение пользователей';
		$this->breadcrumbs['Приглашение пользователей'] = array ('/users/add/');

		$data = array(
			'showSearch' => false,
		);

		$search = $data['search'] = yii::app()->request->getParam('search', '');
		
		$model = new AddUserForm();

		if ($search != '') :
			$model->name = $search;
			if ($model->validate()) {
				$data['users'] = User::search ($model->name);
			}
		endif;

		$data['model'] = $model;
		$data['ownedUsers'] = yii::app()->user->getUserObject()->getOwnedUsers();



		$this->render ('add', $data);
	}*/

}
