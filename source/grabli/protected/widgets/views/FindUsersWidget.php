<?php Yii::app()->getClientScript()->registerScriptFile('/js/popup.js'); ?>

<script type="text/javascript">



	function startFindtUser (name) {
		var id = 'find-user-window-'+name;
		popup.show ('#'+id);
	}

	function startFindUsers (name)
	{
		var ss = $("#find-user-input-"+name).val();
		console.log (ss);

		jQuery.ajax({
			url			: '<?=yii::app()->controller->createUrl('/users/ajaxusers/') ?>',
			cache		: false,
			contentType	: 'json',
			type		: 'get',
			context		: {name : name},
			data		: {name : 'name', search : ss},
			beforeSend	: function (){
				$("#find-user-block-"+name).html('');
				$("#find-user-block-"+name).css('background-color', 'gray');
			},
			complete	: function (){
				$("#find-user-block-"+name).css('background-color', 'white');
			},
			error		: function (jqXHR, textStatus, errorThrown){
				console.log ('Error : '+textStatus);
			},
			success		: function (data){
				console.log ('success');
				console.log (data);
			}
		});


	}

	function drawUsersData (data)
	{

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


<div id="find-user-window-<?=$this->name ?>" class="popup-window" style="width: 300px; height: 400px; display: none;">
	<h1 style="text-align: center;">Found users</h1>
	<div style="height: 40px; border solid 1px red;">
		<?=CHtml::textField('find-user-input-'.$this->name, $this->search, array('style' => 'width: 250px;')) ?>
		<?=Chtml::button('aaa', array('onclick' => 'startFindUsers("'.$this->name.'")')); ?>
	</div>
	<div style="overflow: hidden; overflow-y: scroll; height: 275px;" id="find-user-block-<?=$this->name ?>">

	</div>
	<div style="text-align: center; margin-top: 15px;">
		<input type="button" value="Отмена" class="f-bu f-bu-warning" onclick="popup.hide('#find-user-window-<?=$this->name ?>')" />
	</div>
</div>
