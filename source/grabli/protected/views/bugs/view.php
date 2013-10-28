<h1 style="font-weight: normal;">
<?=ucfirst($bug->type) ?> #<b><?=$bug->nomber ?></b> : "<b><?=$bug->title ?></b>"
 for project : <?=$project->name ?>
</h1>

<?php $flash = yii::app()->user->getFlash('good_news'); ?>
<?php if ($flash != '') : ?>
<div class="f-message f-message-success"><?=$flash ?></div>
<?php endif; ?>


<div style="display: none;">
<?=$this->renderPartial('/bugs/view/commands', array('bug'=>$bug)); ?>
</div>

<div class="g-row" style="margin-top: 0px;">
	<div class="g-5">
	
	<table class="f-table-zebra">
		<tbody>
			<tr>
				<td style="width: 105px;">Проект</td>
				<td>
					<a href="<?=$this->createUrl('/project/'.$project->code); ?>"><?=$project->name ?></a>
				</td>
			</tr>
			<tr>
				<td>Владелец</td>
				<td><?php $this->widget('ShowUserWidget', array('user' => $bug->getOwner())); ?></td>
			</tr>
			<tr>
				<td>Ответственный</td>
				<td><?php $this->renderPartial ('/bugs/view/assigneduser', array ('bug' => $bug, 'project' => $project)); ?></td>
			</tr>
			
			<tr>
				<td>Статус</td>
				<td>
					<?php $this->renderPartial ('/bugs/view/status', array ('bug' => $bug, 'project' => $project)) ?>
				</td>
			</tr>
	
		</tbody>
	
	</table>
	
	</div>
	<div class="g-4"> 
	
	<table class="f-table-zebra">
		<tbody>
			<tr>
				<td style="width: 105px;">Create date :</td>
				<td>
					<?php if ($bug->added_date == 0) : ?>
						<i>unknown</i>
					<?php else : ?>
						<?=date('d.m.Y H.s', $bug->added_date); ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td>Dedline :</td>
				<td>
					<?php if ($bug->dedline_date == 0) : ?>
						<i>not setted</i>
					<?php else : ?>
						<?=date('d.m.Y H.s', $bug->dedline_date); ?>
					<?php endif; ?>
				</td>
			</tr>
	
		</tbody>
	
	</table>
	
	</div>
</div>






<div class="f-message">
	<h5>Описание</h5>
	<?=$bug->description ?>
</div>

<?php if ($bug->type == "bug") : ?>
<div class="f-message">
	<h5>Последовательность действий:</h5> 
	<?=$bug->posled ?>
</div>
<?php endif; ?>


<div>
<?php $this->renderPartial ('/bugs/view/comments', array ('bug' => $bug)); ?>
</div>
