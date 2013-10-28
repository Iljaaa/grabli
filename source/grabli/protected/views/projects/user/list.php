<table class="f-table-zebra">
	<thead>
		<tr>
			<td style="width: 20px;"></td>
			<th>Проект</th>
			<th style="width: 160px;">Количество участников</th>
			<th style="width: 150px;">Количество объектов</th>
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
				<a href="<?=$this->createUrl('/project/'.$p->code); ?>#bugs">[<?=$p->bugsCount() ?>]</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>

