<div>
	<div class="issue-ico issue-ico-<?=$bug->type ?>" style="float: left; margin-right: 10px; height: 50px;">
		<div><div><?=ucfirst(IssueHelper::getIssueAbbreviation($bug->type)); ?></div></div>
	</div>

	<div class="g-8" style="float:left;">
		<h2 style="padding: 0; margin: 0; margin-top: -7px;"><b><?=$bug->title ?></b></h2>
		<div><?=ucfirst(IssueHelper::getIssueNameByType($bug->type)); ?> Issue <b>#<?=$bug->nomber ?></b> for project : <?=$project->name ?></div>
	</div>

	<div style="clear: both;"></div>
</div>

<?php $flash = yii::app()->user->getFlash('good_news'); ?>
<?php if ($flash != '') : ?>
<div class="f-message f-message-success" style="margin-top: 15px;"><?=$flash ?></div>
<?php endif; ?>


<div style="display: none;">
<?=$this->renderPartial('/issues/view/commands', array('bug'=>$bug)); ?>
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
				<td><?php $this->renderPartial ('/issues/view/assigneduser', array ('bug' => $bug, 'project' => $project)); ?></td>
			</tr>
			
			<tr>
				<td>Статус</td>
				<td>
					<?php $this->renderPartial ('/issues/view/status', array ('bug' => $bug, 'project' => $project)) ?>
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
			<tr>
				<td>Milestoun :</td>
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
	<?=nl2br($bug->description); ?>
</div>

<?php if ($bug->type == "bug") : ?>
<div class="f-message">
	<h5>Последовательность действий:</h5> 
	<?=nl2br($bug->rep_steps); ?>
</div>
<?php endif; ?>


<div>
<?php $this->renderPartial ('/issues/view/comments', array ('bug' => $bug)); ?>
</div>
