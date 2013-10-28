<?php

class SelectUserWidget extends CWidget
{
		public $users = array ();
		public $selectedUser = 0;
		public $name;
		
		/**
		 * Показывать строку пустого польвателя
		 * 
		 * @var bool
		 */
		public $showEmptyUser = false;
	
		
		
		
		public function init()
		{
			
		}
	
		
		
		
		public function run()
		{
			// этот метод будет вызван внутри CBaseController::endWidget()
			
			$users = array();
			
			if ($this->showEmptyUser) $users[0] = '---';
		
			foreach ($this->users as $key => $u) $users[$key] = $u;
			
			$this->render ('SelectUserWidget', array ('users' => $users,));
		}
}