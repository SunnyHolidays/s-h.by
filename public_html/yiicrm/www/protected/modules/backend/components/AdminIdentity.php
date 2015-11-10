<?php

class AdminIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {
        $user = Users::model()->findByAttributes(array('login' => $this->username));

        if($user===null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif($user->password !== crypt($this->password, Yii::app()->params['salt']))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else{
            $this->_id = $user->id;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId(){
        return $this->_id;
    }
}
