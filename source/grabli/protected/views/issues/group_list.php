<?php
$steps = Step::model()->getOrderSteps(); ?>
<?php

foreach ($steps as $step) : 

	$selectedBugs = array ();
	foreach ($bugs as $b){
		if ($b->steps_id == $step->id) $selectedBugs[] = $b;
	}

	if (count($selectedBugs) == 0) continue;

?>

<h2 style="padding: 0px;">
	<div style="float: left; width: 23px; height: 23px; background-color: <?=$step->color ?>; margin: 4px 10px 0 0; border: solid 2px gray;">
	</div>
<?=$step->name  ?>
</h2>

<?php
$data = array ('bugs' => $selectedBugs);
if (isset($direction)) $data['direction'] = $direction;
if (isset($sorting)) $data['sorting'] = $sorting;
?>

<?php $this->renderPartial ('/issues/list', $data); ?>

<?php endforeach; ?>

