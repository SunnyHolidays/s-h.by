<?php
/**
 * Created by JetBrains PhpStorm.
 * User: amd1648
 * Date: 13.06.13
 * Time: 14:27
 * To change this template use File | Settings | File Templates.
 */

return array(
    'import' => array(
        'backend.models.*',
        'backend.components.*',
    ),
      'components' => array(
        'errorHandler' => array(
            'errorAction' => 'backend/default/error'
        ),
        'user' => array(
            'class' => 'BackendWebUser',
            'loginUrl' => Yii::app()->createUrl('backend/default/login'),
            'stateKeyPrefix' => '_backend',
            'allowAutoLogin'=>true,
        ),
        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),

    ),
    'params' => array('test' =>'da')
);