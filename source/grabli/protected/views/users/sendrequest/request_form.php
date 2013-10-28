<?=CHtml::beginForm($this->createUrl('/users/sendrequest/'), 'get'); ?>

<?php if (isset($showform) && $showform) : ?>

		<?=CHtml::activeEmailField($model, 'name'); ?>
		
<?php else : ?>
	
	<?=CHtml::hiddenField('email', $model->name); ?>
	
	<?php $model->setScenario ('secondstep'); ?>
	<?php if ($model->validate()) : ?>
	
		<?=CHtml::hiddenField('submitSend', '1'); ?>
		<div class="f-message">
			<div style="margin: 20px 0; font-size: 200%; text-align: center;">
				Отправить приглашение на адрес: 
			
			</div>
			
			<div style="font-size: 200%; text-align: center;">
			<strong><?=$model->name ?></strong>
			</div>
	
			<div style="margin: 20px 0; text-align: center;">
			<?=CHtml::submitButton('Отправить приглашение', array ('class'=> "f-bu f-bu-default", 'style'=>'font-size: 200%')) ?>
			</div>
		</div>
	
	<?php else : ?>
		<div class="f-message f-message-error">
			Введен не верный email адрес: <?=$model->name ?>
		</div>
	<?php endif; ?>
	
<?php endif; ?>



<?=CHtml::endForm() ?>