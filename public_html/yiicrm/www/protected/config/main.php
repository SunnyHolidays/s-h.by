<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/x-editable');
return CMap::mergeArray(
    array(
        'language' => 'ru',
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'CRM',
        // preloading 'log' component
        'preload' => array('log',),
        // autoloading model and component classes
        'import' => array(
            'application.models.*',
            'application.components.*',
            'application.components.widgets.*',
            'application.components.includes.*',
            'ext.YiiMailer.YiiMailer',
            'ext.imperavi-redactor-widget.ImperaviRedactorWidget',
            'editable.*',
        ),
        'modules' => array(// uncomment the following to enable the Gii tool
            'backend',
            
            /*	'gii'=>array(
                    'class'=>'system.gii.GiiModule',
                    'password'=>'123',
                    // If removed, Gii defaults to localhost only. Edit carefully to taste.
                    'ipFilters'=>array('127.0.0.1','::1'),
                                'generatorPaths' => array(
            ),
                ),*/

        ),
        // application components
        'components' => array(
            'editable' => array(
                'class'     => 'editable.EditableConfig',
                'form'      => 'bootstrap',        //form style: 'bootstrap', 'jqueryui', 'plain'
                'mode'      => 'popup',            //mode: 'popup' or 'inline'
                'defaults'  => array(              //default settings for all editable elements
                    'emptytext' => 'Не задан'
                )
            ),
            'user' => array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,

            ),
            // uncomment the following to enable URLs in path-format
            /*
            'urlManager'=>array(
                'urlFormat'=>'path',
                'rules'=>array(
                    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),
            */
            /*		'db'=>array(
                        'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
                    ),*/
            // uncomment the following to use a MySQL database

/*            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=crm',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ),*/
            'errorHandler' => array(
                // use 'site/error' action to display errors
                'errorAction' => 'site/error',
            ),
            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning, trace',
                    ),

                ),
            ),
        ),
        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params' => array(
            // this is used in contact page
            'adminEmail' => 'webmaster@example.com',
            'salt' => '$2a$10$s5EbdF7KRCmiUmZJKiLfeZ',
            'appDateFormat' => 'd.m.Y',
            'dbDateFormat' => 'Y-m-d',
            'uploadsPath' => Yii::getPathOfAlias('webroot.uploads').DIRECTORY_SEPARATOR
        ),
    ),
    local_config()
);

function local_config()
{
    if (file_exists(dirname(__FILE__) . '/local.php')) {
        return require_once(dirname(__FILE__) . '/local.php');
    }

    return array();
}