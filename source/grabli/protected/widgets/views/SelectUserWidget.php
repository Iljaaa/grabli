<?php Yii::app()->getClientScript()->registerScriptFile('/js/popup.js'); ?>

<script type="text/javascript">

function startSelectUser (name) {
	var id = 'select-user-window-'+name;
	popup.show ('#'+id);
}

function setUser (name, userId)
{
	// сохраняем значение
	$("#"+name).val (userId);

	// переносим данные выбраного пользователя
	var blockSelector = '#user-for-select-'+name+'-'+userId;
	var selectUserBlock = $(blockSelector);

	var imgSrc = selectUserBlock.find('img').attr('src');
	var userName = selectUserBlock.find('div[rel="name"]').text().trim();

	var settedUserBlock = $("#user-setted-block-"+name);
	settedUserBlock.find('img').attr('src', imgSrc);
	settedUserBlock.find('div[rel="name"]').text(userName);

	//
	settedUserBlock.show ();
	$("#user-notsetted-block-"+name).hide ();

	// скрываем окно
	var windowId = 'select-user-window-'+name;
	popup.hide ("#"+windowId);

	//
}


</script>

<div>

	<?=CHtml::hiddenField($this->name, $this->selectedUserId) ?>

	<?php $selectedUser = User::model()->findByPk($this->selectedUserId); ?>
	<?php if ($selectedUser != null) : ?>
		<div id="user-setted-block-<?=$this->name ?>">
			<a href="javascript:startSelectUser ('<?=$this->name ?>')">
				<div style="display: table-cell; vertical-align: middle; text-align: left; height: 25px; width: 25px;">
					<img src="<?=$selectedUser->getIcoUrl() ?>" />
				</div>
				<div style="display: table-cell; vertical-align: middle; height: 25px;" rel="name">
					<?=$selectedUser->name ?>
				</div>
			</a>
		</div>

	<?php else : ?>
		<div id="user-setted-block-<?=$this->name ?>" style="display: none; height: 25px;">
			<a href="javascript:startSelectUser ('<?=$this->name ?>')">
				<div style="display: table-cell; vertical-align: middle; text-align: left; height: 25px; width: 25px;">
					<img src="" />
				</div>
				<div style="display: table-cell; vertical-align: middle; height: 25px;" rel="name"></div>
			</a>
		</div>
	<?php endif; ?>



	<?php if ($selectedUser == null) : ?>
			<div id="user-notsetted-block-<?=$this->name ?>">
	<?php else : ?>
			<div id="user-notsetted-block-<?=$this->name ?>" style="display: none;">
	<?php endif; ?>
			<i><a href="javascript:startSelectUser ('<?=$this->name ?>')">User not selected</a></i>
		</div>


</div>



<div id="select-user-window-<?=$this->name ?>" class="popup-window" style="width: 300px; height: 400px; display: none;">
	<h1 style="text-align: center;">Select user</h1>
	<div style="overflow: hidden; overflow-y: scroll; height: 315px;">

		<?php foreach ($this->users as $u) : ?>
			<a href="javascript:setUser('<?=$this->name ?>', <?=$u->id ?>)" style="display: block;" id="user-for-select-<?=$this->name ?>-<?=$u->id ?>">
				<div style="display: table-cell; vertical-align: middle; text-align: left; height: 25px; width: 25px;">
					<img src="<?=$u->getIcoUrl() ?>" />
				</div>
				<div style="display: table-cell; vertical-align: middle; height: 25px;" rel="name">
					<?=$u->name ?>
				</div>
			</a>
		<?php endforeach; ?>

	</div>
	<div style="text-align: center; margin-top: 15px;">
		<input type="button" value="Отмена" class="f-bu f-bu-warning" onclick="popup.hide('#select-user-window-<?=$this->name ?>')" />
	</div>
</div>
