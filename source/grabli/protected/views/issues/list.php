<style>
	.issues-list tbody tr td {
		vertical-align: middle;
	}
</style>

<table class="f-table-zebra issues-list">
	<thead>
		<tr>
			<th style="width: 20px; text-align: center;">#</th>
			<th style="width: 10px; text-align: center;"></th>
			<th>Object</th>
			<th style="width: 100px; text-align: left;">Posted by</th>
			<th style="width: 20px; text-align: center;">to</th>
			<th style="width: 100px; text-align: left;">Assigned to</th>
			<th style="width: 100px; text-align: center;">Шаг</th>
		</tr>
		
	</thead>
	<tbody>
		<?php foreach ($bugs as $b) : ?>
		<tr>
			<td>
				<div class="issue-small-ico issue-ico-<?=$b->type ?>">
					<div><div><?=ucfirst(IssueHelper::getIssueAbbreviation($b->type)); ?></div></div>
				</div>
			</td>
			<td style="text-align: center;">
				<?=$b->nomber ?>
			</td>
			<td>
				<a href="<?=$this->createUrl('/issue/'.$b->getProject()->code.'/'.$b->nomber); ?>">
					<?=$b->title ?></a>
			</td>
			<td>
				<?php $owner = $b->getOwner(); 
				if ($owner != null) : 
				?>
					<?php $this->widget('ShowUserWidget', array('user' => $owner)); ?>
				<?php endif; ?>
			</td>
			<td style="text-align: center;">to</td>
			<td>
				<?php $owner = $b->getAssigned(); 
				if ($owner != null) : 
				?>
					<?php $this->widget('ShowUserWidget', array('user' => $owner)); ?>
				<?php endif; ?>
			
			</td>

			<td style="text-align: center;">
				<?=$b->getStep()->title ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>
