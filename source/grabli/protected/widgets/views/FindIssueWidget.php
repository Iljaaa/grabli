<?php Yii::app()->getClientScript()->registerScriptFile('/js/popup.js'); ?>

<script type="text/javascript">


	function startFindIssue (name) {
		var id = 'find-issue-widget-window-'+name;
		popup.show ('#'+id);
	}

	function startFindIssueAjaxRequest (name)
	{
		var ss = $("#find-issue-widget-input-"+name).val();
		var projectId = $("#find-issue-widget-projectid-"+name).val();

		jQuery.ajax({
			url			: '<?=yii::app()->controller->createUrl('/issues/ajaxissues/') ?>',
			cache		: false,
			// contentType	: 'json',
			contentType	: 'html',
			type		: 'get',
			context		: {name : name},
			data		: {name : name, search : ss, display : 'html', projectid : projectId} ,
			beforeSend	: function () {
				$("#find-issue-widget-block-"+name).html('');
				$("#find-issue-widget-block-"+name).css('background-color', 'gray');
			},
			complete	: function (){
				$("#find-issue-widget-block-"+name).css('background-color', 'white');
			},
			error		: function (jqXHR, textStatus, errorThrown){
				console.log ('Error : '+textStatus);
			},
			success		: function (data) {
				$("#find-issue-widget-block-"+name).html(data);
			}
		});
	}

</script>

<?=CHtml::hiddenField('find-issue-widget-projectid-'.$this->name, $this->project->id); ?>


<div id="find-issue-widget-window-<?=$this->name ?>" class="popup-window" style="width: 300px; height: 400px; display: none;">
	<h1 style="text-align: center;"><?=$this->title ?></h1>
	<div style="height: 40px; border solid 1px red;">
		<?=CHtml::textField('find-issue-widget-input-'.$this->name, $this->search, array('style' => 'width: 230px;')) ?>
		<?=Chtml::button('search', array('onclick' => 'startFindIssueAjaxRequest("'.$this->name.'")', 'class' => 'f-bu f-bu-success')); ?>
	</div>
	<div style="overflow: hidden; overflow-y: scroll; height: 275px;" id="find-issue-widget-block-<?=$this->name ?>">

	</div>
	<div style="text-align: center; margin-top: 15px;">
		<input type="button" value="Отмена" class="f-bu f-bu-warning" onclick="popup.hide('#find-issue-widget-window-<?=$this->name ?>')" />
	</div>
</div>
