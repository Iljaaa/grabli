<?=CHtml::beginForm(); ?>

<?=CHtml::error($model, "time"); ?>
<?=CHtml::error($model, "code"); ?>

<div class="f-row">
	<div class="f-actions">
		<?=CHtml::submitButton('Зарегистрироваться', array('class'=>'f-bu f-bu-success')); ?>
	</div>
</div>

<div class="f-row">
	<?=CHtml::activeLabel($model, 'owner_id') ?>
	<div class="f-input">
		<?=CHtml::activeHiddenField($model, 'owner_id'); ?>
		
		<?php
			$user = User::model()->findByPk ($model->owner_id);
			if ($user != null) $this->renderPartial('/users/user_block', array('user' => $user));
		?>
		<?=CHtml::error($model, "owner_id"); ?>
	</div>
</div>


<div class="f-row">
	<?=CHtml::activeLabel($model, 'name') ?>
	<div class="f-input">
		<?=CHtml::activeTextField($model, 'name', array('maxlength' => 128, 'class'=>'g-7')) ?>
		<?=CHtml::error($model, "name"); ?>
	</div>
</div>


<div class="f-row" style="min-height: 28px;">
	<?=CHtml::activeLabel($model, 'email') ?>
	<div class="f-input">
		<?=CHtml::activeHiddenField($model, 'email'); ?>
		<div style="padding-top: 5px;">
			<?=CHtml::label($model->email, 'dasas', array())  ?>
		</div>
		<?=CHtml::error($model, "email"); ?>
	</div>
</div>


<div class="f-row">
	<?=CHtml::activeLabel($model, 'password') ?>
	<div class="f-input">
		<?=CHtml::activePasswordField($model, 'password', array('maxlength' => 128, 'class'=>'g-7')) ?>
		<?=CHtml::error($model, "password"); ?>
	</div>
</div>

<div class="f-row">
	<?=CHtml::activeLabel($model, 'password_confirm') ?>
	<div class="f-input">
		<?=CHtml::activePasswordField ($model, 'password_confirm', array('maxlength' => 128, 'class'=>'g-7')) ?>
		<?=CHtml::error($model, "password_confirm"); ?>
	</div>
</div>


<?=CHtml::endForm() ?>