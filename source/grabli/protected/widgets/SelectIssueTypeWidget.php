<?php

class SelectIssueTypeWidget extends CWidget
{
	/**
	 * имя виджета
	 *
	 * @var string
	 */
	public $name = null;


	/**
	 * Заголовок окна
	 *
	 */
	public $title = '';

	public function init()
	{

	}

	public function run()
	{
		$this->render ('SelectIssueTypeWidget', array ('types' => Type::model()->findAll()));
	}
}