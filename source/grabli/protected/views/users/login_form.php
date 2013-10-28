<div>
	<h2>Авторизоция</h2>

	<?=CHtml::beginForm($this->createUrl('/site/login/'), 'post') ?>
	<div>
		<?=CHtml::label('Email', '') ?><br />
		<?=CHtml::textField('LoginForm[username]', yii::app()->request->getParam ('login')) ?>
	</div>

	<div style="padding: 10px 0">
		<?=CHtml::label('Password', '') ?>
		<?=CHtml::passwordField('LoginForm[password]') ?>
	</div>

	<div>
		<?php 
			$rememberParam = yii::app()->request->getParam('rememberme'); 
		?>
		<?=CHtml::checkBox('LoginForm[rememberMe]', $rememberParam) ?>
		<?=CHtml::label('Remember Me', 'LoginForm[rememberMe]') ?>
	</div>

	<div style="margin: 10px 0;">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>
	<?=CHtml::endForm(); ?>
	
</div>

<div>
<a href="<?=$this->createUrl('/users/restore/') ?>">Восстановление пароля</a><br />
<a href="<?=$this->createUrl('/users/restore/') ?>">Регистрация</a>
</div>
