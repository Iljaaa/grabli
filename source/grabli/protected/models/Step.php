<?php


class Step extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'steps';
    }
    
    /**
     * Получаем шаги отсортированые спец образом
     * 
     */
    public function getOrderSteps ()
    {
    	$criteria = new CDbCriteria();
    	$criteria->order = "id ASC";
    	 
    	return $this->findAll($criteria);
    }
    
    /**
     * Получаем дочерние шаги
     * 
     */
    public function getRelatedSteps () 
    {
    	$criteria = new CDbCriteria();
    	$criteria->addCondition('steps_from = :from');
    	$criteria->params = array (':from' => $this->id);
    	
    	$links = StepHasSteps::model()->findAll($criteria);
    	
    	$related = array ();
    	foreach ($links as $l) {
    		$step = $l->getToStep();
    		if ($step != null) $related[] = $step;
    	}
    	
    	return $related;    	
    }
    
    /**
     * Проверяем является ли шаг дочерним
     * 
     * @param int $stepId
     * @return bool
     */
    public function isRelatedStep ($stepId)
    {
    	$criteria = new CDbCriteria();
    	$criteria->addCondition('steps_from = :from');
    	$criteria->addCondition('steps_to = :to');
    	$criteria->params = array (':from' => $this->id, ':to' => $stepId);
    	
    	$count = StepHasSteps::model()->count($criteria);
    	if ($count > 0)  return true;
    	
    	return false;
    }
    
}
