<table class="f-table-zebra">
	<thead>
		<tr>
			<th style="width: 20px;"></th>
			<th>Project</th>
			<th style="width: 75px; text-align: center">Users</th>
			<th style="width: 75px; text-align: center">Issues</th>
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
			<td style="text-align: center;">
				<a href="<?=$this->createUrl('/project/'.$p->code); ?>#users">[<?=$p->usersCount(); ?>]</a>
			</td>
			<td style="text-align: center;">
				<a href="<?=$this->createUrl('/project/'.$p->code); ?>#bugs">[<?=$p->issuesCount() ?>]</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>

