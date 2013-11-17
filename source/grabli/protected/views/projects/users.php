<script type="text/javascript">

	function setUser (userId, name)
	{
		$("#userForAdd").val(userId);
		document.addUserForm.submit ();
	}

	function deleteUser () {
		if (confirm("Remove users from project?")) {
			document.usersListForm.submit ();
		}
	}

</script>


<h1>Users for project "<?=$project->name ?>"</h1>


<?php $flash = yii::app()->user->getFlash('users_to_project', array()) ?>
<?php if (count($flash) > 0) : ?>
<?php foreach ($flash as $f) : ?>
<div class="f-message f-message-success">
	<?=$f ?>
</div>
<?php endforeach; ?>
<?php endif; ?>


<?=CHtml::form('', 'post', array('name' => 'usersListForm')) ?>

<?=CHtml::hiddenField('command', 'clear_users'); ?>

<?php $users = $project->getUsers(); ?>

<?php if (count($users) == 0) : ?>
<p>No users, use <a href="javascript:startFindUser('addUser2Project')">search</a> for add.</p>
<?php endif; ?>

<?php if (count($users) > 0) : ?>
<table class="f-table-zebra">
	<thead>
		<tr>
			<th style="width: 20px;"></th>
			<th style="width: 24px;"></th>
			<th></th>
			<th>Email</th>
		</tr>
		
	</thead>
	<tbody>
		<?php foreach ($users as $u) : ?>
		<tr>
			<td><?=CHtml::checkBox('user['.$u->id.']', 0) ?></td>
			<td style="text-align: left; vertical-align: middle;">
				<img src="<?=$u->getIcoUrl() ?>" />
			</td>
			<td style="text-align: left; vertical-align: middle;">
				<a href="<?=$this->createUrl('/user/'.$u->id); ?>">
				<?=$u->name ?>
				</a>
			</td>
			<td style="text-align: left; vertical-align: middle;">
				<a href="mailto:<?=$u->email ?>"><?=$u->email ?></a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>


<p class="f-buttons">
	<?=CHtml::button('Remove selected users', array('class' => 'f-bu f-bu-warning', 'onclick' => 'deleteUser()')) ?>
	<?=CHtml::button('Add user to project', array('class' => 'f-bu f-bu-default', 'onclick' => "startFindUser('addUser2Project')")) ?>
</p>
<?php endif; ?>

<?=Chtml::endForm() ?>


<?php $this->widget('FindUsersWidget', array ('name' => 'addUser2Project')); ?>

<?=CHtml::form('', 'post', array('name' => 'addUserForm')) ?>
<?=CHtml::hiddenField('command', 'add_user'); ?>
<?=CHtml::hiddenField('userForAdd', 0); ?>
<?=Chtml::endForm() ?>
