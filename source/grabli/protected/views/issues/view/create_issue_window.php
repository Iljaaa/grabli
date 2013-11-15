<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/popup.js'); ?>

<script type="text/javascript">

	function openCreateIssueWindow (){
		popup.show ('#create-issue-window');
	}

</script>

<style type="text/css">

	.create-issue-table tbody tr:hover td {
		background-color: white;
	}

	.create-issue-table tbody tr td {
		border: none;
	}

</style>


<div id="create-issue-window" class="popup-window" style="display: none;">
	<h1 style="text-align: center;">Create issue</h1>

	<div>
		<table border="0" class="create-issue-table">
			<tbody>

			<tr>
				<td style="width: 80px;">
					<a href="javascript:setIssueByWindow('bug')" class="issue-ico issue-ico-red" style="margin: 0 auto; float: none;">
						<div><div>B</div></div>
					</a>
				</td>
				<td style="width: 80px;">
					<a href="javascript:setIssueByWindow('enhancement')" class="issue-ico issue-ico-c3" style="margin: 0 auto; float: none;">
						<div><div>E</div></div>
					</a>
				</td>
				<td style="width: 80px;">
					<a href="javascript:setIssueByWindow('task')" class="issue-ico issue-ico-blue"  style="margin: 0 auto; float: none;">
						<div><div>T</div></div>
					</a>
				</td>
			</tr>

			<tr>
				<td style="text-align: center;">
					<a href="javascript:setIssueByWindow('bug')">Bug</a>
				</td>
				<td style="text-align: center;">
					<a href="javascript:setIssueByWindow('enhancement')">Enhancement</a>
				</td>
				<td style="text-align: center;">
					<a href="javascript:setIssueByWindow('task')">Task</a>
				</td>
			</tr>

			<tr>
				<td colspan="3" style="height: 20px;"></td>
			</tr>

			<tr>
				<td style="width: 80px;">
					<a href="javascript:setIssueByWindow('featurerequest')" class="issue-ico issue-ico-orange" style="margin: 0 auto; float: none;">
						<div><div>Fr</div></div>
					</a>
				</td>
				<td style="width: 80px;">
					<a href="javascript:setIssueByWindow('idea')" class="issue-ico issue-ico-navy" style="margin: 0 auto; float: none;">
						<div><div>I</div></div>
					</a>
				</td>
				<td style="width: 80px;">
					<a href=javascript:setIssueByWindow('other')"" class="issue-ico issue-ico-gray"  style="margin: 0 auto; float: none;">
						<div><div>O</div></div>
					</a>
				</td>
			</tr>

			<tr>
				<td style="text-align: center;">
					<a href="javascript:setIssueByWindow('featurerequest')">Feature Request</a>
				</td>
				<td style="text-align: center;">
					<a href="javascript:setIssueByWindow('idea')">Idea</a>
				</td>
				<td style="text-align: center;">
					<a href="javascript:setIssueByWindow('other')">Other</a>
				</td>
			</tr>

			</tbody>
		</table>

		<div style="text-align: center">
			<input type="button" value="Отмена" class="f-bu f-bu-warning" onclick="popup.hide('#create-issue-window')" />
		</div>

	</div>
</div>