<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Asset Management',
	'theme'=>'bootstrap',

	// preloading 'log' component
	'preload' => array(
        'log',
        //'errorHandler', // handle fatal errors
    ),

	'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change this if necessary
        //'audit' => realpath(__DIR__ .'/../modules/yii-audit-module-1.1.10/audit'),
   	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',

		 'application.widgets.bootstrap.*',
		 //bootstrap widgets
        'bootstrap.helpers.TbHtml',
        'bootstrap.helpers.TbArray',
        'bootstrap.behaviors.TbWidget',
        'bootstrap.widgets.TbDataColumn',
        'bootstrap.widgets.TbActiveForm',
        //'yiiwheels.widgets.datepicker.WhDatePicker',
        'bootstrap.widgets.TbGridView',
        'bootstrap.widgets.TbGridView1',

        'ext.select2.Select2',


	),

	'modules'=>array('fm',
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array('bootstrap.gii'),
		),

		
            /*	'audit' => array(
            // path to the AuditModule class
            'class' => 'audit.AuditModule',
 
            // set this to your user view url,
            // AuditModule will replace --user_id-- with the actual user_id
            'userViewUrl' => array('/user/view', 'id' => '--user_id--'),
 
            // Set to false if you do not wish to track database audits.
            'enableAuditField' => true,
 
            // The ID of the CDbConnection application component. If not set, a SQLite3
            // database will be automatically created in protected/runtime/audit-AuditVersion.db.
            'connectionID' => 'db',
 
            // Whether the DB tables should be created automatically if they do not exist. Defaults to true.
            // If you already have the table created, it is recommended you set this property to be false to improve performance.
            'autoCreateTables' => true,
 
            // The layout used for module controllers.
            'layout' => 'audit.views.layouts.column1',
 
            // The widget used to render grid views.
            'gridViewWidget' => 'bootstrap.widgets.TbGridView',
 
            // The widget used to render detail views.
            'detailViewWidget' => 'zii.widgets.CDetailView',
 
            // Defines the access filters for the module.
            // The default is AuditAccessFilter which will allow any user listed in AuditModule::adminUsers to have access.
            'controllerFilters' => array(
                'auditAccess' => array('audit.components.AuditAccessFilter'),
            ),
 
            // A list of users who can access this module.
            'adminUsers' => array('demo'),
 
            // The path to YiiStrap.
            // Only required if you do not want YiiStrap in your app config, for example, if you are running YiiBooster.
            // Only required if you did not install using composer.
            // Please note:
            // - You must download YiiStrap even if you are using YiiBooster in your app.
            // - When using this setting YiiStrap will only loaded in the menu interface (eg: index.php?r=menu).
            'yiiStrapPath' => dirname(__FILE__).'/../extensions/bootstrap',
        ),*/
		
	),

	// application components
	'components'=>array(
		'bootstrap' => array(
                    'class' => 'bootstrap.components.TbApi',   
                ),
                'session' => array (
                    'class' => 'system.web.CDbHttpSession',
                    'connectionID' => 'db',
                    'sessionTableName' => 'session',
                    'autoCreateSessionTable'=>true
                ),

        /*'errorHandler' => array(
            // path to the AuditErrorHandler class
            'class' => 'audit.components.AuditErrorHandler',
 
            // set this as you normally would for CErrorHandler
            'errorAction' => 'site/error',
 
            // Set to false to only track error requests.  Defaults to true.
            'trackAllRequests' => false,
 
            // Set to false to not handle fatal errors.  Defaults to true.
            'catchFatalErrors' => true,
 
            // Request keys that we do not want to save in the tracking data.
            'auditRequestIgnoreKeys' => array('PHP_AUTH_PW', 'password'),
 
        ),*/

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager' => array(  
		'urlFormat' => 'path', 
		//'showScriptName' => false,
		//'useStrictParsing'=>false,
		//'caseSensitive' => false, 
		'rules' => array( 
			'controller:w+/id:d+' => '/view', 
			'controller:w+/action:w+/id:d+' => '/',
			'controller:w+/action:w+' => '/',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			/*'fm/forms/form:d+/fields/new' => 'fm/fields/new', 
			'fm/forms/form:d+/fields/field:d+/view' => 'fm/fields/view',
			'fm/forms/form:d+/fields/field:d+/edit' => 'fm/fields/edit', 
			'fm/forms/form:d+/fields/field:d+/delete' => 'fm/fields/delete', 
			'fm/forms/form:d+/fields/all' => 'fm/fields/index', 
			'fm/forms/new' => 'fm/forms/new', 
			'fm/forms/form:d+/view' => 'fm/forms/view', 
			'fm/forms/form:d+/edit' => 'fm/forms/edit', 
			'fm/forms/form:d+/delete' => 'fm/forms/delete', 
			'fm/forms/all' => 'fm/forms/index', 
			'fm/types/new' => 'fm/types/new', 
			'fm/types/type:d+/view' => 'fm/types/view', 
			'fm/types/type:d+/edit' => 'fm/types/edit', 
			'fm/types/type:d+/delete' => 'fm/types/delete', 
			'fm/types/all' => 'fm/types/index', 
			'fm/form/form:d+/entry/entry:d+/view' => 'fm/entry/view', 
			'fm/form/form:d+/entry/entry:d+/edit' => 'fm/entry/edit', 
			'fm/form/form:d+/entry/entry:d+/delete' => 'fm/entry/delete',
			'fm/form/form:d+/entry/all' => 'fm/entry/index', 
			'fm/form/form:d+/entry/new' => 'fm/entry/new', 
			), */
			
			'asset_management/fm/forms/form:d+/fields/new' => 'asset_management/fm/fields/new', 
			'asset_management/fm/forms/form:d+/fields/field:d+/view' => 'asset_management/fm/fields/view',
			'asset_management/fm/forms/form:d+/fields/field:d+/edit' => 'asset_management/fm/fields/edit', 
			'asset_management/fm/forms/form:d+/fields/field:d+/delete' => 'asset_management/fm/fields/delete', 
			'asset_management/fm/forms/form:d+/fields/all' => 'asset_management/fm/fields/index', 
			
			'asset_management/fm/forms/new' => 'asset_management/fm/forms/new', 
			'asset_management/fm/forms/form:d+/view' => 'asset_management/fm/forms/view', 
			'asset_management/fm/forms/form:d+/edit' => 'asset_management/fm/forms/edit', 
			'asset_management/fm/forms/form:d+/delete' => 'asset_management/fm/forms/delete', 
			'asset_management/fm/forms/all' => 'asset_management/fm/forms/index', 
			
			'asset_management/fm/types/new' => 'asset_management/fm/types/new', 
			'asset_management/fm/types/type:d+/view' => 'asset_management/fm/types/view', 
			'asset_management/fm/types/type:d+/edit' => 'asset_management/fm/types/edit', 
			'asset_management/fm/types/type:d+/delete' => 'asset_management/fm/types/delete', 
			'asset_management/fm/types/all' => 'asset_management/fm/types/index', 
			
			'asset_management/fm/form/form:d+/entry/entry:d+/view' => 'asset_management/fm/entry/view', 
			'asset_management/fm/form/form:d+/entry/entry:d+/edit' => 'asset_management/fm/entry/edit', 
			'asset_management/fm/form/form:d+/entry/entry:d+/delete' => 'asset_management/fm/entry/delete',
			'asset_management/fm/form/form:d+/entry/all' => 'asset_management/fm/entry/index', 
			'asset_management/fm/form/form:d+/entry/new' => 'asset_management/fm/entry/new', 
			), 
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=assetdb',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',

		/*	// set to true to enable database query logging
            // don't forget to put `profile` in the log route `levels` below
            'enableProfiling' => true,
 
            // set to true to replace the params with the literal values
            'enableParamLogging' => true,*/

		),
		      'ePdf' => array(
        'class'         => 'ext.yii-pdf.EYiiPdf',
        'params'        => array(
            'mpdf'     => array(
                'librarySourcePath' => 'application.vendors.mpdf.*',
                'constants'         => array(
                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                ),
                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                    'mode'              => '', //  This parameter specifies the mode of the new document.
                    'format'            => 'A4', // format A4, A5, ...
                    'default_font_size' => 0, // Sets the default document font size in points (pt)
                    'default_font'      => '', // Sets the default font-family for the new document.
                    'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                    'mgr'               => 15, // margin_right
                    'mgt'               => 16, // margin_top
                    'mgb'               => 16, // margin_bottom
                    'mgh'               => 9, // margin_header
                    'mgf'               => 9, // margin_footer
                    'orientation'       => 'P', // landscape or portrait orientation
                )*/
            ),
            'HTML2PDF' => array(
                'librarySourcePath' => 'application.vendors.html2pdf.*',
                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                    'orientation' => 'P', // landscape or portrait orientation
                    'format'      => 'A4', // format A4, A5, ...
                    'language'    => 'en', // language: fr, en, it ...
                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                )*/
            )
        ),
    ),
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
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);