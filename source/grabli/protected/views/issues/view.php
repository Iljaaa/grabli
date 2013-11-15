<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/popup.js'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/issue_view.js'); ?>

<?=CHtml::hiddenField('issue-id', $bug->id) ?>

<div class="f-row">
	<div class="issue-ico issue-ico-<?=$bug->type ?>" style="float: left; margin-right: 10px; height: 50px;">
		<div><div><?=ucfirst(IssueHelper::getIssueAbbreviation($bug->type)); ?></div></div>
	</div>

	<div class="g-8" style="float:left;">
		<h2 style="padding: 0; margin: 0; margin-top: -7px;"><b><?=$bug->title ?></b></h2>
		<div><?=ucfirst(IssueHelper::getIssueNameByType($bug->type)); ?> Issue <b>#<?=$bug->number ?></b> for project : <?=$project->name ?></div>
	</div>

	<div style="clear: both;"></div>
</div>

<?php $flash = yii::app()->user->getFlash('good_news'); ?>
<?php if ($flash != '') : ?>
<div class="f-message f-message-success" style="margin-top: 15px;"><?=$flash ?></div>
<?php endif; ?>

<?php $flash = yii::app()->user->getFlash('issue-command-goodnews'); ?>
<?php if ($flash != '') : ?>
	<div class="f-message f-message-success" style="margin-top: 15px;"><?=$flash ?></div>
<?php endif; ?>

<?php $flash = yii::app()->user->getFlash('issue-command-badnews'); ?>
<?php if ($flash != '') : ?>
	<div class="f-message f-message-error" style="margin-top: 15px;"><?=$flash ?></div>
<?php endif; ?>


<div  style="padding-top: 15px">
<?=$this->renderPartial('/issues/view/commands', array('issue'=>$bug, 'project' => $project)); ?>
</div>



<div class="g-row" style="margin-top: 0px;">
	<div class="g-5">
		<?=$this->renderPartial('/issues/view/data', array('issue'=>$bug, 'project' => $project)); ?>
	</div>
	<div class="g-4">
		<?=$this->renderPartial('/issues/view/life', array('issue' => $bug, 'project' => $project)); ?>
	</div>
</div>






<div class="f-message">
	<h5>Description</h5>
	<?php if ($bug->description != '') : ?>
		<?=nl2br($bug->description); ?>
	<?php else : ?>
		<i>Description not setted</i>
	<?php endif; ?>
</div>

<?php if ($bug->type == "bug") : ?>
<div class="f-message">
	<h5>Reproducing steps:</h5>
	<?php if ($bug->rep_steps != '') : ?>
		<?=nl2br($bug->rep_steps); ?>
	<?php else : ?>
		<i>Reproducing steps not setted</i>
	<?php endif; ?>
</div>
<?php endif; ?>


<div>
<?php $this->renderPartial ('/issues/view/comments', array ('bug' => $bug)); ?>
</div>
