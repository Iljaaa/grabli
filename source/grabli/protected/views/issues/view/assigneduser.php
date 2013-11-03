<script type="text/javascript">

function showAssignUserForm (){
	// $("#setAssignUserForm").show();
	$("#selectUserWidget").show();
}

function cancelChangeAssinedUser (){
	// $("#setAssignUserForm").hide();
	$("#selectUserWidget").hide();
}

function setAssignedUser(id)
{
	var name = $("#selectUserWidget").find("a[userid="+id+"]").text().trim();
	if (confirm('Assign user : '+name+' ?')){
		submitData ({
			'command'					: 'set_assigned_user',
			'select_user_assigned_user'	: id
		});
	}
} 

function submitData (data)
{
	var html = '<form name="submitDataForm" method="post">';
	for (var key in data) {
		var val = data[key];
		html += '<input type="hidden" name="'+key+'" value="'+val+'" />';
	}
	html += '</form>';

	$("body").append(html);
	document.submitDataForm.submit();
}

</script>

<?php $a = $bug->getAssigned(); ?>
<?php if ($a == null) : ?>
	no assigned user	set</a>
<?php else : ?>
	<?php $this->widget('ShowUserWidget', array('user'=>$a)); ?> 
<?php endif; ?>

<div style="float: right;">
<a href="javascript:showAssignUserForm()">
<?php if ($a == null) : ?>
	set
<?php else : ?>
	change
<?php endif; ?>
</a>
</div>

<?php $projectUsers = $project->getUsers(); ?>

<div id="selectUserWidget" style="width: 220px; height: 195px; position: absolute; z-index: 1000; margin: -20px 0px 0 0; background-color: white; border: solid 3px gray; display: none;">
	<div style="height: 35px;">
		<div style="padding: 10px 0 0 10px;"><b>Assigned to :</b></div>
	</div>
	<div style="overflow-y: scroll; height: 120px; margin: 0 10px 0 10px;">
		<ul style="list-style-type: none; padding: 0 0 0 5px; margin: 5px 0 5px 0;">
		<?php foreach ($projectUsers as $i) : ?>
			<li style="height: 20px; padding: 2px; cursor: pointer" onclick="javascript:setAssignedUser(<?=$i->id ?>)">
				<img src="<?=$i->getIcoUrl() ?>" />
				<a style="text-decoration: none;" userid="<?=$i->id ?>">
					<?=$i->name ?>
				</a>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div style="height: 40px; text-align: right;">
		<input type="button" value="Отмена" onclick="cancelChangeAssinedUser()" style="margin: 10px 10px 0 0" class="f-bu f-bu-warning" />
	</div>
</div>