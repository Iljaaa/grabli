<?php

class RegistrationForm extends CFormModel
{
	public $owner_id;
	
	public $name;
	public $email;
	
	public $password;
	public $password_confirm;
	
	
	// 
	public $code;
	public $time;
	
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array ('owner_id', 'required', 'message' => 'Owner id required', 
					'on' => array('registration', 'checkrequest')),
			array ('owner_id', 'numerical', 'min'=>1, 'tooSmall'=>'Owner not setted',
					'on' => array('registration', 'checkrequest')),
			array ('owner_id', 'validateOwnerExist',
					'on' => array('registration', 'checkrequest')),
				
			array('name', 'required', 'message' => 'Name not setted', 
					'on' => array('registration')),
			array('name', 'length', 'min'=>1, 'max'=>128 , 'tooShort'=>'Name not setted', 'tooLong'=>'Name to long', 
					'on' => array('registration')),
				
			array('email', 'required', 'message' => 'Email not setted', 
					'on' => array('registration', 'checkrequest')),
			array('email', 'length', 'min'=>1, 'max'=>128 , 'tooShort'=>'Email not setted', 'tooLong'=>'Email to long', 
					'on' => array('registration', 'checkrequest')),
			array('email', 'email', 'message' => 'Email setted wrong', 
					'on' => array('registration', 'checkrequest')),
			array('email', 'validateEmailExist', 
					'on' => array('registration', 'checkrequest')),
				
			array('password', 'required', 'message' => 'Password not setted', 
					'on' => array('registration')),
			array('password', 'length', 'min'=>3, 'max'=>128 , 'tooShort'=>'Password must be 3 symbols min', 'tooLong'=>'Password to long', 
					'on' => array('registration')),
			array('password', 'compare', 'compareAttribute'=>'password_confirm', 'message' => 'Passwords do not match', 
					'on' => array('registration')),
				
			array('password_confirm', 'required', 'message' => 'Password confirm not setted', 
					'on' => array('registration')),
			
			
				
				
			array ('time', 'required', 'message' => 'Time required',
					'on' => array('checkrequest')),
			array ('time', 'numerical', 'min'=>1, 'tooSmall'=>'Time not setted',
					'on' => array('checkrequest')),
				
			array('code', 'required', 'message' => 'Code not setted',
					'on' => array('checkrequest')),
			array('code', 'length', 'min'=>20, 'max'=>128 , 'tooShort'=>'Code setted wrong', 'tooLong'=>'Code setted wrong',
					'on' => array('checkrequest')),
			array('code', 'validateCode',
					'on' => array('checkrequest')),
				
		);
	}
	
	
	public function validateEmailExist ($params = array(), $attrs = array()) 
	{
		$users = User::getByEmail($this->email);
		if (count($users) > 0){
			$this->addError('email', 'Email exist, try other');
		}
	}

	
	public function validateCode ($params = array(), $attrs = array()) 
	{
		$delta = time() - $this->time;
				
		$freeDays = (3600 * 24) * 3;
		
		if ($delta > $freeDays) {
			$this->addError('code', 'Урл устарел');
			return;
		}
		
		$valid = WebUser::validRegistrationKey($this->code, $this->email, $this->owner_id, $this->time);
		if (!$valid) {
			$this->addError('code', 'Урл не верный');
		} 
	}
	
	public function validateOwnerExist ($params = array(), $attrs = array()) 
	{
		$user = User::model()->findByPk ($this->owner_id);
		if ($user == null) {
			$this->addError('owner_id', 'User who send request not found');
		}
	}
	
}