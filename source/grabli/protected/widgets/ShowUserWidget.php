<?php

class ShowUserWidget extends CWidget
{
		public $user = null;
		
		public $user_id = 0;
	
		public function init()
		{
			
		}
	
		public function run()
		{
			// этот метод будет вызван внутри CBaseController::endWidget()
			
			$user = null;
			if ($this->user != null) $user = $this->user;
			if ($this->user_id > 0) $user = User::model()->findByPk($this->user_id);
			
			$this->render ('ShowUserWidget', array ('user' => $user));
		}
}