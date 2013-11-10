<?php Yii::app()->getClientScript()->registerScriptFile('http://code.jquery.com/jquery-1.9.1.js'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile('http://code.jquery.com/ui/1.10.3/jquery-ui.js'); ?>
<?php // Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/popup.js'); ?>

<script>

	function deadLineSetted (date){
		console.log ('deadLineSetted');
		console.log (date);

		submitData ({
			command : 'set-deadline',
			date	: date
		});
	}

	$(document).ready(function () {
		$( "#deadline-input" ).datepicker({
			dateFormat	: 'dd.mm.yy',
			onSelect	: deadLineSetted
		});
	});

	function showDualog () {
		$( "#deadline-input" ).datepicker("show");
	}

	function clearDeadline (){
		submitData ({
			command : 'clear-deadline'
		})
	}

</script>

<style>
	.ui-datepicker {
		background-color: white;
		border: solid 1px gray;
	}

	.f-table-zebra tr:hover td input {
		background-color: #FDF6E3;
	}

	.f-table-zebra tr td {
		vertical-align: middle;
	}

	#deadline-input {
		width: 100px;
		border: none;

		box-shadow: none;
		padding: 0;
		height: 20px;
	}


</style>

<?php
$val = 'not setted';
if ($bug->dedline_date > 0) $val = date('d.m.Y', $bug->dedline_date);
?>

<div style="float: right;">
	<?php if ($bug->dedline_date > 0) : ?>
		<a href="javascript:showDualog()">
			change
		</a>&nbsp;
		<a href="javascript:clearDeadline()">
			clear
		</a>
	<?php else : ?>
		<a href="javascript:showDualog()">
			set
		</a>
	<?php endif; ?>
</div>

<?=CHtml::textField('deadline-input', $val, array('disabled' => 'disabled')); ?>

<?php if ($bug->dedline_date > 0) : ?>
	<br />
	<span style="font-size: 120%; font-weight: bold;"><?=number_format (($bug->dedline_date - time()) / (3600 * 24), 1); ?></span> days left
<?php endif; ?>



