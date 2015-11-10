<?php

class DefaultController extends BackendController
{
    public $layout = '/layouts/column1';

    public function beforeAction($action)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $this->layout = false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createUrl('backend/dashboard'));
        } else {
            $this->redirect(Yii::app()->createUrl('backend/default/login'));
        }

    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->createUrl('backend/default/index'));
        }
        $this->layout = '/layouts/login';
        $model = new AdminLoginForm;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['AdminLoginForm'])) {
            $model->attributes = $_POST['AdminLoginForm'];
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->createUrl('backend'));
            }
        }
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->createUrl('backend/default/login'));
    }
}