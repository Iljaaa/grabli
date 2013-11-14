<?php

class m131114_043215_project_milestones extends CDbMigration
{
	public function up()
	{
		$this->createTable('milestones', array(
			'id'            => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'project_id'    => 'int(11) UNSIGNED',
			'name'          => 'varchar(255) NOT NULL',
		));
	}

	public function down()
	{
		$this->dropTable('milestones');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}