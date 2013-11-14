<?php

class m131113_164334_add_project_tags_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tags', array(
			'id'    => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'tag'   => 'varchar(255) NOT NULL',
		));

		$this->createTable('project_tags', array(
			'tag_id'        => 'int(11) UNSIGNED NOT NULL',
			'project_id'    => 'int(11) UNSIGNED NOT NULL',
		));
	}

	public function down()
	{
		$this->dropTable('tags');
		$this->dropTable('project_tags');


		/*
		echo "m131113_164334_add_project_tags_table does not support migration down.\n";
		return false;*/
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