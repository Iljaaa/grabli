<?php

class m131112_043856_index extends CDbMigration
{
	public function up()
	{

		$this->createTable('issues', array(
			'id'            => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'step_id'       => 'int(11) UNSIGNED NOT NULL',
			'project_id'    => 'int(11) UNSIGNED NOT NULL',
			'assigned_to'   => 'int(11) UNSIGNED NOT NULL',
			'owner_id'      => 'int(11) UNSIGNED NOT NULL',
			'parent_id'     => 'int(11) UNSIGNED NOT NULL',
			'name'          => 'varchar(100) NOT NULL',
			'type'          => 'varchar(20) NOT NULL',
			'description'   => 'varchar(1000)',
			'rep_steps'     => 'varchar(1000)',
			'number'        => 'int(11) UNSIGNED NOT NULL',
			'added_date'    => 'int(11) UNSIGNED',
			'dedline_date'  => 'int(11) UNSIGNED',
			'last_activity' => 'int(11) UNSIGNED',
		));

		$this->createTable('issue_has_issue', array(
			'issue_1'       => 'int(11) UNSIGNED NOT NULL',
			'issue_2'       => 'int(11) UNSIGNED NOT NULL',
		));

		$this->createTable('projects', array(
			'id'            => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'owner_id'      => 'int(11) UNSIGNED NOT NULL',
			'name'          => 'varchar(100) NOT NULL',
			'code'          => 'varchar(50) NOT NULL',
			'description'   => 'varchar(1000)',
		));

		$this->createTable('users', array(
			'id'            => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'owner_id'      => 'int(11) UNSIGNED NOT NULL',
			'name'          => 'varchar(100) NOT NULL',
			'email'         => 'varchar(100) NOT NULL',
			'password'      => 'varchar(50) NOT NULL',
			'status'        => 'varchar(50) NOT NULL',
			'last_activity' => 'int(11) UNSIGNED',
		));

		$this->createTable('user_has_project', array(
			'user_id'       => 'int(11) UNSIGNED NOT NULL',
			'project_id'    => 'int(11) UNSIGNED NOT NULL',
		));

		$this->createTable('steps', array(
			'id'            => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'name'          => 'varchar(100) NOT NULL',
			'code'          => 'varchar(20) NOT NULL',
			'description'   => 'varchar(1000)',
			'color'         => 'varchar(20) NOT NULL',
			'order_by'      => 'int(5) UNSIGNED NOT NULL COMMENT \'Sort order\'',
		));

		$this->createTable('step_has_step', array(
			'step_from'     => 'int(11) UNSIGNED NOT NULL',
			'step_to'       => 'int(11) UNSIGNED NOT NULL',
		));

		$this->createTable('types', array(
			'id'            => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'name'          => 'varchar(100) NOT NULL',
			'abbreviation'  => 'varchar(3) NOT NULL',
			'code'          => 'varchar(20) NOT NULL',
			'description'   => 'varchar(1000)',
			'order_by'      => 'int(5) UNSIGNED NOT NULL COMMENT \'Sort order\'',
		));

		$this->createTable('comments', array(
			'id'            => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'user_id'       => 'int(11) UNSIGNED NOT NULL',
			'issue_id'      => 'int(11) UNSIGNED NOT NULL',
			'time'          => 'int(11) UNSIGNED NOT NULL',
			'type'          => 'varchar(20) NOT NULL',
			'description'   => 'varchar(1000)',
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


		$this->insert('projects', array(
			'owner_id'      => 1,
			'name'          => 'Test project',
			'code'          => 'test',
			'description'   => 'Тестовый проект',
		));


		$this->insert('users', array(
			'owner_id'      => 0,
			'name'          => 'User 1',
			'email'         => 'demo@demo.demo',
			'password'      => 'fe01ce2a7fbac8fafaed7c982a04e229',
			'status'        => 'worked',
			'last_activity' => 0,
		));

		$this->insert('users', array(
			'owner_id'      => 0,
			'name'          => 'User 2',
			'email'         => 'user@demo.demo',
			'password'      => 'fe01ce2a7fbac8fafaed7c982a04e229',
			'status'        => 'worked',
			'last_activity' => 0,
		));


		$this->insert('user_has_project', array(
			'user_id'       => 1,
			'project_id'    => 1,
		));

		$this->insert('user_has_project', array(
			'user_id'       => 2,
			'project_id'    => 1,
		));


		$this->insert('issues', array(
			'step_id'       => 1,
			'project_id'    => 1,
			'assigned_to'   => 2,
			'owner_id'      => 1,
			'parent_id'     => 0,
			'name'          => 'Test bug issue',
			'type'          => 'bug',
			'description'   => 'Its demo issue',
			'rep_steps'     => 'No rep steps',
			'number'        => 1,
			'added_date'    => time() - (3600 * 24 * 2),
			'dedline_date'  => time() + (3600 * 24 * 5),
			'last_activity' => time() - 3600,
		));

		$this->insert('issues', array(
			'step_id'       => 1,
			'project_id'    => 1,
			'assigned_to'   => 2,
			'owner_id'      => 1,
			'parent_id'     => 1,
			'name'          => 'Feature request issue',
			'type'          => 'featurerequest',
			'description'   => 'Its demo fr',
			'rep_steps'     => '',
			'number'        => 2,
			'added_date'    => time() - (3600 * 24 * 1),
			'dedline_date'  => time() + (3600 * 24 * 10),
			'last_activity' => time() - 1800,
		));

		$this->insert('issues', array(
			'step_id'       => 1,
			'project_id'    => 1,
			'assigned_to'   => 2,
			'owner_id'      => 1,
			'parent_id'     => 1,
			'name'          => 'Enhancement item',
			'type'          => 'enhancement',
			'description'   => 'enhancement',
			'rep_steps'     => '',
			'number'        => 3,
			'added_date'    => time(),
			'dedline_date'  => 0,
			'last_activity' => time() - 600,
		));

		$this->insert('issues', array(
			'step_id'       => 1,
			'project_id'    => 1,
			'assigned_to'   => 2,
			'owner_id'      => 1,
			'parent_id'     => 1,
			'name'          => 'Test Task issue',
			'type'          => 'task',
			'description'   => 'Its demo issue',
			'rep_steps'     => '',
			'number'        => 4,
			'added_date'    => time() - (3600 * 24 * 1),
			'dedline_date'  => 0,
			'last_activity' => time() - 600,
		));

		$this->insert('issues', array(
			'step_id'       => 1,
			'project_id'    => 1,
			'assigned_to'   => 2,
			'owner_id'      => 1,
			'parent_id'     => 2,
			'name'          => 'Test other issue',
			'type'          => 'other',
			'description'   => 'Its demo issue',
			'rep_steps'     => '',
			'number'        => 5,
			'added_date'    => time() - (3600 * 24 * 1),
			'dedline_date'  => 0,
			'last_activity' => time() - 600,
		));

		$this->insert('issues', array(
			'step_id'       => 1,
			'project_id'    => 1,
			'assigned_to'   => 2,
			'owner_id'      => 1,
			'parent_id'     => 2,
			'name'          => 'Test idea issue',
			'type'          => 'idea',
			'description'   => 'Its idea issue',
			'rep_steps'     => '',
			'number'        => 6,
			'added_date'    => time() - (3600 * 24 * 1),
			'dedline_date'  => 0,
			'last_activity' => time() - 600,
		));
	}

	public function down()
	{
		$this->dropTable('issues');
		$this->dropTable('issue_has_issue');
		$this->dropTable('projects');
		$this->dropTable('users');
		$this->dropTable('user_has_project');
		$this->dropTable('steps');
		$this->dropTable('step_has_step');
		$this->dropTable('types');
		$this->dropTable('comments');
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{

	}

	public function safeDown()
	{

	}
}