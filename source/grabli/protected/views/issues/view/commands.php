<script type="text/javascript">

	function setIssue (type){
		document.location = "<?=$this->createUrl('/issue/create/'.$project->code.'/"+type+"/?parent_id='.$issue->id) ?>";
	}

	function setIssueType(type, name) {

		if (name == 'changeStatus'){
			updateIssueType (type);
		}
	}


	function updateIssueType (type) {
		sendData({
			command : 'set-type',
			type    : type
		});
	}

	function sendData (data)
	{
		var html = '<form name="sendDataForm" method="post" >';
		for (var key in data) {
			var val = data[key];
			html += '<input type="hidden" name="'+key+'" value="'+val+'" />';
		}
		html += '</form>';

		$("body").append (html);
		document.sendDataForm.submit ();
	}

</script>


<p class="f-buttons">

	<?php if ($issue->canEdit ()) : ?>
	<a href="<?=$this->createUrl('/issue/'.$project->code.'/'.$issue->number.'/edit') ?>?backto=issue" class="f-bu f-bu-success">Edit</a>
	<?php endif; ?>

	<a href="javascript:openCreateIssueWindow();" class="f-bu f-bu-default">Create related issue</a>

	<a href="javascript:startSelectIssueType('changeStatus');" class="f-bu f-bu-default">Change issue type</a>
</p>

<?php $this->renderPartial ('/issues/view/create_issue_window'); ?>

<?php $this->widget ('SelectIssueTypeWidget', array ('name' => 'changeStatus', 'title' => 'Change issue type')) ?>