<h1>Восстановление пароля</h1>

<?php if (isset($_GET['emailsended'])) : ?>

	<div class="f-message f-message-success">
		Новый пароль отправлен.
	</div>
	
<?php else : ?>

	<div class="f-message">
		Для восстановления пароля введите Email указанный при регистрации
	</div>

	<?=CHtml::beginForm(); ?>
	
	<div class="f-row">
		<?=CHtml::activeLabel($model, 'email') ?>
		<div class="f-input">
			<?=CHtml::activeTextField($model, 'email', array('maxlength' => 128, 'class'=>'g-5')) ?>
			<?=CHtml::error($model, "email"); ?>
		</div>
	</div>
	
	
	<div class="f-row">
		<div class="f-actions">
			<?=CHtml::submitButton('Восстановить', array('class'=>'f-bu f-bu-success')); ?>
		</div>
	</div>
	
	
	<?=CHtml::endForm() ?>
	
<?php endif; ?>