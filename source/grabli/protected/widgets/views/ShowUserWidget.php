<span style="height: 20px; display: inline-block;">
	<img src="<?=$user->getIcoUrl(); ?>" />
	<a href="<?=yii::app()->controller->createUrl('/user/'.$user->id); ?>" style="text-decoration: none;">
		<?=$user->name ?>
	</a>
</span>&nbsp;&nbsp;