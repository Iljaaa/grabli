<div class="f-row">
	<div class="f-input">
	<div class="f-message f-message-error">
		Пользователей не найдено
	</div>
	</div>
	
	<div class="f-message">
		Не нашли пользователей на сайте, отправте приглашение 
		<?php
		$model->setScenario('secondstep');
		if ($model->validate ()) : ?>
			<div style="margin-top: 10px;">
			<?=CHtml::form('/user/sendrequest/', 'get') ?>
			<?=CHtml::hiddenField('email', $model->name); ?>
			<?=CHtml::submitButton('Отправить приглашение', array('class' => "f-bu f-bu-default")) ?>
			<?=CHtml::endForm(); ?>
			</div>
		<?php else : ?> 
			<div>
				Для этого введите Email адрес получателя предложенияб нажмите "поиск" и если пользователь не будет найден на сайте то 
				Вам будет доступна кнопка 'Отправить приглашение'
			</div>
		<?php endif; ?>
	</div>
	
</div>