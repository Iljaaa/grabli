<table class="f-table-zebra">
	<thead>
		<tr>
			<th style="width: 20px;"></th>
			<th>Project</th>
			<th style="width: 100px;">Owner</th>
			<th style="width: 75px; text-align: center">Users</th>
			<th style="width: 75px; text-align: center" title="open/all">Issues *</th>
		</tr>
		
	</thead>
	<tbody>
		<?php foreach ($projects as $p) : ?>
		<tr>
			<td>
				<img src="/images/icons/project.png" />
			</td>
			<td>
				<a href="<?=$this->createUrl('/project/'.$p->code); ?>">
				<?=$p->name ?> (<?=$p->code ?>)
				</a>
			</td>
			<td>
				<?php $this->widget ('ShowUserWidget', array('user' => $p->getOwner())) ?>
			</td>
			<td style="text-align: center;">
				<?=$p->usersCount(); ?>
			</td>
			<td style="text-align: center;">
				<a href="<?=$this->createUrl('/project/'.$p->code.'/issues'); ?>"><?=$p->getOpenIssuesCount() ?></a>
				/
				<a href="<?=$this->createUrl('/project/'.$p->code.'/issues'); ?>"><?=$p->getIssuesCount() ?></a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>

