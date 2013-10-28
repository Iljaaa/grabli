<h1><i>Create Issue :</i> <?=ucfirst($type) ?></h1>

<?php 

$userProjects = $user->getProjects();
$projectsForSelect = array (0=>'--');
foreach ($userProjects as $p){
	$projectsForSelect[$p->id] = $p->name;
}

?>


<?=CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>


<?=CHtml::activeHiddenField($model, 'id'); ?>
<?=CHtml::activeHiddenField($model, 'step_id') ?>
<?=CHtml::activeHiddenField($model, 'assigned_to') ?>

<?php // CHtml::error($model, "id"); ?>
<?php // CHtml::error($model, "step_id"); ?>
<?php // CHtml::error($model, "assigned_to"); ?>


<div class="f-row">
	<div class="f-actions">
		<?=CHtml::submitButton('Save', array('class'=>'f-bu f-bu-success')); ?>
	</div>
</div>

<div class="f-row">
	<label><?=CHtml::label('project_id', 'project_id') ?></label>
	<div class="f-input">
		<?=CHtml::activeDropDownList($model, 'project_id', $projectsForSelect, array('class'=>'g-5')); ?>
		<?=CHtml::error($model, "project_id"); ?>
	</div>
</div>

<div class="f-row">
	<?=CHtml::activeLabel($model, 'owner_id') ?>
	<div class="f-input">
		<?php $this->widget('ShowUserWidget', array('user_id' => $model->owner_id)); ?>
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
	<?=CHtml::activeLabel($model, 'description') ?>
	<div class="f-input">
		<?=CHtml::activeTextArea($model, 'description', array('maxlength' => 2048, 'class'=>'g-7', 'style' => 'height: 150px;')) ?>
		<?=CHtml::error($model, "description"); ?>
	</div>
</div>

<?php if ($model->type == 'bug') : ?>
<div class="f-row">
	<?=CHtml::activeLabel($model, 'posled') ?>
	<div class="f-input">
		<?php $data = array ('maxlength' => 2048, 'class'=>'g-7', 'style' => 'height: 150px;'); ?>
		<?php if (!$model->isPosledRequired()) $data['disabled'] = 'disabled'; ?>
		<?=CHtml::activeTextArea($model, 'posled', $data) ?>
		<?=CHtml::error($model, "posled"); ?>
	</div>
</div>;
<?php endif; ?>

<?=CHtml::endForm() ?>