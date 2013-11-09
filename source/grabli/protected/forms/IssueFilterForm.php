<?php

/**
 * Scenarios:
 *	'project-based'
 * 	'user-based'
 *
 * Class IssueFilterForm
 */


class IssueFilterForm extends CFormModel
{
	/**
	 * Пользователь для которого готовится фильтр
	 *
	 * @var
	 */
	public $assigned_to;
	public $posted_by;
	public $project;

	public $sorting = 'number'; // Сортировка результатов
	public $direction = 'asc'; // Сортировка результатов
	public $show = 'groups'; // Тип отображения
	public $page = 1;
	public $pagesize = 20;

	/**
	 * Способы отображения
	 *
	 * @var array
	 */
	public $showTypes = array (
		0 => 'group',
		1 => 'list'
	);

	/**
	 * Варианты сортировки
	 *
	 * @var array
	 */
	public $sortingTypes = array (
		0 => 'number',
		1 => 'title'
	);

	/**
	 * Сохранение объекта пользователя
	 *
	 * @var null
	 */
	protected $_userObject = null;


	/**
	 * Сохранение объекта
	 *
	 * @var null
	 */
	protected $_project = null;

	/**
	 * Акшн урл поля
	 *
	 * @var string
	 */
	protected $_actionUrl = '';





	public function rules()
	{
		return array(
			array ('project, assigned_to, posted_by, show, sort, direction', 'required'),
			array ('page', 'validPage')
		);
	}

	/**
	 * Устанавливаем объект пользователя для фильтра
	 *
	 * @param $user
	 */
	public function setUserObject ($user) {
		yii::app()->firephp->log ($user, 'user');
		$this->_userObject = $user;
	}

	public function getUserObject (){
		return $this->_userObject;
	}

	/**
	 * Устанавлием объект проекта
	 *
	 * @param $project
	 */
	public function setProject ($project) {
		$this->_project = $project;
		$this->project = $project->id;
	}

	public function getProject (){
		return $this->_project;
	}

	/**
	 * Устанавливаем адресацию акшн метода
	 *
	 * @param $url
	 */
	public function setActionUrl ($url) {
		$this->_actionUrl = $url;
	}

	public function getActionUrl (){
		return $this->_actionUrl;
	}



	protected function validUser ($attribute,$params)
	{
		if($this->user == null) {
			$this->addError('password','Incorrect username or password.');


			return false;
		}

		return true;
	}

	protected function validPage ($attribute,$params){
		if ($this->page <= 1) $page = 1;

	}

}
