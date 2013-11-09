<?php Yii::app()->getClientScript()->registerScriptFile('/js/issues_filter.js'); ?>

<?=CHtml::beginForm($this->createUrl($form->getActionUrl()), 'get', array ('class' => 'f-horizontal', 'name' => 'issuesFilterForm')); ?>

<?php

$projectUsers = array ();
if ($form->getScenario() == 'project-based')  {
	$projectUsers = $form->getProject()->getUsers();
	$userSelect = array('0' => 'All');
	foreach ($projectUsers as $u) {
		$userSelect[$u->id] = $u->name;
	}
}

if ($form->getScenario() == 'user-based') {
	$userProjects = $form->getUserObject()->getProjects();
	$projectsSelect = array('0' => 'All');
	foreach ($userProjects as $up) {
		$projectsSelect[$up->id] = $up->name;
	}
}

?>

<?=Chtml::hiddenField('sorting', $form->sorting); ?>
<?=Chtml::hiddenField('direction', $form->direction); ?>
<?=Chtml::hiddenField('page', $form->page); ?>
<?=Chtml::hiddenField('pagesize', $form->pagesize); ?>

<div class="f-row">
	Проект :
	<?php if ($form->getScenario() == 'project-based')  : ?>
		<?=CHtml::hiddenField('project', $form->project); ?>
		<?=$form->getProject()->name; ?>
	<?php else : ?>
		<?=CHtml::dropDownList('project',$form->project, $projectsSelect, array ('class' => 'g-4')) ?>
	<?php endif; ?>
</div>

<div class="f-row">
	<span style="float: left;">Assigned to: &nbsp;</span>
	<div style="float: left;">
	<?php $this->widget('SelectUserWidget', array(
		'users' 			=> $projectUsers,
		'selectedUserId'	=> $form->assigned_to,
		'name'				=> 'assigned_to'
	)); ?>
	</div>

	<span id="assigned-to-clear-button">&nbsp;&nbsp;&nbsp;<a href="javascript:clearAssignedTo()">Clear</a></span>
</div>

<div class="f-row">
	<span style="float: left;">Posted by: &nbsp;</span>
	<div style="float: left;">
	<?php $this->widget('SelectUserWidget', array(
		'users' 			=> $projectUsers,
		'selectedUserId'	=> $form->posted_by,
		'name'				=> 'posted_by'
	)); ?>
	</div>

	<span id="posted-by-clear-button">&nbsp;&nbsp;&nbsp;<a href="javascript:clearPostedBy()">Clear</a></span>
</div>

<div class="f-row">
<?=CHtml::submitButton('Filter') ?>
</div>

<div class="f-row">
	<?=Chtml::hiddenField('show', $form->show); ?>
	Show type:

	<?php if ($form->show == 'groups') : ?>
		Groups
	<?php else : ?>
		<a href="javascript:setShowType('groups')">Groups</a>
	<?php endif; ?>

	<?php if ($form->show == 'list') : ?>
		List
	<?php else : ?>
		<a href="javascript:setShowType('list')">List</a>
	<?php endif; ?>

</div>


<?=CHtml::endForm(); ?>