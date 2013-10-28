<script type="text/javascript">

	function showPostCommantForm ()
	{
		if ($('#postCommantForm').css('display') == 'none') {
			$('#postCommantForm').slideDown ();
		}
		else {
			$('#postCommantForm').slideUp ();
		}
		
	}

	function closePostCommantForm ()
	{
		$('#postCommantForm').slideUp ();
	}

	function showAllMessages ()
	{
		submitData ({
			'command'	: 'show_system_comments'
		});
	}

</script>


<?php $comments = $bug->getComments(); ?>

<h2>
Comments
<div style="float: right;">
<a href="javascript:showPostCommantForm();" style="font-size: 14px; font-weight: normal;">Post new comment</a>
&nbsp;&nbsp;&nbsp;


<a href="javascript:showAllMessages ()" style="font-size: 14px; font-weight: normal;">
<?php 
	$showSystem = yii::app()->user->getState ('show_system_comments', false);
	if ($showSystem == false) echo 'Show all messages ('.count($comments).')';
	else echo 'Show only users messages'; 
	
?></a>
</div>
</h2>

<div id="postCommantForm" style="display: none;">
<?=CHtml::form(''); ?>
<div>
	<?=CHtml::hiddenField('command', 'post-comment') ?>
	<?=CHtml::textArea('comment', '', array('class' => 'g-9', 'style' => 'height: 150px;')); ?>
	<div style="margin: 10px 0">
		<?=CHtml::submitButton('Post comment', array('class' => 'f-bu f-bu-success')); ?>
		<?=CHtml::button('Cancel', array('onclick' => 'closePostCommantForm()', 'class' => 'f-bu f-bu-warning')) ?>
	</div>
</div>
<?=CHtml::endForm(); ?>
</div>



<?php 

$showedMessagesCount = 0;
if (count($comments) > 0) :
	$number = 0;
	foreach ($comments as $c) : 
		$number++;
		if ($showSystem != true && $c->type == 'system'){
			continue;
		}
		
		$showedMessagesCount++;
		
?>
	
	
	
	<div class="f-message">
	
		<div style="float: right;">
			<i><?=date('d.m.Y H:i', $c->time) ?></i>
		</div>
	
		<div>
		#<?=$number ?>
		<?php if ($c->type == 'system') : ?>
			<strong>System</strong>
		<?php else : ?>
			<strong><?=$c->getUser()->name ?></strong>
		<?php endif;?>
		</div>
		
		<?=nl2br($c->description) ?>
	</div>
	
	
	<?php endforeach; ?>
<?php else : ?>
<div class="f-message">Нет коментариев для отображения</div>
<?php endif; ?>

<?php if (isset($showedMessagesCount) && $showedMessagesCount == 0) :  ?>
<div class="f-message">Нет коментариев для отображения</div>
<?php endif; ?>

