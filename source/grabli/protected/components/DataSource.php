<?php
/**
 * Created by PhpStorm.
 * User: ilja
 * Date: 23.11.13
 * Time: 23:31
 */

class DataSource
{
	/**
	 * Ключ для обновления изменения данных
	 *
	 * @var string
	 */
	protected $key = "id";

	/**
	 * Данные
	 *
	 * @var array
	 */
	protected $data = array (
		0 => array (
			'id'    => array (
				'value' => '1'
			),
			'name'  => array (
				'value' => 'название 1'
			),
		),
		1 => array (
			'id'    => array (
				'value' => '2'
			),
			'name'  => array (
				'value' => 'название 2'
			),
		)
	);


	public function getData ()
	{
		return $this->data;
	}
} 