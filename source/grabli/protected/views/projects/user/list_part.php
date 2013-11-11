<table class="f-table-zebra">
	<thead>
		<tr>
			<th>Проект</th>
			<th style="width: 160px;">Владелец</th>
			<th style="width: 160px;">Количество участников</th>
			<th style="width: 150px;">Количество объектов</th>
		</tr>
		
	</thead>
	<tbody>
		<?php foreach ($projects as $p) : ?>
		<tr>
			<td>
				<a href="<?=$this->createUrl('/project/'.$p->code); ?>">
				<?=$p->name ?> (<?=$p->code ?>)
				</a>
			</td>
			<td>
				<a href="<?=$this->createUrl('/user/'.$p->getOwner()->id); ?>">
				<?=$p->getOwner()->name ?>
				</a>
			</td>
			<td style="text-align: center;">
				<a href="<?=$this->createUrl('/project/'.$p->code); ?>#users">[<?=$p->usersCount(); ?>]</a>
			</td>
			<td style="text-align: center;">
				<a href="<?=$this->createUrl('/project/'.$p->code); ?>#bugs">[<?=$p->getOpenIssuesCount() ?>/<?=$p->bugsCount() ?>]</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>

