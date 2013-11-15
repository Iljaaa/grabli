<?php

class FindIssueWidget extends CWidget
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
		$this->render ('FindIssueWidget');
	}

}