<?php
/**
 * Created by JetBrains PhpStorm.
 * User: amd1648
 * Date: 13.06.13
 * Time: 11:01
 * To change this template use File | Settings | File Templates.
 */

class BackendWebUser extends CWebUser {
    private $_model = null;

    public function getRole() {
        if($user = $this->getModel()){
            return $user->role_id;
        }
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = Users::model()->findByPk($this->id, array('select' => 'role_id'));
        }
        return $this->_model;
    }
}