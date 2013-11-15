<p class="f-buttons">

	<a href="javascript:openCreateIssueWindow();" class="f-bu f-bu-success">Create related issue</a>

	<?php if ($issue->canEdit ()) : ?>
		<a href="<?=$this->createUrl('/issue/'.$project->code.'/'.$issue->number.'/edit') ?>?backto=deafult" class="f-bu f-bu-default">Edit</a>
	<?php endif; ?>

	<a href="javascript:startSelectIssueType('changeStatus');" class="f-bu f-bu-default">Change issue type</a>
	<a href="javascript:startFindIssue('parentIssue');" class="f-bu f-bu-default">Change parent issue</a>
</p>

<?php $this->renderPartial ('/issues/view/create_issue_window'); ?>

<?php $this->widget ('SelectIssueTypeWidget', array (
	'name'      => 'changeStatus',
	'title'     => 'Change issue type'
)) ?>

<?php $this->widget ('FindIssueWidget', array (
	'name'      => 'parentIssue',
	'title'     => 'Select issue',
	'project'   => $project
)) ?>