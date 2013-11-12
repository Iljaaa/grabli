<h1><i>Участники проекта</i> <?=$project->name ?></h1>


<?php $flash = yii::app()->user->getFlash('users_to_project', array()) ?>
<?php if (count($flash) > 0) : ?>
<?php foreach ($flash as $f) : ?>
<div class="f-message f-message-success">
	<?=$f ?>
</div>
<?php endforeach; ?>
<?php endif; ?>


<?=CHtml::form('', 'post') ?>

<?=CHtml::hiddenField('command', 'clear_users'); ?>

<?php $users = $project->getUsers(); ?>

<?php if (count($users) == 0) : ?>
<p>В проекте нет ни одного участника</p>
<?php endif; ?>

<?php if (count($users) > 0) : ?>
<table class="f-table-zebra">
	<thead>
		<tr>
			<td style="width: 20px;"></td>
			<th></th>
			<th>Email</th>
		</tr>
		
	</thead>
	<tbody>
		<?php foreach ($users as $u) : ?>
		<tr>
			<td>
				<?=CHtml::checkBox('user['.$u->id.']', 0) ?>
			</td>
			
			<td>
				<img src="<?=$u->getAvataraUrl() ?>" />

				<a href="<?=$this->createUrl('/user/'.$u->id); ?>">
				<?=$u->name ?>
				</a>
			</td>
			<td>
				<a href="mailto:<?=$u->email ?>"><?=$u->email ?></a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>


<p class="f-buttons">
	<?=CHtml::submitButton('Убрать пользователей из проекта', array('class' => 'f-bu f-bu-success')) ?>
</p>
<?php endif; ?>

<?=Chtml::endForm() ?>




<p class="f-buttons">
	<h2>
		Поиск и добавление пользователей
	</h2>&nbsp;
</p>


<?=CHtml::beginForm($this->createUrl('project/'.$project->code.'/users'), 'get'); ?>


<div class="f-row">
	<label>Укажите имя или email</label>
	<div class="f-input">
		<?=CHtml::textField('search', $modelAddUser->name, array('maxlength' => 128, 'class'=>'g-5')) ?>
		<?=CHtml::error($modelAddUser, "name"); ?>
	</div>
	
	
</div>

<div class="f-row">
	<div class="f-input">
		<?=CHtml::submitButton('Поиск', array('class'=>'f-bu f-bu-success')); ?>
	</div>
</div>
<?=CHtml::endForm() ?>

<?=CHtml::form('', 'post') ?>

<?=CHtml::hiddenField('command', 'add_users'); ?>

<?php if (isset($foundUsers) && count($foundUsers) > 0) : ?>
<table class="f-table-zebra">
	<thead>
		<tr>
			<td style="width: 20px;"></td>
			<th></th>
			<th>Email</th>
		</tr>
		
	</thead>
	<tbody>
		<?php 
		foreach ($foundUsers as $u) : ?>
		<tr>
			<td>
				<?=CHtml::checkBox('user['.$u->id.']', 0, array('checked' => 'false')) ?>
			</td>
			
			<td>
				<img src="<?=$u->getAvataraUrl() ?>" />

				<a href="<?=$this->createUrl('/user/'.$u->id); ?>">
				<?=$u->name ?>
				</a>
			</td>
			<td>
				<a href="mailto:<?=$u->email ?>"><?=$u->email ?></a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>

<div class="f-row">
	<?=CHtml::submitButton('Сохранить', array('class'=>'f-bu f-bu-success')); ?>
</div>

<?php endif; ?>
<?=CHtml::endForm() ?>

<?php if (isset($searched) && $searched == true && count($foundUsers) == 0) : ?>
<div class="f-row">
	<div class="f-message f-message-error">
		Пользователей не найдено
	</div>
	
	<div class="f-message">
		Не нашли пользователей на сайте, отправте приглашение 
		<?php
		$modelAddUser->setScenario('secondstep');
		if ($modelAddUser->validate ()) : ?>
			<div style="margin-top: 10px;">
			<?=CHtml::form('/users/sendrequest/', 'get') ?>
			<?=CHtml::hiddenField('email', $modelAddUser->name); ?>
			<?=CHtml::hiddenField('showform', '0'); ?>
			<?=CHtml::submitButton('Отправить приглашение', array('class' => "f-bu f-bu-default")) ?>
			<?=CHtml::endForm(); ?>
			</div>
		<?php else : ?> 
			<div style="margin-top: 10px;">
				Для этого введите Email адрес получателя предложение нажмите "поиск" и если пользователь не будет найден на сайте то 
				Вам будет доступна кнопка 'Отправить приглашение'
			</div>
		<?php endif; ?>
	</div>
	
</div>
<?php endif; ?>

<a href="javascript:startFindtUser('aaa')">ффф</a>
<?php $this->widget('FindUsersWidget', array ('name' => 'aaa')); ?>

