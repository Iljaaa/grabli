

<script type="text/javascript">
	function setIssue (type){
		document.location = "<?=$this->createUrl('/issue/create/'.$project->code.'/"+type+"/?parent_id='.$issue->id) ?>";
	}

</script>


<p class="f-buttons">

	<?php if ($issue->canEdit ()) : ?>
	<a href="<?=$this->createUrl('/issue/'.$project->code.'/'.$issue->number.'/edit') ?>?backto=issue" class="f-bu f-bu-success">Edit</a>
	<?php endif; ?>

	<a href="javascript:openCreateIssueWindow();" class="f-bu f-bu-default">Create related issue</a>
</p>

<?php $this->renderPartial ('/issues/view/create_issue_window');