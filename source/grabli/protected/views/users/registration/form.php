<?=CHtml::beginForm(); ?>

<div class="f-row">
	<div class="f-actions">
		<?=CHtml::submitButton('Зарегистрироваться', array('class'=>'f-bu f-bu-success')); ?>
	</div>
</div>

<div class="f-row">
	<?=CHtml::activeLabel($model, 'name') ?>
	<div class="f-input">
		<?=CHtml::activeTextField($model, 'name', array('maxlength' => 128, 'class'=>'g-6')) ?>
		<?=CHtml::error($model, "name"); ?>
	</div>
</div>


<div class="f-row" style="min-height: 28px;">
	<?=CHtml::activeLabel($model, 'email') ?>
	<div class="f-input">
		<?=CHtml::activeTextField($model, 'email', array('maxlength' => 128, 'class'=>'g-6')) ?>
		<?=CHtml::error($model, "email"); ?>
	</div>
</div>


<div class="f-row">
	<?=CHtml::activeLabel($model, 'password') ?>
	<div class="f-input">
		<?=CHtml::activePasswordField($model, 'password', array('maxlength' => 128, 'class'=>'g-6')) ?>
		<?=CHtml::error($model, "password"); ?>
	</div>
</div>

<div class="f-row">
	<?=CHtml::activeLabel($model, 'password_confirm') ?>
	<div class="f-input">
		<?=CHtml::activePasswordField ($model, 'password_confirm', array('maxlength' => 128, 'class'=>'g-6')) ?>
		<?=CHtml::error($model, "password_confirm"); ?>
	</div>
</div>


<?=CHtml::endForm() ?>