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



<?php $types = Type::model()->findAll(); ?>

<?php $i = 0 ?>
<?php foreach ($types as $t) : ?>
	<?php $i++; ?>
	<div style="width: 80px; text-align: center; float: left;">
		<div   class="issue-ico issue-ico-<?=$t->code ?>" style="margin: 0 auto; float: none;">
			<div><div><?=$t->abbreviation ?></div></div>
		</div>
		<div style="text-align: center; margin-top: 10px;">
			<?=$t->name ?>
		</div>
	</div>
	<?php
	if ($i == 3) {
		$i = 0;
		echo '</tr><tr>';
	}
endforeach; ?>


<div style="clear: both;"></div>