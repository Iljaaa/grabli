<?php

class FindUsersWidget extends CWidget
{
	/**
	 * Проект если надо искать в польвателях проекта
	 *
	 * @var string
	 */
	public $project = null;

	/**
	 * имя виджета
	 *
	 * @var string
	 */
	public $name = null;

	/**
	 * ранее заданая строка поиска
	 *
	 * @var string
	 */
	public $search = null;


	public function init()
	{

	}


	public function run()
	{
		$this->render ('FindUsersWidget');
	}

	public function actionRequest()
	{
		die ('request');
	}
}