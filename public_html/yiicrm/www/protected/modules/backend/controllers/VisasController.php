<?php

class VisasController extends BackendController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '/layouts/column1';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'update', 'delete'),
                'roles' => array(PhpAuthManager::ROLE_MANAGER),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->renderPartial(
            'view',
            array(
                'model' => $this->loadModel($id),
            )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id = null)
    {
        $model = new Visas;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Visas'])) {
            $model->attributes = $_POST['Visas'];
            if ($model->save()) {
                echo true;
            }
        } else {

            // @todo Optimize this code

            $participantIdOrder = Participants::model()->findAll(
                'order_id=:order_id',
                array(':order_id' => $id)
            );

            foreach ($participantIdOrder as $key => $val) {
                if (!empty($val->visas)) {
                    unset($participantIdOrder[$key]);
                }
            }
            if(!empty($participantIdOrder)){
                $this->renderPartial(
                    'create',
                    array(
                        'model' => $model,
                        'orderID' => $id,
                    ), false, true
                );
            }
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id, $orderID = null)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Visas'])) {
            $model->attributes = $_POST['Visas'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        } else {
            $this->renderPartial(
                'update',
                array(
                    'model' => $model,
                    'orderID' => $orderID,
                )
            );
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
//    public function actionIndex()
//    {
//        $model = new Visas('search');
//        $model->unsetAttributes(); // clear any default values
//        if (isset($_GET['Visas'])) {
//            $model->attributes = $_GET['Visas'];
//        }
//
//        $this->renderPartial(
//            'index',
//            array(
//                'model' => $model,
//            )
//        );
//    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Visas the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Visas::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Visas $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'visas-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
