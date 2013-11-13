<?php Yii::app()->getClientScript()->registerScriptFile('/js/popup.js'); ?>

<script type="text/javascript">


	function startFindUser (name) {
		var id = 'find-user-window-'+name;
		popup.show ('#'+id);
	}

	function startUserAjaxRequest (name)
	{
		var ss = $("#find-user-input-"+name).val();

		jQuery.ajax({
			url			: '<?=yii::app()->controller->createUrl('/users/ajaxusers/') ?>',
			cache		: false,
			// contentType	: 'json',
			contentType	: 'html',
			type		: 'get',
			context		: {name : name},
			data		: {name : name, search : ss, display : 'html'},
			beforeSend	: function () {
				$("#find-user-block-"+name).html('');
				$("#find-user-block-"+name).css('background-color', 'gray');
			},
			complete	: function (){
				$("#find-user-block-"+name).css('background-color', 'white');
			},
			error		: function (jqXHR, textStatus, errorThrown){
				console.log ('Error : '+textStatus);
			},
			success		: function (data) {
				$("#find-user-block-"+name).html(data);
			}
		});
	}

</script>


<div id="find-user-window-<?=$this->name ?>" class="popup-window" style="width: 300px; height: 400px; display: none;">
	<h1 style="text-align: center;">Found users</h1>
	<div style="height: 40px; border solid 1px red;">
		<?=CHtml::textField('find-user-input-'.$this->name, $this->search, array('style' => 'width: 230px;')) ?>
		<?=Chtml::button('search', array('onclick' => 'startUserAjaxRequest("'.$this->name.'")', 'class' => 'f-bu f-bu-success')); ?>
	</div>
	<div style="overflow: hidden; overflow-y: scroll; height: 275px;" id="find-user-block-<?=$this->name ?>">

	</div>
	<div style="text-align: center; margin-top: 15px;">
		<input type="button" value="Отмена" class="f-bu f-bu-warning" onclick="popup.hide('#find-user-window-<?=$this->name ?>')" />
	</div>
</div>
