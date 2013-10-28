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
<?=$step->title  ?>
</h2>

<?php $this->renderPartial ('/bugs/list', array ('bugs' => $selectedBugs)); ?>

<?php endforeach; ?>

