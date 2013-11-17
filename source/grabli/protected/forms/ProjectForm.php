<?php


class ProjectForm extends CFormModel
{
	public $id;
	public $owner_id;
	
	public $name;
	public $code;
	public $description;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array ('id', 'required', 'message' => 'Id required', 'on' => array('edit')),
			array ('id', 'numerical', 'min'=>1, 'tooSmall'=>'Id is 0', 'on' => array('edit')),

			array ('owner_id', 'required', 'message' => 'Owner id required'),
			array ('owner_id', 'numerical', 'min'=>1, 'tooSmall'=>'Owner not setted'),
				
			array ('name', 'required', 'message' => 'Name not setted'),
			array ('name', 'length', 'max'=>128, 'tooLong'=>'Name to long'),

			array ('code', 'codeCleaner'), // TODO сделать специальный фильтр
			array ('code', 'required', 'message' => 'Code not setted'),
			array ('code', 'length', 'min' => 5, 'max'=>256, 'tooLong'=>'Code to long', 'tooShort' => 'Code to short, must be min 5 symbols'),
			array ('code', 'validateCodeExists', 'on' => array('create')),
				
			array ('description', 'required', 'message' => 'Descrption not setted'),
			array ('description', 'length', 'max'=>1024, 'tooLong'=>'Description to long'),
		);
	}

	public function codeCleaner ($params = array(), $attrs = array())
	{
		if ($this->code == '') return;
		$this->code = Html::clearStringForUrl($this->code);
	}



	
	public function validateCodeExists ($params = array(), $attrs = array())
	{
	
		if ($this->code == '') return;
		
		$project = Project::findByCode($this->code);
		if ($project != null){
			$this->addError('code', 'Code all ready exist, choose other');
		}
	}

}