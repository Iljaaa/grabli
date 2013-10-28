<script type="text/javascript">


var ppp = function (selector){

	var selectSelector = selector;

	this.change = function (func) {
		$(selectSelector).change(func);
	}
}

</script>

<select name="<?=$this->name ?>" id="<?=$this->name ?>">
<?php foreach ($users as $id => $name) : ?>
	<option value="<?=$id ?>"
	<?php if ($id == $this->selectedUser) : ?>
	selected="selected"
	<?php endif; ?>
	><?=$name ?></option>
<?php endforeach; ?>
</select>