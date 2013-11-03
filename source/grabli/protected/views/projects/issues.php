<h1>Issues for project: <?=$project->name ?></h1>

<div>
<?php $this->renderPartial('/projects/issues/filter'); ?>
</div>

<?php $bugs = $project->getBugs (); ?>
<?php if (count($bugs) > 0) : ?>
	<?=$this->renderPartial('/issues/group_list', array ('bugs' => $bugs)); ?>
<?php else : ?>
	<p>Нет задач</p>
<?php endif; ?>