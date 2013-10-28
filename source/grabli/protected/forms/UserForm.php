<?php

class UserForm extends CFormModel
{
	public $name;
	
	public $old_password;
	public $new_password;
	public $new_password_confirm;
	
	public $avatara;

	public function rules()
	{
		return array(
			array('name', 'required', 'message' => 'Ничего не введено'),
			array('name', 'email', 'message' => 'Not email', 'on' => array('secondstep')),
		);
	}
	

}