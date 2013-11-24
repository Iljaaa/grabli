dfsdfdsds

<table>
	<thead>
		<tr>
			<?php foreach ($this->cols as $col) : ?>
				<?=$this->generateHeaderCell ($col); ?>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
	<?php $rows = $this->getData (); ?>
	<?php foreach ($rows as $data) : ?>
		<tr>
			<?php foreach ($this->cols as $col) :  ?>
				<?=$this->generateBodyCell ($col, $data); ?>
			<?php endforeach; ?>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>