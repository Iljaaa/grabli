<?php


class IssueForm extends CFormModel
{
	public $id;
	
	public $step_id;
	public $project_id;
	
	public $title;
	public $owner_id;
	public $assigned_to;
	public $type;
	
	public $number;
	
	public $description;
	public $rep_steps;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array ('id',	'required', 'message' => 'Id required'),	
			array ('id', 'numerical', 'min'=>1, 'tooSmall'=>'Id is 0', 'on' => array('edit')),
					
			array ('step_id', 'required', 'message' => 'Step id required'),
			array ('step_id', 'numerical', 'min'=>1, 'tooSmall'=>'Wrong step id', 'on' => array('edit')),
				
			array ('project_id', 'required', 'message' => 'Project id required'),
			array ('project_id', 'numerical', 'min'=>1, 'tooSmall'=>'Project bot setted'),
					
				
			array ('assigned_to', 'required', 'message' => 'Assigned to id required'),
			// array ('assigned_to', 'numerical', 'min'=>1, 'tooSmall'=>'Project bot setted'),
			// array ('assigned_to', 'assignedUserRequired'),

			array ('owner_id', 'required', 'message' => 'Owner id required'),
			array ('owner_id', 'numerical', 'min'=>1, 'tooSmall'=>'Owner not setted'),
			
			array ('type', 'required', 	'message'	=> 'Type not setted'),
			array ('type', 'length', 'min'=>1, 'tooShort'=>'Type setten wrong'),
				
			// name, email, subject and body are required
			array ('title', 'required', 'message' => 'Name not setted'),
			array ('title', 'length', 'max'=>128, 'tooLong'=>'Name to long'),
				
			array ('description', 'required', 'message' => 'Descrption not setted'),
			array ('description', 'length', 'max'=>1024, 'tooLong'=>'Description to long'),

			array ('rep_steps', 'length', 'max'=>1024, 'tooLong'=>'Последовательность to long'),
			array ('rep_steps', 'validatePosled'),
				
			array ('number', 'validateNumber'),
		);
	}


	public function attributeLabels() {
		return array (
			'rep_steps'		=> 'Reproduction steps',
			'project_id'	=> 'Project',
			'owner_id'		=> 'Owner'
		);
	}



	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function isPosledRequired()
	{
		if ($this->type == 'bug') {
			return true;
		}


		return false;
	}
	
	public function validatePosled ($params = array(), $attrs = array())
	{
		if (!$this->isPosledRequired()) return;

		if ($this->rep_steps == '') {
			$this->addError('rep_steps', 'Reproduction steps not setted');
			return false;
		}
		
		return true;
	}
	
	public function validateNumber ($params = array(), $attrs = array())
	{
		if ($this->id == 0) return;

		if ($this->number == 0) {
			$this->addError('number', 'Number setted wrong');
			return false;
		}
		
		return true;
	}
	
	public function assignedUserRequired ($params, $attrs) 
	{
		if ($this->assigned_to == 0) {
			$this->addError('assigned_to', 'Assigned user not setted');
			return ;
		}
	}
}