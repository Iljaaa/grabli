<?php

class UsersController extends Controller
{
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

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
				'actions'=>array('index', 'edit', 'view', 'sendrequest'),
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
		if ($id == 0) {
			throw new CHttpException('User id not sended');
		}

		$user = User::model()->findByPk($id);

		if ($user == null) {
			throw new CHttpException('User id "'.$id.'" not found');
		}

		/*
		if ($user->owner_id != yii::app()->user->getId()) {
			throw new CHttpException('Only owner can edit project "'.$code.'"');
		}*/

		$this->pageTitle = $user->name;
		$this->breadcrumbs[$user->name] = array('/user/'.$user->id);

		//

		$avatar = CUploadedFile::getInstanceByName('avatar');
		if ($avatar != null && $avatar->hasError == false) {
			if ($this->saveAvatarImage($avatar, $user)){
				//
				$user->updateLastActivity();

				$this->refresh();
			}
		}


		//
		$issuesCrit = new CDbCriteria ();
		$issuesCrit->limit = 10;

		$data = array (
			'user'		=> $user,
			'issues'	=> $user->getOpenIssues($issuesCrit)
		);

		$this->render('view', $data);
	}

	/**
	 * Сохраняем аватар для пользователя
	 *
	 */
	protected function saveAvatarImage (CUploadedFile $avatar, $user)
	{
		$fileName = $user->id.'.'.$avatar->getExtensionName();
		$fileIcoName = $user->id.'_ico.'.$avatar->getExtensionName();

		$filePath = realpath(yii::app()->getBasePath().'/../images/avatars');

		$fileFullPath = $filePath.'/'.$fileName;
		$fileFullIcoPath = $filePath.'/'.$fileIcoName;

		//
		$this->deleteAvatarImage($user);

		if ($avatar->saveAs($fileFullPath))
		{
			$image = yii::app()->image->load($fileFullPath);

			// минимальный размер картинки
			$min = $image->width;
			if ($min > $image->height) $min = $image->height;

			$k = 64 / $min;

			$newWidth = intVal($k * $image->width);
			$newHeight = intVal($k * $image->height);

			$image->resize($newWidth, $newHeight);
			$image->crop(64, 64);

			$image->save();

			// сохраняем иконку
			$icoPath =
			$image->resize (16, 16);
			$image->save($fileFullIcoPath);

			return true;
		}

		return false;
	}

	/**
	 * Удаляем изображения аватары
	 *
	 * @param $user
	 */
	protected function deleteAvatarImage ($user)
	{
		$files = array (
			$user->id.'.jpg', $user->id.'_ico.jpg',
			$user->id.'.png', $user->id.'_ico.png',
			$user->id.'.gif', $user->id.'_ico.gif',
			$user->id.'.jpeg', $user->id.'_ico.jpeg',
		);

		$path = $filePath = realpath(yii::app()->getBasePath().'/../images/avatars');

		foreach ($files as $f) {
			$filePath = $path.'/'.$f;
			if (file_exists($filePath)){
				unlink($filePath);
			}
		}
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

	/**
	 * Регистрация
	 *
	 */
	public function actionRegistration ()
	{
		$this->pageTitle = 'Registration';
		
		$model = new RegistrationForm();
		
		// проверяем форму регистрации
		if (isset($_POST['RegistrationForm']) && count($_POST['RegistrationForm'])) {
			$model->attributes = $_POST['RegistrationForm'];
			
			if ($model->validate()) {
				User::addUserByRegistrationModel ($model);

				$url = $this->createUrl('/users/registrationcomplite');
				$this->redirect($url);
			}
			
		}

		$data = array (
			'model'		=> $model
		);
		$this->render('registration', $data);
		
			
	}

	/**
	 *
	 */
	public function actionRegistrationcomplite()
	{
		$this->pageTitle = 'Registration is completed';
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
		
		$title = 'Restore password';
		
		$em = mail($user->email, $title, $body, $headers);
	}


	/**
	 * Для ajax ajax поиска пользователей
	 *
	 *
	 */
	public function actionAjaxUsers ()
	{
		$data = array (
			// 'project'		=> $project,
			'foundUsers'	=> array (),
			'searched'		=> false,
			'errors'		=> array ()
		);

		$search = yii::app()->request->getParam('search', '');
		$modelAddUser = new AddUserForm();

		if ($search != '') {
			$modelAddUser->name = $search;
			if ($modelAddUser->validate()) {
				$users = User::search ($modelAddUser->name);
				foreach ($users as $u) $data['foundUsers'][] = $u;
				$data['searched'] = true;
			}
		}
		else {
			$data['errors'][] = 'Searching string not setted';
		}



		// тип вывода информации
		$display = yii::app()->request->getParam('display', 'json');
		if ($display == 'json'){
			foreach ($data['foundUsers'] as $key => $val){
				$data['foundUsers'][$key] = $val->attributes;
			}

			echo  json_encode($data);
			yii::app()->end();
		}

		if ($display == 'html') {
			$this->renderPartial ('ajax-users', $data);
			yii::app()->end();
		}


		die ('MF die');


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
