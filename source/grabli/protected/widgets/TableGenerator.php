<?php
/**
 * Created by PhpStorm.
 * User: ilja
 * Date: 23.11.13
 * Time: 23:26
 */

class TableGenerator extends CWidget
{
	/**
	 * Источник
	 *
	 * @var string
	 */
	public $dataSource = 'DataSource';

	/**
	 * Парметры источника
	 *
	 * @var array
	 */
	public $dataSourceParams = array ();

	/**
	 * Описание столбцов
	 *
	 * @var array
	 */
	public $cols = array(
		0 => array (
			'type'  => 'checkbox'
		),
		1 => array(
			'type'      => 'data',
			'source'    => 'id'
		),
		2 => array(
			'type'      => 'data',
			'source'    => 'name'
		)
	);

	protected $generateCellCheckbox = function () {};

	public function run()
	{


		// этот метод будет вызван внутри CBaseController::endWidget()

		$this->render ('TableGenerator');
	}

	public function getData () {

		$ds = new $this->dataSource ($this->dataSourceParams);

		$data = $ds->getData();
		yii::app()->firephp->log ($data, 'data');
		return $ds->getData();
	}

	protected function generateHeaderCell ($cellInfo)
	{
		yii::app()->firephp->log ($cellInfo, '$cellInfo');

		switch ($cellInfo['type']) {
			case 'checkbox' :
				return '<th>ccc</th>';
				break;
			case 'data' :
				return '<th>ddd</th>';
				break;
		}
		$generateCellCheckbox = function () {};
	}

	protected function generateBodyCell ($cellInfo, $rowData)
	{
		switch ($cellInfo['type']) {
			case 'checkbox' :
				return '<td>ccc</td>';
				break;
			case 'data' :
				return '<td>ddd</td>';
				break;
		}
	}
} 