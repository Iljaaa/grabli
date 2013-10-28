<h1><i style="font-weight: normal;">Projects for user : </i><?=$user->name ?> projects</h1>
<hr />


<p class="f-buttons">
	<strong>
		Участник следйющих проектов 
	</strong>
</p>


<?php if (count($projects) > 0) : ?>

	<?php $this->renderPartial ('/projects/user/list', array ('projects'=>$projects, 'user' => $user)); ?>

<?php else : ?>

	<div class="f-message">
	<p>Нет ни одного проекта</p>
	</div>

<?php endif; ?>

<hr />


<p class="f-buttons">
	<strong>
		Мои проекты
	</strong>&nbsp;

	<span class="f-bu" style="float: right;">
		<a href="<?=$this->createUrl('/projects/add/'); ?>">
			<img src="/images/icons/create_project.png" style="float: left; margin: 1px 5px 0 0;" />
			Создать проект
		</a>
	</span>
</p>

<div class="f-message">

	<?php if (count($ownedProjects) == 0) : ?>
		<p>У вас нет ни одного созданого проекта</p>
	<?php endif; ?>

	<?php foreach ($ownedProjects as $p) : ?>
	<span style="height: 20px; padding: 0 5px 5px 0; display: inline-block;">
		<img src="/images/icons/create_project.png" />
		<a href="<?=$this->createUrl('/project/'.$p->code); ?>" style="text-decoration: none;">
			<?=$p->name ?> (<?=$p->code ?>)
		</a>
	</span>&nbsp;&nbsp;
	<?php endforeach; ?>
</div>



<hr />

<p class="f-buttons">
	<strong>
		Приглашенные пользователи 
	</strong>&nbsp;

</p>


<div class="f-message">
	<?php if (count($ownedUsers) == 0) : ?>
		<p>Нет приглашенных пользователей</p>
	<?php endif; ?>
	
	<?php foreach ($ownedUsers as $p) : ?>
	<span style="height: 20px; display: inline-block;">
		<img src="/images/icons/user.png" />
		<a href="<?=$this->createUrl('/user/'.$p->id); ?>" style="text-decoration: none;">
			<?=$p->name ?>
		</a>
	</span>&nbsp;&nbsp;
	<?php endforeach; ?>

</div>


$data['foundUsers']

