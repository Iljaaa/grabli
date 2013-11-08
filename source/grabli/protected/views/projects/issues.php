<h1>Issues for project: <?=$project->name ?></h1>

<?=$count ?>

<div>
<?php $this->renderPartial('/projects/issues/filter', array('form' => $form)); ?>
</div>



<?php yii::app()->firephp->log ($form->show); ?>
<?php if (count($bugs) > 0) : ?>
	<?php if ($form->show == 'list') : ?>
		<?=$this->renderPartial('/issues/list', array ('bugs' => $bugs)); ?>
	<?php else : ?>
		<?=$this->renderPartial('/issues/group_list', array ('bugs' => $bugs)); ?>
	<?php endif; ?>
<?php else : ?>
	<p>Нет задач</p>
<?php endif; ?>