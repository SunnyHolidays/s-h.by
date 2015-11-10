<?php

class AttachmentsController extends BackendController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '/layouts/column1';
    public $savePathAlias = 'webroot.uploads';

    public function getSavePath()
    {
        return Yii::getPathOfAlias($this->savePathAlias) . DIRECTORY_SEPARATOR;
    }
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
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'download', 'upload'),
                'roles' => array(PhpAuthManager::ROLE_MANAGER),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function actionDownload($id)
    {
        $model = $this->loadModel($id);
        $path = Yii::getPathOfAlias($this->savePathAlias).DIRECTORY_SEPARATOR.$model->path;
        header("Content-Type: ".CFileHelper::getMimeType($path));
        header("Content-Disposition: attachment; filename=\"{$model->path}\"");
        readfile($path);
        Yii::app()->end();
    }

    /**
     * @param $owner
     * @param $type
     */
    public function actionUpload($owner, $type)
    {
        if($files = CUploadedFile::getInstancesByName('files')){
            echo CJSON::encode(AttachmentsHelper::saveAttachments($files, $owner, $type));
        }else{
            $files = array();
            $attachments = Attachments::model()->findAll('owner=:owner AND type=:type', array(':owner' => $owner, ':type' => $type));
            foreach($attachments as $key=>$attach){
                $files[] = array(
                    'name' => $attach->path,
                    'size' => filesize(self::getSavePath().'/'.$attach->path),
                    'type' => CFileHelper::getMimeTypeByExtension($attach->path),
                    'url' => Yii::app()->createUrl('backend/attachments/download', array('id' => $attach->id)),
                    'deleteUrl' => Yii::app()->createUrl('backend/attachments/delete', array('id' => $attach->id)),
                    'deleteType' => 'post'
                );
            }
            echo CJSON::encode(array('files' => $files));
        }

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
        $model = new Attachments;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Attachments'])) {
            $model->attributes = $_POST['Attachments'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render(
            'create',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Attachments'])) {
            $model->attributes = $_POST['Attachments'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render(
            'update',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $name = $model->path;
        if ($model->delete()) {
            AttachmentsHelper::deleteAttachment($model->path);
            echo CJSON::encode(array($name => true));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new Attachments('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Attachments'])) {
            $model->attributes = $_GET['Attachments'];
        }

        $this->render(
            'index',
            array(
                'model' => $model,
            )
        );
    }



    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Attachments the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Attachments::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Attachments $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'attachments-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
