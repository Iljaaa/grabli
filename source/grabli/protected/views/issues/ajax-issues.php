<?php if (isset($errors) && count($errors) > 0) :  ?>
	<ul>
		<?php foreach ($errors as $e) : ?>
			<li class="error"><?=$e ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>


<?php $blockName = yii::app()->getRequest()->getParam('name', ''); ?>
<?php if (isset($foundIssues) && count($foundIssues) > 0) :  ?>
	<?php foreach ($foundIssues as $u) : ?>
		<?php
		$url = 'javascript:setIssue(';
		$url .= $u->id;
		if ($blockName != '') $url .= ', \''.$blockName.'\' ';
		$url .= ')';
		?>

		<a href="<?=$url ?>" style="display: block; margin-bottom: 14px;">
			<div class="issue-small-ico issue-ico-<?=$u->type ?>" style="float: left; margin-right: 5px;">
				<div><div><?=IssueHelper::getIssueAbbreviation($u->type) ?></div></div>
			</div>
			<div style="display: table-cell; vertical-align: middle; overflow: hidden; max-width: 250px;">
				<nobr>#<?=$u->number ?> <?=$u->title ?></nobr>
			</div>
		</a>
	<?php endforeach; ?>

<?php else : ?>

	<?php if (!isset($errors) || count($errors) == 0) :  ?>
		<ul><li class="error">Issues not found</li></ul>
	<?php endif; ?>

<?php endif; ?>