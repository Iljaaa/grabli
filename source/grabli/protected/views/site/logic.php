<?php foreach ($steps as $s) : ?>

<div style="margin-bottom: 20px;">
	<div>
		[<?=$s->id ?>] <b><?=$s->title ?></b> <i><?=$s->description ?></i>
	</div>
	
	<div style="padding-left: 30px;">
		<?php $subSteps = $s->getRelatedSteps() ?>
		<?php foreach ($subSteps as $subStep) : ?>
			<div>[<?=$subStep->id ?>] <b><?=$subStep->title ?></b></div>
		<?php endforeach; ?>
	</div>
</div>

<?php endforeach; ?>