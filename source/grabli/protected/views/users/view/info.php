<h1><?=$user->name ?></h1>

<div>
	<div style="padding: 10px; border: solid 1px gray; width: 64px; float: left; height: 64px;">
		<img src="<?=yii::app()->user->getUserObject()->getAvataraUrl(); ?>" />
	</div>
	
	<div style="float: left; margin-left: 10px;">
		
		<div>
			Email : <?=yii::app()->user->getUserObject()->email ?>
		</div>
		
		<div style="margin-top: 5px;">
			Password : ****  
			<a href="javascript:alert('Change password');">change password</a>
		</div>
	</div>
		
	<br style="clear: both;" />
</div>

