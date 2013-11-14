<script type="text/javascript">

	function startSelectIssueType (name) {
		var id = 'select-issue-type-window-'+name;
		popup.show ('#'+id);
	}

</script>

<?php $types = Type::model()->findAll(); ?>
<div id="select-issue-type-window-<?=$this->name ?>" class="popup-window" style="display: none;">
	<h1 style="text-align: center;"><?=$this->title ?></h1>

	<div>
		<table border="0" class="create-issue-table">
			<tbody>
			<tr>
				<?php $i = 0 ?>
				<?php foreach ($types as $t) : ?>
					<?php $i++; ?>
					<td style="width: 80px; text-align: center;">
						<a href="javascript:setIssueType('<?=$t->code ?>', '<?=$this->name ?>')"   class="issue-ico issue-ico-<?=$t->code ?>" style="margin: 0 auto; float: none;">
							<div><div><?=$t->abbreviation ?></div></div>
						</a>
						<div style="text-align: center; margin-top: 10px;">
							<a href="javascript:setIssueType('<?=$t->code ?>', '<?=$this->name ?>')"><?=$t->name ?></a>
						</div>
					</td>
					<?php
				if ($i == 3) {
					$i = 0;
					echo '</tr><tr>';
				}
				endforeach; ?>
			</tbody>
		</table>

		<div style="text-align: center">
			<input type="button" value="Отмена" class="f-bu f-bu-warning" onclick="popup.hide('#select-issue-type-window-<?=$this->name ?>')" />
		</div>

	</div>
</div>

