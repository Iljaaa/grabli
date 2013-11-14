<?php


class Type extends CActiveRecord
{
	/**
	 *
	 *
	 * @var string
	 */
	private $primaryKey = 'id';


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
 
    public function tableName()
    {
        return 'types';
    }

	/**
	 * Находим по коду
	 *
	 * @param $code
	 * @return array|CActiveRecord|mixed|null
	 */
	public static function findByCode ($code)
	{
		$criteria = new CDbCriteria();
		$criteria->addCondition("code = :code");
		$criteria->params = array (":code" => $code);

		return static::model()->find($criteria);
	}
}