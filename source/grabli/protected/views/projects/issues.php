<h1><i style="font-weight: noraml;">Issues for project :</i> <?=$project->name ?></h1>

<div class="f-row">
<?php $this->renderPartial('/projects/issues/filter', array('form' => $form)); ?>
</div>


<?php if (count($bugs) > 0) : ?>

	<?php $pagesCount = ceil($count / $form->pagesize); ?>
	<?php if ($pagesCount > 1) : ?>
		<div class="f-row">
		<?php $this->renderPartial ('/projects/issues/issues_pagenator', array('count' => $count, 'pagesize' => $form->pagesize, 'page' => $form->page)); ?>
		</div>
	<?php endif; ?>

	<?php if ($form->show == 'list') : ?>
		<?=$this->renderPartial('/issues/list', array ('bugs' => $bugs, 'sorting' => $form->sorting, 'direction' => $form->direction)); ?>
	<?php else : ?>
		<?=$this->renderPartial('/issues/group_list', array ('bugs' => $bugs, 'sorting' => $form->sorting, 'direction' => $form->direction)); ?>
	<?php endif; ?>

<?php else : ?>
	<h2>No issues for show</h2>
<?php endif; ?>
