<?=$this->renderPartial('/users/view/info', array('user' => $user)); ?>

<?php if (yii::app()->user->getId() == $user->id) : ?>

	<?php $projects = $user->getProjects() ?>
	<h2>Projects</h2>
	<?php if (count($projects) > 0) : ?>
		<?=$this->renderPartial('/projects/user/list', array('projects' => $projects)); ?>
	<?php else : ?>
		<p><i>No project to show</i></p>
	<?php endif; ?>

	<h2>Issues</h2>
	<?php if (isset($issues) && count($issues) > 0) : ?>
		<?=$this->renderPartial ('/issues/list', array ('bugs' => $issues)); ?>
	<?php else : ?>
		<p><i>No issues to show</i></p>
	<?php endif; ?>

<?php endif; ?>
