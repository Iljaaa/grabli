<?php

class SelectUserWidget extends CWidget
{
	/**
	 * Массив объектов пользователей для выбора
	 *
	 * @var array
	 */
	public $users = array ();

	/**
	 * Идентификатор выбраного пользователя
	 *
	 * @var int
	 */
	public $selectedUserId = 0;

	/**
	 * Название селекта
	 *
	 * @var
	 */
	public $name;

	/**
	 * Текст который будет показан если пользователь не выбран
	 *
	 * @var string
	 */
	public $emptyUserText = 'User not selected';

		
		
		
	public function init()
	{

	}


	public function run()
	{
		$this->render ('SelectUserWidget');
	}
}