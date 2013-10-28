<?php

class RestorePasswordForm extends CFormModel
{
	public $email;


	public function rules()
	{
		return array(
			array('email', 'required', 'message' => 'Ничего не введено'),
			array('email', 'email', 'message' => 'Not email'),
			array('email', 'existEmail'),
		);
	}
	
	
	public function existEmail () 
	{
		$users = User::getByEmail($this->email);
		if (count($users) == 0) {
			$this->addError('email', 'Email not found');
		}
	}

}