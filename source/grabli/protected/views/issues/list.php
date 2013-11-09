<style>
	.issues-list tbody tr td {
		vertical-align: middle;
	}

	.arrow {
		width: 17px;
		height: 16px;
		background-image: url(/images/sort_arrows.png);
		background-position: -40px 0px;
		display: inline-block;
		padding-top: 1px;
	}

	.arrow-down {
		background-position: -20px 0px;
	}

	.arrow-up {
		background-position: 0px 0px;
	}

</style>

<table class="f-table-zebra issues-list">
	<thead>
		<tr>
			<th style="width: 20px; text-align: center;"></th>
			<th style="width: 40px; text-align: center;">
				#
				<?php
				$class = "arrow";
				if (isset($sorting) && $sorting == 'number') {
					if (isset($direction) && $direction == 'asc') {
						$class .= ' arrow-up';
						$direction = 'desc';
					}
					else {
						$class .= ' arrow-down';
						$direction = 'asc';
					}
				}
				?>
				<a href="javascript:setSort('number', '<?=$direction ?>')" style="float:right;" class="<?=$class ?>"></a>
			</th>
			<th>
				Object
				<?php
				$class = "arrow";
				if (isset($sorting) && $sorting == 'title') {
					if (isset($direction) && $direction == 'asc') {
						$class .= ' arrow-up';
						$direction = 'desc';
					}
					else {
						$class .= ' arrow-down';
						$direction = 'asc';
					}
				}
				?>
				<a href="javascript:setSort('title', '<?=$direction ?>')" style="float:right;" class="<?=$class ?>"></a>
			</th>
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
				<b><?=$b->number ?></b>
			</td>
			<td>
				<a href="<?=$this->createUrl('/issue/'.$b->getProject()->code.'/'.$b->number); ?>">
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
