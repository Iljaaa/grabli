<script type="text/javascript">
	function showChildrenList () {
		var children = $("#children-issues").find('div[show=1]');
		var ch = $(children[0]);

		if (ch.css('display') == 'none') {
			children.show();
			$('#children-issues-show-button a').text('[-] Hide list');
		}
		else {
			children.hide();
			$('#children-issues-show-button a').text('[+] Show all');
		}


	}
</script>

<?php
$parent = $issue->getParent ();
if ($parent != null) :
?>
	<div style="padding-left: 5px;">
		<a href="<?=$this->createUrl ('/issue/'.$project->code.'/'.$parent->number); ?>">
			<div class="issue-small-ico issue-ico-<?=$parent->type ?>" style="width: 25px; float: left;">
				<div><div><?=ucfirst(IssueHelper::getIssueAbbreviation($parent->type)); ?></div></div>
			</div>
			<div style="padding-left: 5px; display: table-cell; vertical-align: middle; height: 25px; overflow: hidden; max-width: 260px;">
				<nobr><b>#<?=$parent->number ?></b> <?=$parent->title ?></nobr>
			</div>
		</a>
	</div>

<?php else : ?>

	<div style="padding-left: 5px;">
		<div class="issue-small-ico issue-ico-gray" style="width: 25px; float: left;">
			<div><div>?</div></div>
		</div>
		<div style="padding-left: 5px; display: table-cell; vertical-align: middle; height: 25px;">
			Nothing
		</div>
	</div>

<?php endif; ?>

<div style="margin: 10px 0; padding-left: 10px;">
	<img src="/images/arrows_down.png" style="height: 20px;" />
</div>

<div style="padding-left: 5px;">
	<a href="<?=$this->createUrl ('/issue/'.$project->code.'/'.$issue->number); ?>">
		<div class="issue-small-ico issue-ico-<?=$issue->type ?>" style="width: 25px; float: left;">
			<div><div><?=ucfirst(IssueHelper::getIssueAbbreviation($issue->type)); ?></div></div>
		</div>
		<div style="padding-left: 5px; display: table-cell; vertical-align: middle; height: 25px; overflow: hidden; max-width: 260px;">
			<nobr><b>#<?=$issue->number ?></b> <?=$issue->title ?></nobr>
		</div>
	</a>
</div>

<div style="margin: 10px 0; padding-left: 10px;">
	<img src="/images/arrows_up.png" style="height: 20px;" />
</div>

<?php
$childs = $issue->getChildrens ();
if (count($childs) > 0) : ?>
<div id="children-issues">
<?php
	$i = 0;
	foreach ($childs as $ch) :
		$i++;
?>

	<?php if ($i > 4) : ?>
		<div style="padding-left: 5px; margin-top: 5px; display: none;" show="1">
	<?php else : ?>
		<div style="padding-left: 5px; margin-top: 5px;">
	<?php endif; ?>

	<a href="<?=$this->createUrl ('/issue/'.$project->code.'/'.$ch->number); ?>">
		<div class="issue-small-ico issue-ico-<?=$ch->type ?>" style="width: 25px; float: left;">
			<div><div><?=ucfirst(IssueHelper::getIssueAbbreviation($ch->type)); ?></div></div>
		</div>
		<div style="padding-left: 5px; display: table-cell; vertical-align: middle; height: 25px; overflow: hidden; max-width: 260px;">
			<nobr><b>#<?=$ch->number ?></b> <?=$ch->title ?></nobr>
		</div>
	</a>
</div>

<?php endforeach; ?>

	<?php if (count($childs) > 4) : ?>
		<div id="children-issues-show-button" style="padding: 5px; 10px;">
			<a href="javascript:showChildrenList()" style="text-decoration: none;">[+] Show all</a>
		</div>
	<?php endif; ?>

</div>

<?php else : ?>

	<div style="padding-left: 5px;">
		<div class="issue-small-ico issue-ico-gray" style="width: 25px; float: left;">
			<div><div>?</div></div>
		</div>
		<div style="padding-left: 5px; display: table-cell; vertical-align: middle; height: 25px;">
			Nothing
		</div>
	</div>

<?php endif; ?>

