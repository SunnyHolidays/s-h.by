<?php
/**
 * Created by JetBrains PhpStorm.
 * User: amd1648
 * Date: 13.06.13
 * Time: 11:06
 * To change this template use File | Settings | File Templates.
 */

class PhpAuthManager extends CPhpAuthManager
{
    const ROLE_GUEST = 'guest';
    const ROLE_USER = 0;
    const ROLE_MANAGER = 1;
    const ROLE_ADMIN = 2;


    public function init()
    {
        if ($this->authFile === null) {
            $this->authFile = Yii::getPathOfAlias('application.config.auth') . '.php';
        }

        parent::init();
        if (!Yii::app()->user->isGuest) {
            $this->assign(Yii::app()->user->role, Yii::app()->user->id);
        }
    }
}