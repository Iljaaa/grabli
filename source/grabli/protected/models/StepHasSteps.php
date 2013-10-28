<?php


class StepHasSteps extends CActiveRecord
{
	
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'steps_has_steps';
    }
    
    
    public function getFromStep () {
    	return Step::model()->findByPk ($this->steps_from);
    }
    
    
    public function getToStep (){
    	return Step::model()->findByPk ($this->steps_to);
    }
    
}
