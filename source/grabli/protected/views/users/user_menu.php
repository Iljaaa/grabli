<div>

	<div style="padding: 10px; border: solid 1px gray; width: 64px; float: left; height: 64px;">
		<a href="<?=$this->createUrl('/user/'.yii::app()->user->getId()); ?>">
			<img src="<?=yii::app()->user->getUserObject()->getAvataraUrl(); ?>" />
		</a>
	</div>

	<div style="float: right;">
		<h3 style="text-align: right; margin-bottom: 0; padding-bottom: 0px;"><?=yii::app()->user->getUserObject()->name ?></h3>
		<div style="text-align: right;">
			<i><?=yii::app()->user->getUserObject()->email ?></i>
		</div>
		
		<div style="text-align: right; margin-top: 15px;">
			<a href="<?=$this->createUrl('/user/'.yii::app()->user->getId()); ?>">
				personal
			</a>
		</div>
	</div>
	
	<?php 
		$projects = yii::app()->user->getUserObject()->getProjects(); 
		if (count($projects) > 0) :
			 
	?>
		<div style="clear: both; padding-top: 10px;">
			<?php $this->renderPartial('/projects/collumn_list', array ('projects' => $projects)); ?>
		</div>	
	<?php endif; ?>
	
	
	
	
</div>

