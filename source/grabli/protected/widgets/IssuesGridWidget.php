<?php
/**
 * Created by PhpStorm.
 * User: Ilja
 * Date: 16.06.14
 * Time: 20:18
 */

Yii::import('zii.widgets.grid.CGridView');

class IssuesGridWidget extends CGridView
{
    /**
     * Показывать ли столбец с проектом
     * @var bool
     */
    public $showProject = false;

    /**
     * Пользователи для фильтрац владельца и назначеного
     * @var User[]
     */
    public $filterUsers = array ();


    /**
     * @var bool
     */
    public $ajaxUpdate = true;

    /**
     * @var null
     */
    protected $_prevRow = null;

    /**
     *
     */
    public function init()
    {
        if (!$this->showProject){
            /** @var CDataColumn $column */
            $this->columns[1]['visible'] = false;
        }



        yii::app()->firephp->log (count($this->filterUsers), 'users');
        $select = array ();
        foreach ($this->filterUsers as $us){
            $select[$us->id] = $us->name;
        }

        $this->columns[4]['filter'] = $select;
        $this->columns[5]['filter'] = $select;

        $steps = Step::model()->getOrderSteps();
        foreach ($steps as $s){
            $this->columns[6]['filter'][$s->id] = $s->name;
        }

        parent::init();
    }


    /**
     *
     */
    public function run() {
        parent::run();
    }

    /**
     * @param int $row
     */
    public function renderTableRow($row)
    {
        if ($this->filter->type){
            $data =  isset($this->dataProvider->data[$row]) ? $this->dataProvider->data[$row] : null;
            if ($data) {
                if ($data->type != $this->_prevRow){
                    echo CHtml::openTag('tr', array ())."\n";
                    echo CHtml::openTag('td', array ('colspan' => count($this->columns)));
                    echo CHtml::tag('div', array (
                            'class' => 'issue-ico-'.$data->type,
                            'style' => 'padding: 10px 15px;'
                        ), IssueHelper::getIssueNameByType($data->type))."\n";
                    echo "</td></tr>\n";
                }
                $this->_prevRow = $data->type;
            }
        }

        echo CHtml::openTag('tr', array ())."\n";
        foreach($this->columns as $column)
            $column->renderDataCell($row);
        echo "</tr>\n";
    }


} 