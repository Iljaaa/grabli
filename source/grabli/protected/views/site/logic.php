<?php foreach ($steps as $s) : ?>

<div style="margin-bottom: 20px;">
	<div>
		[<?=$s->id ?>] <b><?=$s->name ?></b> <i><?=$s->description ?></i>
	</div>
	
	<div style="padding-left: 30px;">
		<?php $subSteps = $s->getRelatedSteps() ?>
		<?php foreach ($subSteps as $subStep) : ?>
			<div>[<?=$subStep->id ?>] <b><?=$subStep->name ?></b></div>
		<?php endforeach; ?>
	</div>
</div>

<?php endforeach; ?>



<?php /*
<p class="f-buttons">
	Create: &nbsp;&nbsp;&nbsp;
	<span class="f-bu">
		<a href="<?=$this->createUrl('/issues/create/'.$project->code.'/bug') ?>" class="f-bu-bug">
			Issue
		</a>
	</span>

	<span class="f-bu">
		<a href="<?=$this->createUrl('/issues/create/'.$project->code.'/encantment') ?>"  class="f-bu-enhancement">
			Enhancement</a>
	</span>

	<span class="f-bu">
		<a href="<?=$this->createUrl('/issues/create/'.$project->code.'/task') ?>" class="f-bu-task">
			Task</a>
	</span>

	<span class="f-bu">
		<a href="<?=$this->createUrl('/issues/create/'.$project->code.'/featurerequest') ?>" class="f-bu-featurerequest">
			Feature Request</a>
	</span>


	<span class="f-bu">
		<a href="<?=$this->createUrl('/issues/create/'.$project->code.'/idea') ?>" class="f-bu-idea">
			Idea</a>
	</span>

	<span class="f-bu">
		<a href="<?=$this->createUrl('/issues/create/'.$project->code.'/other'); ?>" class="f-bu-other">
			Other</a>
	</span>
</p> */ ?>


<div>
	<a href="#" class="issue-ico issue-ico-red" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-orange" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-purple" style="margin-left: 5px;">
		<div><div>
				C
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-pr" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-navy" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-blue" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-light-blue" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-c3" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<a href="#" class="issue-ico issue-ico-c4" style="margin-left: 5px;">
		<div><div>
				B
			</div></div>
	</a>
	<div style="clear: both;"></div>
</div>