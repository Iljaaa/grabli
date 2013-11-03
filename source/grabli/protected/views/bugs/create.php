<div style="margin-bottom: 20px;">
	<div class="issue-ico issue-ico-<?=$type ?>" style="float: left; margin-right: 20px;">
		<div><div><?=ucfirst(IssueHelper::getIssueAbbreviation($type)); ?></div></div>
	</div>

	<h1><i>Create Issue :</i> <?=ucfirst(IssueHelper::getIssueNameByType($type)); ?></h1>
	<div style="clear: both;"></div>
</div>


<?php 
$userProjects = $user->getProjects();
$projectsForSelect = array (0=>'--');
foreach ($userProjects as $p) $projectsForSelect[$p->id] = $p->name;
?>


<?php $errSummary = CHtml::errorSummary($model); ?>
<?php yii::app()->firephp->log ($errSummary, '$errSummary'); ?>
<?php if ($errSummary != '') : ?>
<div class="f-message f-message-error">
	<?=$errSummary ?>
</div>
<?php endif; ?>


<?=CHtml::beginForm(); ?>

<?=CHtml::activeHiddenField($model, 'id'); ?>
<?=CHtml::activeHiddenField($model, 'step_id') ?>
<?=CHtml::activeHiddenField($model, 'assigned_to') ?>

<?php yii::app()->firephp->log ($model->getScenario(), 'scn'); ?>

<div class="f-row">
	<div class="f-actions">
		<?=CHtml::submitButton('Save', array('class'=>'f-bu f-bu-success')); ?>
	</div>
</div>

<div class="f-row">
	<label><?=CHtml::activeLabel($model, 'project_id'); // CHtml::label(, 'Project') ?></label>
	<div class="f-input">

		<?php
		$attrs = array('class'=>'g-6');
		if ($model->getScenario() == 'create') {
			$attrs['disabled'] = 'disabled';
		}

		?>

		<?=CHtml::activeDropDownList($model, 'project_id', $projectsForSelect, $attrs); ?>
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
		<?=CHtml::activeTextField($model, 'name', array('maxlength' => 128, 'class'=>'g-6')) ?>
		<?=CHtml::error($model, "name"); ?>
	</div>
</div>


<div class="f-row">
	<?=CHtml::activeLabel($model, 'description') ?>
	<div class="f-input">
		<?=CHtml::activeTextArea($model, 'description', array('maxlength' => 2048, 'class'=>'g-6', 'style' => 'height: 150px;')) ?>
		<?=CHtml::error($model, "description"); ?>
	</div>
</div>

<?php if ($model->type == 'bug') : ?>
<div class="f-row">
	<?=CHtml::activeLabel($model, 'rep_steps') ?>
	<div class="f-input">
		<?php $data = array ('maxlength' => 2048, 'class'=>'g-6', 'style' => 'height: 150px;'); ?>
		<?php if (!$model->isPosledRequired()) $data['disabled'] = 'disabled'; ?>
		<?=CHtml::activeTextArea($model, 'rep_steps', $data) ?>
		<?=CHtml::error($model, "rep_steps"); ?>
	</div>
</div>;
<?php endif; ?>

<?=CHtml::endForm() ?>