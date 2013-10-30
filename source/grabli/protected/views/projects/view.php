<h1>Проект: <?=$project->name ?></h1>

<?php if (yii::app()->user->getId() == $project->owner_id) : ?>
<p class="f-buttons">
	
	<span class="f-bu">
		<a href="<?=$this->createUrl('/project/'.$project->code.'/edit') ?>">Редактировать данные проекта</a>
	</span>
	
	
	<span class="f-bu">
		<a href="<?=$this->createUrl('/project/'.$project->code.'/users') ?>">Управление участниками проекта</a>
	</span>
</p>
<?php endif; ?>

<div class="g-row">
	<div class="g-6">
		<div class="f-message" style="min-height: 70px;">
			<h5>Описание :</h5>
			<?=nl2br($project->description) ?>
		</div>
	</div>
	
	<div class="g-3">
		<div class="f-message" style="min-height: 70px;">
			<h5>Участники :</h5>
			<?php $users = $project->getUsers(); ?>
			<?php if (count($users) > 0) : ?>
			<?=$this->renderPartial('/projects/view/users', array ('users' => $users)); ?>
			<?php else : ?>
			В проекте нет участинков
			<?php endif; ?>
		</div>
		
	</div>
</div>

<hr />

<h3 style="margin-bottom: 0px; paddign-bottom: 0px;">Issues</h3>
<div style="margin-bottom: 10px;">
<a href="<?=$this->createUrl ('/project/'.$project->code.'/issues/'); ?>">All issues by project <?=$project->name ?></a>
</div>

<input type="button" name="createIssue" onclick="openCreateIssueWindow()" value="Create issue" />
<?=$this->renderPartial ('/projects/view/create_issue', array('project' => $project)) ?>


<?php $bugs = $project->getBugs (); ?>
<?php if (count($bugs) > 0) : ?>
<?=$this->renderPartial('/bugs/list', array ('bugs' => $bugs)); ?>
<?php else : ?>
<p>No issues</p>
<?php endif; ?>


