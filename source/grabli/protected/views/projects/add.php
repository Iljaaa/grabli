<h1><i>Create project</i></h1>

<?=CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="f-row">
	<div class="f-actions">
		<?=CHtml::submitButton('Save', array('class'=>'f-bu f-bu-success')); ?>
	</div>
</div>



<div class="f-row">
	<label><?=CHtml::label('id', 'id') ?></label>
	<div class="f-input">
		<?=CHtml::activeTextField ($model, 'id', array('class'=>'g-1')) ?>
		<?=CHtml::error($model, "id"); ?>
	</div>
</div>

<div class="f-row">
	<?=CHtml::activeLabel($model, 'owner_id') ?>
	<div class="f-input">
		<?=CHtml::activeTextField($model, 'owner_id', array('maxlength' => 128, 'class'=>'g-1')) ?>
		<?=CHtml::error($model, "owner_id"); ?>
	</div>
</div>


<div class="f-row">
	<?=CHtml::activeLabel($model, 'name') ?>
	<div class="f-input">
		<?=CHtml::activeTextField($model, 'name', array('maxlength' => 128, 'style'=>'width: 470px;')) ?>
		<?=CHtml::error($model, "name"); ?>
	</div>
</div>

<div class="f-row">
	<?=CHtml::activeLabel($model, 'code') ?>
	<div class="f-input">
		<?=CHtml::activeTextField($model, 'code', array('maxlength' => 128, 'style'=>'width: 470px;')) ?>
		<?=CHtml::error($model, "code"); ?>
		<p class="f-input-help">
			Просто украшательство. Служит что бы вы могли получить доступ к проекту используя красивый урл :<br /><i>http://<?=$_SERVER['HTTP_HOST']; ?>/project/myproject</i>
		</p>
	</div>
	
</div>

<div class="f-row">
	<?=CHtml::activeLabel($model, 'description') ?>
	<div class="f-input">
		<?=CHtml::activeTextArea($model, 'description', array('maxlength' => 2048, 'class'=>'g-7', 'style' => 'height: 150px;')) ?>
		<?=CHtml::error($model, "description"); ?>
	</div>
</div>

<?=CHtml::endForm() ?>