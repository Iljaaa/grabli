<?php

class m131112_043856_index extends CDbMigration
{
	public function up()
	{
		$this->createTable('steps', array(
			'id'            => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'name'          => 'varchar(100) NOT NULL',
			'code'          => 'varchar(20) NOT NULL',
			'description'   => 'varchar(1000)',
			'color'         => 'varchar(20) NOT NULL',
			'order_by'      => 'int(5) UNSIGNED NOT NULL COMMENT \'Sort order\'',
		));

		$this->createTable('types', array(
			'id'            => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'name'          => 'varchar(100) NOT NULL',
			'abbreviation'  => 'varchar(3) NOT NULL',
			'code'          => 'varchar(20) NOT NULL',
			'description'   => 'varchar(1000)',
			'order_by'      => 'int(5) UNSIGNED NOT NULL COMMENT \'Sort order\'',
		));



		$this->insert('steps', array(
			'name'          => 'Create',
			'code'          => 'create',
			'description'   => 'New issue',
			'color'         => 'white',
			'order_by'      => '10',
		));

		$this->insert('steps', array(
			'name'          => 'Worked on',
			'code'          => 'workedon',
			'description'   => 'in work',
			'color'         => 'green',
			'order_by'      => '20',
		));

		$this->insert('steps', array(
			'name'          => 'Ready for testing',
			'code'          => 'readyfortesting',
			'description'   => 'Ready for testing',
			'color'         => 'blue',
			'order_by'      => '30',
		));

		$this->insert('steps', array(
			'name'          => 'Re work',
			'code'          => 'rework',
			'description'   => 'Re working',
			'color'         => 'orange',
			'order_by'      => '40',
		));

		$this->insert('steps', array(
			'name'          => 'Re open',
			'code'          => 'reopen',
			'description'   => 'Reopened',
			'color'         => 'yellow',
			'order_by'      => '50',
		));

		$this->insert('steps', array(
			'name'          => 'Closed',
			'code'          => 'closed',
			'description'   => 'Closed',
			'color'         => 'black',
			'order_by'      => '60',
		));




		$this->insert('types', array(
			'name'          => 'Bug',
			'abbreviation'  => 'B',
			'code'          => 'bug',
			'description'   => 'bug',
			'order_by'      => '10',
		));

		$this->insert('types', array(
			'name'          => 'Feature request',
			'abbreviation'  => 'Fr',
			'code'          => 'featurerequest',
			'description'   => 'Feature request',
			'order_by'      => '20',
		));

		$this->insert('types', array(
			'name'          => 'Enhancement',
			'abbreviation'  => 'E',
			'code'          => 'enhancement',
			'description'   => 'Enhancement',
			'order_by'      => '30',
		));

		$this->insert('types', array(
			'name'          => 'Task',
			'abbreviation'  => 'T',
			'code'          => 'task',
			'description'   => 'Task',
			'order_by'      => '40',
		));

		$this->insert('types', array(
			'name'          => 'Idea',
			'abbreviation'  => 'I',
			'code'          => 'idea',
			'description'   => 'Idea',
			'order_by'      => '50',
		));

		$this->insert('types', array(
			'name'          => 'Other',
			'abbreviation'  => 'O',
			'code'          => 'other',
			'description'   => 'Other',
			'order_by'      => '60',
		));


	}

	public function down()
	{
		$this->dropTable('steps');
		$this->dropTable('types');
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{

	}

	public function safeDown()
	{

	}
}