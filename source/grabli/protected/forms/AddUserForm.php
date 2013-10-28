<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class AddUserForm extends CFormModel
{
	public $name;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('name', 'required', 'message' => 'Ничего не введено'),
			array('name', 'email', 'message' => 'Not email', 'on' => array('secondstep')),
		);
	}
	
	
	public function existEmail () 
	{
		$users = User::getByEmail($this->email);
		if (count($users > 0)){
			return true;
		}
		
		return false;
		
	}

}