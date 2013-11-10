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
	public $page = 1;
	public $pagesize = 20;

	/**
	 * Специальное условие
	 * только открытые все
	 * 'open', 'closed', 'all'
	 *
	 * @var int
	 */
	public $open = 'all';

	/**
	 * Специанльное условие
	 * для пользователя
	 *
	 * @var
	 */
	public $for; // для пользовталея


	/**
	 * Способ отображения
	 * влияет на сортировку
	 *
	 * @var string
	 */
	public $show = 'groups'; // Тип отображения

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


	/**
	 * Фабрика объекта формы
	 *
	 */
	public static function factory(array $data)
	{
		$f = new IssueFilterForm();

		$f->attributes = $data;


		return $f;
	}



	public function rules()
	{
		return array(
			array ('project, assigned_to, posted_by, show, sorting, direction, for, open', 'required'),
			array ('page', 'validPage')
		);
	}

	/**
	 * Строим критериб на основании фильтров
	 *
	 */
	public function buildCriteria ()
	{
		$criteria = new CDbCriteria();
		$criteria->order = '';

		if ($this->show == 'groups'){
			$criteria->order = 'steps_id ASC, ';
		}

		$criteria->order .= $this->sorting.' '.$this->direction;
		$criteria->params = array ();

		if ($this->assigned_to > 0){
			$criteria->addCondition('assigned_to = :assigned_to');
			$criteria->params[':assigned_to'] = $this->assigned_to;
		}

		if ($this->posted_by > 0){
			$criteria->addCondition('owner_id = :owner_id');
			$criteria->params[':owner_id'] = $this->posted_by;
		}

		if ($this->for > 0)
		{
			$criteria->addCondition('owner_id = :owner_id OR assigned_to = :assigned_to');
			$criteria->params[':owner_id'] = $this->for;
			$criteria->params[':assigned_to'] = $this->for;
		}

		// статус открытости
		if ($this->open == 'open') {
			$criteria->addCondition('steps_id <> 6');
		}

		return $criteria;
	}

	/**
	 * Устанавливаем объект пользователя для фильтра
	 *
	 * @param $user
	 */
	public function setUserObject ($user) {
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

	public function validPage ($attribute,$params){
		if ($this->page <= 1) $page = 1;

	}

}
