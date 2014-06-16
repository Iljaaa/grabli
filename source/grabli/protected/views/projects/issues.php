<?php


/**
 *
 * @var $issueFilterForm issueFilterForm
 */


/** @var $dataProvider CActiveDataProvider */
$dataProvider = $issueFilterForm->getGridDataProvider();

?>

<h1><i style="font-weight: noraml;">Issues for project :</i> <?=$project->name ?></h1>

<div class="f-row">
<?php // $this->renderPartial('/projects/issues/filter', array('form' => $form)); ?>
</div>


<?php /* if (count($bugs) > 0) : ?>

	<?php $pagesCount = ceil($count / $form->pagesize); ?>
	<?php if ($pagesCount > 1) : ?>
		<div class="f-row">
		<?php $this->renderPartial ('/projects/issues/issues_pagenator', array('count' => $count, 'pagesize' => $form->pagesize, 'page' => $form->page)); ?>
		</div>
	<?php endif; ?>

	<?php if ($form->show == 'list') : ?>
		<?=$this->renderPartial('/issues/list', array ('bugs' => $bugs, 'sorting' => $form->sorting, 'direction' => $form->direction)); ?>
	<?php else : ?>
		<?=$this->renderPartial('/issues/group_list', array ('bugs' => $bugs, 'sorting' => $form->sorting, 'direction' => $form->direction)); ?>
	<?php endif; ?>

<?php else : ?>
	<h2>No issues for show</h2>
<?php endif; */ ?>

<style type="text/css">
    #filter-number input {
        width: 50px;
    }
</style>

<?php

$users = array ();
if ($issueFilterForm->project_id > 0) {
    /** @var Project $project */
    $project = Project::model()->findByPk($issueFilterForm->project_id);
    if ($project) {
        $users = $project->getUsers();
    }
}

$this->widget('IssuesGridWidget', array(
    'dataProvider'      => $dataProvider,
    'filter'            => $issueFilterForm,
    'filterUsers'       => $users,

    'cssFile'           => false,
    'ajaxUrl'           => false,
    'enableSorting'     => true,


    'pager'             => 'IssuesListPagenationWidget',
    'itemsCssClass'     => 'f-table-zebra issues-list',
    'pagerCssClass'     => 'pager',
    'columns' => array (
        array (
            'name'      => 'type',
            'type'      => 'html',
            'header'    => '',
            'filter'    => CHtml::activeCheckBox($issueFilterForm, 'type'),
            'value'     => function ($data){
                /** @var IssueSearch $data */
                $div = CHtml::tag('div', array(), '<div>'.IssueHelper::getIssueAbbreviation($data->type).'</div>');
                return CHtml::tag('div', array('class' => 'issue-small-ico issue-ico-'.$data->type), $div);// $data->get;
            },
        ),
        array (
            'name'      => 'project',
            'type'      => 'html',
            'filter'    => false,
            'value'     => function ($data){
                    /** @var IssueSearch $data */
                    return $data->getProject()->name;
                },
        ),
        array (
            'header'            => '#',
            'headerHtmlOptions' => array ('style' => 'text-align: center;'),
            'htmlOptions'       => array ('style' => 'text-align: center;'),
            'filterHtmlOptions' => array ('id' => 'filter-number'),
            'name'              => 'number',
            'type'              => 'html',
            'value'             => function ( $data, $row){
                /** @var IssueSearch $data */
                return CHtml::tag('b', array(), $data->number);// $data->get;
            },
        ),
        array(
            'name'  =>'title',
            'type'  => 'html',
            'value' =>function ($data, $row){
                    /** @var Issue $data */
                    $project = $data->getProject();
                    if ($project) {
                        return CHtml::link($data->title, '/issue/'.$project->code.'/'.$data->number) ;
                    }
                    return $data->title;
                },
        ),
        array(
            'name'      => 'owner_id',
            'filter'    => false,
            'type'      => 'html',
            'header'    => 'Owner',
            'value'=>function ($data, $row){
                /** @var Issue $data */
                $user = $data->getOwner();
                if ($user) return yii::app()->controller->renderPartial('/users/user_block', array('user' => $user));
            },
        ),
        array(
            'name'      =>'assigned_to',
            'filter'    => false,
            'type'      => 'html',
            'header'    => '<nobr>Assigned to</nobr>',
            'value'=>function ($data, $row){
                /** @var Issue $data */
                $user = $data->getAssigned();
                if ($user) return yii::app()->controller->renderPartial('/users/user_block', array('user' => $user));
            },
        ),
        array(
            'name'      => 'steps_id',
            'filter'    => array (
                'all_open' => 'All open',
            ),
            'header'    => 'Status',
            'value'     => function ($data, $row) {
                /** @var Issue $data */
                return yii::app()->controller->renderPartial('/issues/step_block', array('step' => $data->getStep()));
            },
        ),
    ),
)); ?>

