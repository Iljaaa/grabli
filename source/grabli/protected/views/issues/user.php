<h1>Issues for user: <?=$user->name ?></h1>

<?php

$typs = array ('bug', 'task', 'featurerequest', 'encantment','idea', 'other');

?>

<?php $projects = $user->getProjects() ?> 

<?php foreach ($projects as $p) :  ?>

<h2>
	<i>Project:</i> <?=$p->name ?>
</h2>



<?php $bugs = $p->getActiveBugsAssignedToUser($user->id); ?>
<?php foreach ($typs as $type) : ?>

<?php 
$filtredBugs = array ();
foreach ($bugs as $b) if ($b->type == $type) $filtredBugs[] = $b;
?>

<?php if (count($filtredBugs) == 0) continue; ?>

<h3 style="display: none;">
	<div class="issue-small-ico issue-ico-<?=$type ?>" style="float: left; margin-right: 20px;">
		<div><div><?=IssueHelper::getIssueAbbreviation($type) ?></div></div>
	</div>
	<?=IssueHelper::getIssueNameByType ($type); ?>
</h3>

<?php $this->renderPartial('/issues/list', array ('bugs' => $filtredBugs)); ?>



<?php endforeach; // foreach ($typs as $type) :  ?>

<hr />
<?php endforeach; // foreach ($projects as $p) :  ?>