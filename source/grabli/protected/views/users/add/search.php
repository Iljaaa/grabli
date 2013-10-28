<p class="f-buttons">
	<strong>
		Поиск и добавление пользователей
	</strong>&nbsp;
</p>


<?=CHtml::beginForm($this->createUrl('/users/add/'), 'get'); ?>


<div class="f-row">
	<label>Укажите имя или email</label>
	<div class="f-input">
		<?=CHtml::textField('search', $model->name, array('maxlength' => 128, 'class'=>'g-5')) ?>
		<?=CHtml::error($model, "name"); ?>
	</div>
	
	
</div>

<div class="f-row">
	<div class="f-input">
		<?=CHtml::submitButton('Поиск', array('class'=>'f-bu f-bu-success')); ?>
	</div>
</div>
<?=CHtml::endForm() ?>