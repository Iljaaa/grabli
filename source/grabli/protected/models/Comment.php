<?php


class Comment extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'comments';
    }
    
    
    public function getUser ()
    {
    	return User::model()->findByPk($this->user_id);	
    	
    }
    
}
