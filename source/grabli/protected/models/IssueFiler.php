<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 15.06.14
 * Time: 11:19
 */

class IssueFiler extends CModel {

    public $id;
    public $title;
    public $type;
    public $number;
    public $project_id;
    public $owner_id;
    public $assigned_to;
    public $steps_id;

    public function rules()
    {
        return array (
            array ('number',        'numerical'),
            array ('project_id',    'numerical'),
            array ('owner_id',      'numerical'),
            array ('assigned_to',   'numerical'),
            array ('steps_id',      'length', 'max' => 20),
            array ('title',         'length', 'max' => 20),
            array ('type',          'length', 'max' => 20),
        );
    }


    /**
     * Returns the list of attribute names of the model.
     * @return array list of attribute names.
     */
    public function attributeNames() {
        return array ('id' => 'id', 'title' => 'title');
    }

    /**
     * @return CActiveDataProvider
     */
    public function getGridDataProvider()
    {
        $criteria = $this->buildCriteria();
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $count = Issue::model()->count($criteria);

        $pages=new CPagination($count);
        $pages->pageSize = 15;
        //$pages->applyLimit($criteria);

        return new CActiveDataProvider('Issue', array(
            'criteria'=>$criteria,
            /*'sort'=>array(
                'defaultOrder'=>'id ASC',
            ),*/
            'pagination'=> $pages
        ));
    }

    public function buildCriteria ()
    {
        $criteria = new CDbCriteria();
        $criteria->order = '';

        /*
        if ($this->show == 'groups'){
            $criteria->order = 'steps_id ASC, ';
            $criteria->order .= $this->sorting.' '.$this->direction;
        }*/

        $order = '';
        yii::app()->firephp->log ($this->type, 'this->type');
        if ($this->type){
            $order = 'type ASC';
        }

        $sort = yii::app()->getRequest()->getParam('Issue_sort', '');
        if (!empty($sort)){
            $sort = str_replace('.', ' ', $sort);
            if ($order != '') $order .= ', ';
            $order .= $sort;
        }
        $criteria->order = $order;

        $criteria->params = array ();

        if ($this->number > 0){
            $criteria->addCondition('number = :number');
            $criteria->params[':number'] = $this->number;
        }

        if ($this->project_id > 0) {
            $criteria->addCondition('project_id = :project_id');
            $criteria->params[':project_id'] = $this->project_id;
        }

        if (!empty($this->title)) {
            $criteria->addCondition('title LIKE \'%'.$this->title.'%\' ');
        }

        if ($this->owner_id > 0){
            $criteria->addCondition('owner_id = :owner_id');
            $criteria->params[':owner_id'] = $this->owner_id;
        }

        if ($this->assigned_to > 0){
            $criteria->addCondition('assigned_to = :assigned_to');
            $criteria->params[':assigned_to'] = $this->assigned_to;
        }

        yii::app()->firephp->log ($this->steps_id);
        if ($this->steps_id > 0){
            $criteria->addCondition('steps_id = :steps_id');
            $criteria->params[':steps_id'] = $this->steps_id;
        }

        if ($this->steps_id == 'all_open'){
            $criteria->addCondition('steps_id <> 6');
        }



        /* if ($this->for > 0)
        {
            $criteria->addCondition('owner_id = :owner_id OR assigned_to = :assigned_to');
            $criteria->params[':owner_id'] = $this->for;
            $criteria->params[':assigned_to'] = $this->for;
        }

        // статус открытости
        if ($this->open == 'open') {
            $criteria->addCondition('steps_id <> 6');
        }*/

        return $criteria;
    }

} 