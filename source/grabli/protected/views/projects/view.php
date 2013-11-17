<h1><i style="font-weight: normal;">Project :</i> <?=$project->name ?></h1>

<?php if (yii::app()->user->getId() == $project->owner_id) : ?>
<p class="f-buttons">

	<a href="<?=$this->createUrl('/project/'.$project->code.'/edit') ?>" class="f-bu f-bu-default">
		Edit project
	</a>

	<a href="<?=$this->createUrl('/project/'.$project->code.'/users') ?>" class="f-bu f-bu-default">
		Project users
	</a>
</p>
<?php endif; ?>

<div class="g-row">
	<div class="g-6">
		<div class="f-message" style="min-height: 70px;">
			<h5>Description :</h5>
			<?=nl2br($project->description) ?>
		</div>
	</div>
	
	<div class="g-3">
		<div class="f-message" style="min-height: 70px;">
			<h5>Users :</h5>
			<?php $users = $project->getUsers(); ?>
			<?php if (count($users) > 0) : ?>
			<?=$this->renderPartial('/projects/view/users', array ('users' => $users)); ?>
			<?php else : ?>
			--
			<?php endif; ?>
		</div>
		
	</div>
</div>

<div class="g-row">

	<div class="g-6">
		<table style="margin-top: 0;">
			<thead>
				<tr>
					<th></th>
					<th style="width: 50px; text-align: center;">open</th>
					<th style="width: 50px; text-align: center;">all</th>
					<th style="width: 50px; text-align: center;"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						Issues
					</td>
					<td style="text-align: center;">
						<?php
							$closed = $project->getClosedIssuesCount();
							$all = $project->getIssuesCount();
							echo ($all - $closed);
						?>
					</td>
					<td style="text-align: center;">
						<?=$all; ?>
					</td>
					<td style="text-align: center; font-weight: bold;">
						<?php if ($all > 0 && $closed > 0) :
							echo ' '.number_format((($closed/$all) * 100), 1);
							echo '%';
							else :
							echo '--';
							endif;
						?>
					</td>
				</tr>
			</tbody>
		</table>

	</div>
</div>

<hr />

<h2 style="margin-bottom: 0px; paddign-bottom: 0px;">Issues</h2>

<div style="margin-bottom: 10px;">

	<a href="<?=$this->createUrl ('/project/'.$project->code.'/issues/'); ?>" class="f-bu f-bu-default">
		All issues for project "<?=$project->name ?>"
	</a>

	<a href="javascript:openCreateIssueWindow()" class="f-bu f-bu-default"  style="margin-left: 5px;">
		Create issue
	</a>

</div>

<?=$this->renderPartial ('/projects/view/create_issue', array('project' => $project)) ?>


<?php if (isset($issues) && count($issues) > 0) : ?>
	<?=$this->renderPartial('/issues/list', array ('bugs' => $issues)); ?>

	<?php if ($project->getOpenIssuesCount() > count($issues)) : ?>
		<div>
			<a href="<?=$this->createUrl ('/project/'.$project->code.'/issues/'); ?>" class="f-bu f-bu-default">
				View all <?=$project->getOpenIssuesCount() ?> issues</a>
		</div>
	<?php endif; ?>

<?php else : ?>
<p>No issues</p>
<?php endif; ?>


