<h1>Задачи для пользователя: <?=$user->name ?></h1>

<?php

$typs = array ('bug', 'task', 'featurerequest', 'encantment','idea', 'other');

?>

<?php $projects = $user->getProjects() ?> 

<?php foreach ($projects as $p) :  ?>
<h2><i>Проект:</i> <?=$p->name ?></h2>

<?php $bugs = $p->getActiveBugsAssignedToUser($user->id); ?>
<?php 

foreach ($typs as $type) :
?>

<?php 
$filtredBugs = array ();
foreach ($bugs as $b) if ($b->type == $type) $filtredBugs[] = $b;
?>

<?php if (count($filtredBugs) == 0) continue; ?>
<h3><?=$type ?></h3>
<?php $this->renderPartial('/bugs/list', array ('bugs' => $filtredBugs)); ?>

<?php endforeach; ?>
<?php endforeach; ?>