<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<div class="f-row">
	<?php echo $form->labelEx($model,'username'); ?>
	<div class="f-input">
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

</div>

<div class="f-row">
	<?php echo $form->labelEx($model,'password'); ?>
	<div class="f-input">
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
</div>

<div class="f-row">
	<?php echo $form->label($model,'rememberMe'); ?>
	<div class="f-input">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
</div>

<div class="f-row">
	<div class="f-actions">
		<?php echo CHtml::submitButton('Login', array('class' => 'f-bu f-bu-success')); ?>
		&nbsp;&nbsp;&nbsp;
		<a href="<?=$this->createUrl('/users/restore/') ?>">Restore passowrd</a>
	</div>

<?php $this->endWidget(); ?>
</div>

<p style="margin-top: 20px;">

</p>


