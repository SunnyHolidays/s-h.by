<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'CRM',
    // preloading 'log' component
    'preload' => array('log'),
    // application components
    'components' => array(
        /*'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),
        // uncomment the following to use a MySQL database
        */
        'db' => array(
	     'connectionString' => 'mysql:host=localhost;dbname=sunnyhol_yii',
            'emulatePrepare' => true,
            'username' => 'sunnyhol_yii',
            'password' => 'sunnyhol_yii',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
	     'tablePrefix'=>''

        ),

    ),
);