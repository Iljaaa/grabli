<?php foreach ($users as $u) : ?>
<?php $this->widget ('ShowUserWidget', array('user' => $u)); ?>
<?php endforeach; ?>
