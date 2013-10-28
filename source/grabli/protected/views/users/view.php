<?=$this->renderPartial('/users/view/info', array('user' => $user)); ?>


<h2>Участие в проектах</h2>
<?php $projects = $user->getProjects() ?>
<?=$this->renderPartial('/projects/user/list', array('projects' => $projects)); ?>

<h2>Таски по проектам</h2>

<?php $userBugs = $user->getBugs (); ?>
<?=$this->renderPartial ('/bugs/list', array ('bugs' => $userBugs)); ?>


