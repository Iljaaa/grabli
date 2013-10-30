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

<?php /*
<p class="f-buttons">
	Create: &nbsp;&nbsp;&nbsp;
	<span class="f-bu">
		<a href="<?=$this->createUrl('/bugs/create/'.$project->code.'/bug') ?>" class="f-bu-bug">
			Bug
		</a>
	</span>
	
	<span class="f-bu">
		<a href="<?=$this->createUrl('/bugs/create/'.$project->code.'/encantment') ?>"  class="f-bu-enhancement">
			Enhancement</a>
	</span>
	
	<span class="f-bu">
		<a href="<?=$this->createUrl('/bugs/create/'.$project->code.'/task') ?>" class="f-bu-task">
			Task</a>
	</span>
	
	<span class="f-bu">
		<a href="<?=$this->createUrl('/bugs/create/'.$project->code.'/featurerequest') ?>" class="f-bu-featurerequest">
			Feature Request</a>
	</span>
	
	
	<span class="f-bu">
		<a href="<?=$this->createUrl('/bugs/create/'.$project->code.'/idea') ?>" class="f-bu-idea">
			Idea</a>
	</span>
	
	<span class="f-bu">
		<a href="<?=$this->createUrl('/bugs/create/'.$project->code.'/other'); ?>" class="f-bu-other">
			Other</a>
	</span>
</p> */ ?>


<div>
	<a href="#" class="issue-ico issue-ico-red" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-orange" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-purple" style="margin-left: 5px;">
		<div><div>
				C
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-pr" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-navy" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-blue" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-light-blue" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-c3" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-c4" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<div style="clear: both;"></div>
</div>

<input type="button" name="createIssue" onclick="openCreateIssueWindow()" value="Create issue" />
<?=$this->renderPartial ('/projects/view/create_issue') ?>


<?php $bugs = $project->getBugs (); ?>
<?php if (count($bugs) > 0) : ?>
<?=$this->renderPartial('/bugs/list', array ('bugs' => $bugs)); ?>
<?php else : ?>
<p>No issues</p>
<?php endif; ?>


