<h1><?=$user->name ?></h1>

<div class="g-row">
	<div class="g-5">
		<div style="padding: 10px; border: solid 1px gray; width: 64px; float: left; height: 64px;">
			<img src="<?=$user->getAvataraUrl(); ?>" />
		</div>

		<div style="float: left; margin-left: 10px;">

			<div>
				Email : <?=$user->email ?>
			</div>

			<?php if ($user->id == yii::app()->user->getId()) : ?>
			<div style="margin-top: 5px;">
				Password : ****
				<a href="javascript:alert('Change password');">change password</a>
			</div>
			<?php endif; ?>
		</div>

		<br style="clear: both;" />
	</div>

	<?php if ($user->id == yii::app()->user->getId()) : ?>
	<div class="g-3">
		<?=CHtml::beginForm('', 'post', array('enctype' => 'multipart/form-data')) ?>
		<?=Chtml::fileField('avatar') ?>
		<?=Chtml::submitButton('Upload avatar', array('class' => 'f-bu f-bu-success')) ?>
		<?=Chtml::endForm() ?>
	</div>
	<?php endif; ?>

</div>


