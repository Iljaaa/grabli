<table class="f-table-zebra">
	<thead>
		<tr>
			<td style="width: 20px;"></td>
			<th>User name</th>
			<th>User email</th>
		</tr>
		
	</thead>
	<tbody>
		<?php foreach ($users as $u) : ?>
		<tr>
			<td><img src="<?=$u->getAvataraUrl(); ?>" /></td>
			<td><?=$u->name ?></td>
			<td><?=$u->email ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>

