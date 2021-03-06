<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'GRABL! the open bug tracker',
    'timeZone' => 'Europe/Moscow',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.forms.*',
		'application.widgets.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'	=> true,
			'class'				=> 'WebUser',
			'loginUrl'			=> array ('user/login')
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'			=>'path',
			'showScriptName'	=> false,
			'rules'=>array(
					
				'project/<code:\w+>' 		=> 'projects/view',
				'project/<code:\w+>/edit' 	=> 'projects/edit',
				'project/<code:\w+>/issues'	=> 'projects/issues',
				'project/<code:\w+>/users' 	=> 'projects/users',
				
				'user/<id:\d>' 				=> 'users/view', 
					
				// 'issues/create/<type:\w+>'					=> 'issues/create',
				'issue/<projectCode:\w+>/<number:\w+>'		=> 'issues/view',
				'issue/<projectCode:\w+>/<number:\w+>/edit'	=> 'issues/edit',
				'issuebyid/<id:\d+>'						=> 'issues/viewbyid',
				'issue/create/<projectCode:\w+>/<type:\w+>' => 'issues/create',
					
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=> include ('mysql_config.php'),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

		'image'=>array(
			'class'=>'application.extensions.image.CImageComponent',
			// GD or ImageMagick
			'driver'=>'GD',
			// ImageMagick setup path
			// 'params'=>array('directory'=>'/opt/local/bin'),
		),

		'firephp'	=> array (
			'class'=>'application.extensions.firephp.FirePHP',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'the.ilja@gmail.com',
		'version'	=> '0.0.2'
	),
);
