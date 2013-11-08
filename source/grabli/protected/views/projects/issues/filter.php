<?php Yii::app()->getClientScript()->registerScriptFile('/js/issues_filter.js'); ?>

<?=CHtml::beginForm($this->createUrl($form->getActionUrl()), 'get', array ('class' => 'f-horizontal', 'name' => 'issuesFilterForm')); ?>

<?php
yii::app()->firephp->log ($form->getScenario(), 'scenario');

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


<div class="f-row">
	<label>Проект</label>
	<?php if ($form->getScenario() == 'project-based')  : ?>
		<?=CHtml::hiddenField('project', $form->project); ?>
		<?=$form->getProject()->name; ?>
	<?php else : ?>
		<?=CHtml::dropDownList('project',$form->project, $projectsSelect, array ('class' => 'g-4')) ?>
	<?php endif; ?>
</div>

<div class="f-row">
	<label>Assigned to: </label>
	<?php $this->widget('SelectUserWidget', array(
		'users' 			=> $projectUsers,
		'selectedUserId'	=> $form->user_assigned,
		'name'				=> 'user_assigned'
	)); ?>
</div>

<div class="f-row">
	<label>Posted by: </label>
	<?php $this->widget('SelectUserWidget', array(
		'users' 			=> $projectUsers,
		'selectedUserId'	=> $form->user_posted,
		'name'				=> 'user_posted'
	)); ?>
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


<div class="f-row">
	<?=Chtml::hiddenField('sorting', $form->sorting); ?>
	Sorting :
	<?php foreach ($form->sortingTypes as $t) : ?>
		<?php if ($t == $form->sorting) : ?>
			<?=$t ?>
		<?php else : ?>
			<a href="javascript:setSort('<?=$t ?>')"><?=$t ?></a>
		<?php endif; ?>
	<?php endforeach; ?>
</div>

<div>
	<div>page : <?=$form->page ?></div>
	<div>pagesize : <?=$form->pagesize ?></div>
</div>

<?=CHtml::submitButton('Filter') ?>
<?=CHtml::endForm(); ?>