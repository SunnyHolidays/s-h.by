<?php

class RequestCommentsController extends BackendController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '/layouts/column2';

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
        $this->render(
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
    public function actionCreate()
    {
        $model = new RequestComments;
        if(Yii::app()->request->getParam('order_id')){
            $model->order_id = Yii::app()->request->getParam('order_id');
        }
        if(Yii::app()->request->getParam('request_id')){
            $model->request_id = Yii::app()->request->getParam('request_id');
        }

        if (isset($_POST['RequestComments'])) {

            $model->request_id = Yii::app()->request->getParam('request_id');
            $model->user_id = Yii::app()->user->id;
            $model->date = date('Y-m-d');
            $model->comment = $_POST['RequestComments']['comment'];
            $model->order_id = Yii::app()->request->getParam('order_id');

            if ($model->save()) {
                if (empty($model->order_id)) {
                    $comments_id = Yii::app()->session['comments_buffer'];
                    $comments_id[] = $model->id;
                    Yii::app()->session['comments_buffer'] = $comments_id;
                }
            }
        } else {
            $this->renderPartial(
                '_form',
                array(
                    'model' => $model,
                    'order_id' => $model->order_id,
                    'request_id' => $model->request_id,
                    'controller' => Yii::app()->request->getParam('controller')
                ),
                false,
                true
            );
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {

        $model = $this->loadModel($id);

        if (isset($_POST['RequestComments'])) {
            $model->attributes = $_POST['RequestComments'];
            if ($model->validate()) {
                $model->save();
            }
        } else {
            $this->renderPartial(
                '_form',
                array(
                    'model' => $model,
                    'order_id' => Yii::app()->request->getParam('order_id'),
                    'request_id' => Yii::app()->request->getParam('request_id'),
                    'controller' => Yii::app()->request->getParam('controller'),
                ),
                false,
                true
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
//		if(!isset($_GET['ajax'])){
//			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
//        }
    }

    /**
     * Lists all models.
     */
//    public function actionIndex()
//    {
//        $model = new RequestComments();
//        $criteria=new CDbCriteria;
//
//        $criteria->compare('request_id',Yii::app()->session['requestID']);
//
//        $dataProvider=new CActiveDataProvider('RequestComments',array('criteria'=>$criteria));
//        $this->renderPartial('index',array(
//                'dataProvider'=>$dataProvider,
//                'model'=>$model,
//            ),false,true);
//    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new RequestComments('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['RequestComments'])) {
            $model->attributes = $_GET['RequestComments'];
        }

        $this->render(
            'admin',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return RequestComments the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = RequestComments::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param RequestComments $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'request-comments-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
