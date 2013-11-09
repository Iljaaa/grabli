<?=CHtml::beginForm(); ?>

<div class="f-row">
	<div class="f-actions">
		<?=CHtml::submitButton('Зарегистрироваться', array('class'=>'f-bu f-bu-success')); ?>
	</div>
</div>

<div class="f-row">
	<?=CHtml::activeLabel($model, 'name') ?>
	<div class="f-input">
		<?=CHtml::activeTextField($model, 'name', array('maxlength' => 128, 'class'=>'g-5')) ?>
		<?=CHtml::error($model, "name"); ?>
		<span class="f-input-comment">
			You name on system
		</span>
	</div>

</div>


<div class="f-row" style="min-height: 28px;">
	<?=CHtml::activeLabel($model, 'email') ?>
	<div class="f-input">
		<?=CHtml::activeTextField($model, 'email', array('maxlength' => 128, 'class'=>'g-4')) ?>
		<?=CHtml::error($model, "email"); ?>
		<span class="f-input-comment">
			Using for login, restore personal data and get notifications
		</span>
	</div>
</div>


<div class="f-row">
	<?=CHtml::activeLabel($model, 'password') ?>
	<div class="f-input">
		<?=CHtml::activePasswordField($model, 'password', array('maxlength' => 128, 'class'=>'g-4')) ?>
		<?=CHtml::error($model, "password"); ?>
		<span class="f-input-comment">
			Min 3 symbols but we recomend 6 symbols
		</span>
	</div>

</div>

<div class="f-row">
	<?=CHtml::activeLabel($model, 'password_confirm') ?>
	<div class="f-input">
		<?=CHtml::activePasswordField ($model, 'password_confirm', array('maxlength' => 128, 'class'=>'g-4')) ?>
		<?=CHtml::error($model, "password_confirm"); ?>
	</div>
</div>


<?=CHtml::endForm() ?>