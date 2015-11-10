<?php
/**
 * Created by JetBrains PhpStorm.
 * User: amd1648
 * Date: 12.06.13
 * Time: 13:55
 * To change this template use File | Settings | File Templates.
 */

class AdminLoginForm extends CFormModel{

    const ROLE_ADMIN = 2;
    const ROLE_MANAGER = 1;
    const ROLE_GUEST = 0;


    public $login;
    public $password;
    public $rememberMe;

    private $_identity;

    public function rules()
    {
        return array(
            array('login, password', 'required', 'message' => 'Поле {attribute} не должно быть пустым'),
            array('rememberMe', 'boolean'),
            array('password', 'authenticate'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'rememberMe' => 'Запомнить',
            'login' => 'Логин',
            'password' => 'Пароль'
        );
    }

    public function authenticate($attribute, $params)
    {
        if(!$this->hasErrors()){
            $this->_identity = new AdminIdentity($this->login, $this->password);
            if(!$this->_identity->authenticate()){
                $this->addError('error', 'Неправильный логин или пароль!');
            }
        }
    }

    public function login()
    {
        if($this->_identity === null) {
            $this->_identity = new AdminIdentity($this->login, $this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode === AdminIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600*24*30 : 0;
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else {
            return false;
        }
    }

}