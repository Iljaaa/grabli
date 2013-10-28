<p class="f-buttons">
	<strong>
		Приглашенные Вами пользователи 
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