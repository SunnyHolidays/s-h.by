<?php

class PlacesController extends BackendController
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
            'postOnly + deleteAirport + deleteHotel', // we only allow deletion via POST request
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
                'actions' => array('index', 'view', 'createAirport', 'updateAirport', 'deleteAirport', 'getAirportsGrid','createHotel', 'updateHotel', 'deleteHotel', 'getHotelsGrid'),
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
                'model' => $this->loadAirportModel($id),
            )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateAirport()
    {
        $model = new Airports;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Airports'])) {
            $model->attributes = $_POST['Airports'];
            if ($model->save()) {
                echo true;
            }
        }else{
            $this->renderPartial(
                'createAirport',
                array(
                    'model' => $model,
                ), false, true
            );
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateAirport($id)
    {
        $model = $this->loadAirportModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Airports'])) {
            $model->attributes = $_POST['Airports'];
            if ($model->save()) {
                echo true;
            }
        }else{
            $this->renderPartial(
                'updateAirport',
                array(
                    'model' => $model,
                ), false, true
            );
        }

    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeleteAirport($id)
    {
        $this->getOrders($this->loadAirportModel($id));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $airportsModel = new Airports('search');
        $hotelsModel = new Hotels('search');
        $this->render(
            'index',
            array(
                'airportsModel' => $airportsModel,
                'hotelsModel' => $hotelsModel
            )
        );
    }

    public function actionGetAirportsGrid()
    {
        $model = new Airports('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Airports'])) {
            $model->attributes = $_GET['Airports'];
        }
        $this->renderPartial('_airportsGrid', array('model' => $model));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Airports the loaded model
     * @throws CHttpException
     */
    public function loadAirportModel($id)
    {
        $model = Airports::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionCreateHotel()
    {
        $model = new Hotels;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Hotels'])) {
            $model->attributes = $_POST['Hotels'];
            if ($model->save()) {
                echo true;
            }
        }else{
            $this->renderPartial(
                'createHotel',
                array(
                    'model' => $model,
                ), false, true
            );
        }


    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateHotel($id)
    {
        $model = $this->loadHotelModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Hotels'])) {
            $model->attributes = $_POST['Hotels'];
            if ($model->save()) {
                echo true;
            }
        }else{
            $this->renderPartial(
                'updateHotel',
                array(
                    'model' => $model,
                ), false, true
            );
        }


    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeleteHotel($id)
    {
        $this->getOrders($this->loadHotelModel($id));
    }

    public function actionGetHotelsGrid()
    {
        $model = new Hotels('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Hotels'])) {
            $model->attributes = $_GET['Hotels'];
        }
        $this->renderPartial('_hotelsGrid', array('model' => $model));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Hotels the loaded model
     * @throws CHttpException
     */
    public function loadHotelModel($id)
    {
        $model = Hotels::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Airports $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'airports-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * @param $model CActiveRecord
     */
    private function getOrders($model)
    {
        if(!empty($model->packageTours)){
            $tours = array();
            foreach($model->packageTours as $key=>$value){
                $tours[] = array(
                    'id' => $value->order->id,
                    'l_name'=>$value->order->last_name,
                    'f_name' => $value->order->first_name,
                    'date' => $value->date,
                    'country' => $value->country->title
                );
            }
            echo json_encode($tours);
        }else{
            $model->delete();
        }
    }
}
