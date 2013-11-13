<?php if (isset($errors) && count($errors) > 0) :  ?>
	<ul>
		<?php foreach ($errors as $e) : ?>
			<li class="error"><?=$e ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>


<?php $blockName = yii::app()->getRequest()->getParam('name', ''); ?>
<?php if (isset($foundUsers) && count($foundUsers) > 0) :  ?>
	<?php foreach ($foundUsers as $u) : ?>
	<?php
		$url = 'javascript:setUser(';
		$url .= $u->id;
		if ($blockName != '') $url .= ', \''.$blockName.'\' ';
		$url .= ')';
	?>

	<a href="<?=$url ?>" style="display: block; margin-bottom: 3px;">
		<div style="height: 20px; display: table-cell; vertical-align: middle;">
			<img src="<?=$u->getIcoUrl(); ?>" style="margin-right: 10px;" />
		</div>
		<div style="display: table-cell; vertical-align: middle;">
			<?=$u->name ?>
		</div>
	</a>
	<?php endforeach; ?>

<?php else : ?>

	<?php if (!isset($errors) || count($errors) == 0) :  ?>
		<ul><li class="error">Users not found</li></ul>
	<?php endif; ?>

<?php endif; ?>