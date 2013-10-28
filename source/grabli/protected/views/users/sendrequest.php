<h1>Приглашение новых пользователей</h1>

<?php $emailsended = yii::app()->request->getParam('emailsended', 0); ?>
<?php if (isset($emailsended) && $emailsended == 1) :  ?>
	<?php $this->renderPartial ('/users/sendrequest/request_sended', array ('model'=>$model)); ?>
<?php else : ?>
	<?php $this->renderPartial ('/users/sendrequest/request_form', array ('model'=>$model)); ?>
<?php endif; ?>