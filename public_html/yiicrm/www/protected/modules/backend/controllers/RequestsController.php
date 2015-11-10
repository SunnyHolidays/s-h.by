<?php

class RequestsController extends BackendController
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
                'actions' => array(
                    'index',
                    'view',
                    'create',
                    'update',
                    'delete',
                    'getfield',
                    'updateEditable',
                    'getComments',
                    'getGrid',
                ),
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
        $filters = array();
        $airports = array();
        $countries = array();

        if (!empty(Yii::app()->request->cookies['filters'])) {
            $filters = unserialize(Yii::app()->request->cookies['filters']);
        }

        $criteria = new CDbCriteria;
        $criteria->compare('request_id', $id);


        $dataProvider = new CActiveDataProvider('RequestComments', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 5)
        ));


        $model = $this->loadModel($id);
        foreach ($model->requestAirports as $value) {
            $airports[] = $value->airport;
        }
        foreach ($model->requestCountries as $value) {
            $countries[] = $value->country;
        }

        $requestID = $this->getRequestsID($filters);

        $this->render(
            'view',
            array(
                'model' => $model,
                'requestID' => $requestID,
                'dataProvider' => $dataProvider,
                'countries' => $countries,
                'airports' => $airports,
                'key' => array_search($model->id, $requestID),
            )
        );
    }

    public function actionGetComments($order_id, $request_id)
    {
        $criteriaComment = new CDbCriteria;
        if (!empty($request_id) and !empty($order_id)) {
            $criteriaComment->compare('order_id', $request_id);
            $criteriaComment->compare('request_id', $request_id);
        } elseif (!empty($request_id) and empty($order_id)) {
            $criteriaComment->compare('request_id', $request_id);
        }

        $dataProviderComment = new CActiveDataProvider('RequestComments', array(
            'criteria' => $criteriaComment,
            'pagination' => array('pageSize' => 5)
        ));

        $this->renderPartial(
            '/requestComments/index',
            array(
                'dataProvider' => $dataProviderComment,
                'order_id' => $order_id,
                'request_id' => $request_id,
                'controller' => 'requests',
            )
        );
    }

    public function getRequestsID($filters)
    {
        $data = null;
        $users = array();

        if (count($filters) != 0) {
            $data = Requests::model()->findAll(
                Requests::model()->searchCriteria(
                    $filters['requests_search'],
                    $filters['date_first'],
                    $filters['date_last'],
                    $filters['user_id'],
                    $filters['status']
                )
            );
        } else {
            $data = Requests::model()->findAll();
        }

        foreach ($data as $value) {
            $users[] = $value->id;
        }
        return $users;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Requests;
        if (isset($_POST['Requests'])) {
            $model->date = date('Y-m-d');
            $requestAirports = RequestAirports::updating($_POST['Requests']['requestAirports'], $model);
            $requestCountries = RequestCountries::updating($_POST['Requests']['requestCountries'], $model);
            $model->setAttributes($_POST['Requests']);
            $model->setRequestsAirports($requestAirports);
            $model->setRequestCountries($requestCountries);

            $model->source = 'sunnyholidays.by';
            if (isset($_POST['Requests']['child_age'])) {
                $model->setAttribute('child_age', $_POST['Requests']['child_age']);
            } else {
                $model->child_age = null;
            }
            if (!$model->date_next_step) {
                $model->setAttribute('date_next_step', $model->date);
            }
            if (!$model->user_id) {
                $model->setAttribute('user_id', null);
            }
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
        if (isset($_POST['Requests'])) {

            $requestAirports = RequestAirports::updating($_POST['Requests']['requestAirports'], $model);
            $requestCountries = RequestCountries::updating($_POST['Requests']['requestCountries'], $model);
            $model->setAttributes($_POST['Requests']);
            if (!$model->user_id) {
                $model->setAttribute('user_id', null);
            }

            $model->setRequestsAirports($requestAirports);
            $model->setRequestCountries($requestCountries);
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

    public function actionUpdateEditable()
    {

        if ($_POST['name'] == 'requestCountries') {
            $model = new RequestCountries;
            $model->deleteAllByAttributes(array('request_id' => $_POST['pk']));
            if (isset($_POST['value'])) {
                foreach ($_POST['value'] as $country) {
                    if (!empty($country)) {
                        $model = new RequestCountries;
                        $model->setAttributes(array('request_id' => $_POST['pk'], 'country_id' => $country));
                        $model->save();
                    }
                }
            }
        } elseif ($_POST['name'] == 'requestAirports') {
            $model = new RequestAirports;
            $model->deleteAllByAttributes(array('request_id' => $_POST['pk']));
            if (isset($_POST['value'])) {
                foreach ($_POST['value'] as $airport) {
                    if (!empty($airport)) {
                        $model = new RequestAirports;
                        $model->setAttributes(array('request_id' => $_POST['pk'], 'airport_id' => $airport));
                        $model->save();
                    }
                }
            }

        } else {
            $model = new EditableSaver('Requests');
            $model->update();
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
            $this->redirect(array('index'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new Requests('search');
        $filters = null;

        if (isset($_GET['Requests'])) {
            Yii::app()->request->cookies['filters'] = new CHttpCookie('filters', serialize($_GET['Requests']));
            $filters = $_GET['Requests'];
        } elseif (!empty(Yii::app()->request->cookies['filters'])) {
            $filters = unserialize(Yii::app()->request->cookies['filters']->value);
        }

        $this->render(
            'index',
            array(
                'model' => $model,
                'filters' => $filters,
            )
        );
    }

    public function actionGetGrid()
    {
        $filters = null;

        $model = new Requests('search');
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['Requests'])) {
            Yii::app()->request->cookies['filters'] = new CHttpCookie('filters', serialize($_GET['Requests']));
            $filters = $_GET['Requests'];
        } elseif (!empty(Yii::app()->request->cookies['filters'])) {
            $filters = unserialize(Yii::app()->request->cookies['filters']->value);
        }

        $model->attributes = $filters;
        $dataProvider = $model->search();

        $this->renderPartial(
            '_grid',
            array(
                'dataProvider' => $dataProvider
            )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Requests the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Requests::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'Запрошеная страница не найдена.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Requests $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'requests-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
