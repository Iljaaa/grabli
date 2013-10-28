<?php foreach ($users as $u) : ?>
<?=$this->renderPartial('/users/user_block', array('user' => $u)); ?>
<?php endforeach; ?>
