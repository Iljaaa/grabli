<h1>Пользователи</h1>


	<div class="g-row">
		<div class="g-8">
			
			<?=$this->renderPartial('/users/add/search', array('model' => $model)); ?>
			
			<?php if (isset($users) && count($users) > 0) : ?>
				<?=$this->renderPartial('/users/add/showusers', array('users' => $users)); ?>
			<?php else : ?>
				<?=$this->renderPartial('/users/add/showsearch_result', array('model' => $model)); ?>
			<?php endif; ?>

			
			
			
		</div>
		<div class="g-4">
			<?=$this->renderPartial('/users/add/ownedusers', array('ownedUsers' => $ownedUsers)); ?>
		</div>
	</div>
</div>





