<?php foreach ($projects as $p) : ?>
<div style="margin-bottom: 10px;" class="f-message">
	<h3 style="">
		<a href="<?=$this->createUrl('/project/'.$p->code) ?>"><?=$p->name ?></a>
	</h3>
	
	<div>
		<div style="float: left; background-image: url(/images/icons/user.png); padding-left: 23px; background-repeat: no-repeat; background-position: 0; ">
			<b style="font-size: 16px;"><?=$p->usersCount(); ?></b>
		</div>
		
		<div style="float: left; background-image: url(/images/icons/bug.png); padding-left: 25px; background-repeat: no-repeat; background-position: 0; margin-left: 25px;">
			<b style="font-size: 16px;" title="active/all"><?=$p->getActiveBugsCount(); ?>/<?=$p->getIssuesCount() ?></b>
		</div>

		<br style="clear: both" />

		<?php if (isset($user) && $user != null) : ?>
		<div style="margin-top: 10px;">
			<a href="<?=$this->createUrl('/project/'.$p->code.'/issues') ?>">Issues</a>
			<ul>
				<li><a href="#">my issues</a></li>
				<li><a href="#">open issues</a></li>
				<li><a href="#">issues open for my</a></li>
			</ul>
		</div>
		<?php endif; ?>


	</div>
	
</div>
<?php endforeach; ?>