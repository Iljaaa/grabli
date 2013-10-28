<h1>Registration</h1>

<?php if ($urlValid == true) : ?>
	<?=$this->renderPartial('/users/registration/form', array('model' => $model)); ?>
<?php else : ?>
	<div class="f-message f-message-error">
		<?=CHtml::error($model, "time"); ?>
		<?=CHtml::error($model, "code"); ?>
		<?=CHtml::error($model, "owner_id"); ?>
		<?=CHtml::error($model, "email"); ?>
	</div>
<?php endif; ?>