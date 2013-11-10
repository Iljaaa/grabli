<table class="f-table-zebra" style="margin-top: 0">
	<tbody>

	<tr>
		<td style="width: 105px;">Project</td>
		<td>
			<a href="<?=$this->createUrl('/project/'.$project->code); ?>"><?=$project->name ?></a>
		</td>
	</tr>

	<tr>
		<td>Owner</td>
		<td><?php $this->widget('ShowUserWidget', array('user' => $issue->getOwner())); ?></td>
	</tr>
	<tr>
		<td>Assignet to</td>
		<td><?php $this->renderPartial ('/issues/view/assigneduser', array ('bug' => $issue, 'project' => $project)); ?></td>
	</tr>

	<tr>
		<td>Status</td>
		<td>
			<?php $this->renderPartial ('/issues/view/status', array ('bug' => $issue, 'project' => $project)) ?>
		</td>
	</tr>

	<tr>
		<td>Dedline :</td>
		<td>
			<?php $this->renderPartial ('/issues/view/deadline', array ('bug' => $issue, 'project' => $project)) ?>
		</td>
	</tr>

	<tr>
		<td>Milestone :</td>
		<td>
			---
		</td>
	</tr>

	<tr>
		<td>Create date :</td>
		<td>
			<?php if ($issue->added_date == 0) : ?>
				<i>unknown</i>
			<?php else : ?>
				<?=date('d.m.Y H.s', $issue->added_date); ?>
			<?php endif; ?>
		</td>
	</tr>

	<tr>
		<td>Last activity :</td>
		<td>
			<?php if ($issue->last_activity == 0) : ?>
				<i>unknown</i>
			<?php else : ?>
				<?=date('d.m.Y H.s', $issue->last_activity); ?>
			<?php endif; ?>
		</td>
	</tr>

	</tbody>

</table>