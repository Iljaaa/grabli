<script type="text/javascript">


function showStatusChangeWindow (){
	$("#changeStatusWidget").show();
}

function cancelStatusChangeWindow (){
	$("#changeStatusWidget").hide();
}

function setBugStatus(id) 
{
	var name = $("#changeStatusWidget").find("a[status="+id+"]").text().trim();
	if (confirm('Set status : '+name+' ?')){
		submitData ({
			'command'	: 'set_status',
			'status'	: id
		});
	}
}

</script>

<?php $currentStep = $bug->getStep(); ?>

<div>
	<div style="float: left; width: 15px; height: 15px; border: solid 1px gray; margin: 0 5px 0 0; background-color: <?=$currentStep->color ?>"></div>
	<?=$currentStep->name ?>
	<div style="float: right;">
		<a href="javascript:showStatusChangeWindow()">change</a>
	</div>
</div>



<?php $items = Step::model()->findAll();  ?>
<div id="changeStatusWidget" style="width: 220px; height: 275px; position: absolute; z-index: 1000; margin: -20px 0px 0 0; background-color: white; border: solid 3px gray; display: none;">
	<div style="height: 35px;">
		<div style="padding: 10px 0 0 10px;"><b>Change status to :</b></div>
	</div>
	<div style="height: 200px; margin: 0 10px 0 10px;">
		<ul style="list-style-type: none; padding: 0 0 0 5px; margin: 5px 0 5px 0;">
		<?php foreach ($items as $i) : 
			$related = $currentStep->isRelatedStep($i->id);
		?>
			
			<?php if ($related) : ?>
			<li style="height: 26px; padding: 2px; cursor: pointer" onclick="javascript:setBugStatus(<?=$i->id ?>)">
			<?php else : ?>
			<li style="height: 26px; padding: 2px;">
			<?php endif; ?>
			
			
				<div style="float: left; width: 19px; height: 19px; background-color: <?=$i->color ?>; border: solid 1px silver	; margin-right: 7px;">
					
				</div>
			
				<?php if ($related) : ?>
					<a style="text-decoration: none; font-size: 14px;" status="<?=$i->id ?>">
						<?=$i->name ?>
					</a>
				<?php else : ?>
					<span style="color: gray;"><?=$i->title ?></span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div style="height: 40px; text-align: right;">
		<input type="button" value="Отмена" onclick="cancelStatusChangeWindow()" style="margin: 10px 10px 0 0" class="f-bu f-bu-warning" />
	</div>
</div>