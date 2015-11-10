<?php

class OrdersController extends BackendController
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
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update',
                    'delete',
                    'index',
                    'view',
                    'updateparticipant',
                    'createparticipant',
                    'deleteparticipant',
                    'viewparticipant',
                    'getgrid',
                    'visasview',
                    'visascreate',
                    'visasupdate',
                    'visasdelete',
                    'updateEditable',
                    'getCurrency',
                    'getDepend',
                    'getComments',
                    'getGridOrders'
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

        if (!empty(Yii::app()->request->cookies['filtersOrders'])) {
            $filters = unserialize(Yii::app()->request->cookies['filtersOrders']);
        }
        $model = $this->loadModel($id);

        $criteria = new CDbCriteria();
        $criteria->condition = 'order_id=:id';
        $criteria->params = array(':id' => $id);

        $ordersID = $this->getOrdersID($filters);

        Yii::app()->session['orderID'] = $model->id;

        $this->render(
            'view',
            array(
                'model' => $model,
                'order_id' => $id,
                'criteria' => $criteria,
                'ordersID' => $ordersID,
                'key' => array_search($model->id, $ordersID),
            )
        );
    }

    public function saveBufferInfo($type,$id,$model, $attribute)
    {
        $session = Yii::app()->session[$type];
        if (!empty($session)) {
            foreach ($session as $key => $value) {
                $buffer = $model->findByPk($value);
                if ($buffer) {
                    $buffer->setAttribute($attribute, $id);
                    $buffer->save();
                }
            }
            unset(Yii::app()->session[$type]);
        }
    }

    /**
     * @param $model Orders
     * @param $info string
     * @return bool
     */
    private function checkHotel($model, $info)
    {
        if(!Hotels::model()->findByPk($model->packageTour->hotel_id)){
            $newHotel = new Hotels();
            $newHotel->title = $info;
            $newHotel->region_id = $model->packageTour->region_id;
            return $newHotel->save();
        }
        return true;
    }


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Orders;
        $model->packageTour = new PackageTour;
        /**
         * todo описат эту логику в поведении
         */
        if (isset($_POST['Orders'])) {
            $model->attributes = $_POST['Orders'];
            $model->packageTour->attributes = $_POST['PackageTour'];
            if(Hotels::model()->findByPk($model->packageTour->hotel_id)===null){
                $hotel = new Hotels();
                $hotel->region_id = $model->packageTour->region_id;
                $hotel->title = $_POST['PackageTour']['hotel_id'];
                if($hotel->save()){
                    $model->packageTour->hotel_id = $hotel->id;
                }
            }
            if (!$model->user_id) {
                $model->setAttribute('user_id', null);
            }
            if (!$model->sub_agent_id) {
                $model->setAttribute('sub_agent_id', null);
            }
            if ($model->packageTour->save()) {
                $model->setAttribute('package_tour_id', $model->packageTour->id);

                if ($model->save()) {
                    $this->saveBufferInfo('participants_buffer',$model->id,Participants::model(),'order_id');
                    $this->saveBufferInfo('comments_buffer',$model->id,RequestComments::model(),'order_id');
                    $this->saveBufferInfo('attachments',$model->id,Attachments::model(),'owner');
                    $this->redirect(array('view', 'id' => $model->id));
                } else {
                    var_dump($model->errors);
                    exit;
                }
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

        Yii::app()->session['orderID'] = $model->id;

        if (isset($_POST['Orders'])) {
            $model->attributes = $_POST['Orders'];
            $model->packageTour->attributes = $_POST['PackageTour'];
            if(Hotels::model()->findByPk($model->packageTour->hotel_id)===null){
                $hotel = new Hotels();
                $hotel->region_id = $model->packageTour->region_id;
                $hotel->title = $_POST['PackageTour']['hotel_id'];
                if($hotel->save()){
                    $model->packageTour->hotel_id = $hotel->id;
                }
            }
            if (!$model->user_id) {
                $model->setAttribute('user_id', null);
            }
            if (!$model->sub_agent_id) {
                $model->setAttribute('sub_agent_id', null);
            }
            if($model->packageTour->save()){
                if ($model->save()) {
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }

        }

        $this->render(
            'update',
            array(
                'model' => $model,
                'order_id' => $id,
            )
        );
    }

    public function actionUpdateEditable($model)
    {
        $model = new EditableSaver($model);
        $response = array();
        if(yii::app()->request->getParam('name') == 'hotel_id'){
            $value = yii::app()->request->getParam('value');
            if(Hotels::model()->findByPk($value)===null){
                $newHotel = new Hotels;
                $newHotel->region_id = Orders::model()->findByPk(yii::app()->request->getParam('pk'))->packageTour->region_id;
                $newHotel->title = $value;
                if($newHotel->save()){
                    $_POST['value'] = $newHotel->id;
                }
                $response = array('id' => $newHotel->id, 'text' => $newHotel->title);
            }
        }
        $model->update();
        echo CJSON::encode($response);
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
        $filters = null;

        $model = new Orders('search');

        if (isset($_GET['Orders'])) {
            Yii::app()->request->cookies['filtersOrders'] = new CHttpCookie('filtersOrders', serialize(
                $_GET['Orders']
            ));
            $filters = $_GET['Orders'];
        } elseif (!empty(Yii::app()->request->cookies['filtersOrders'])) {
            $filters = unserialize(Yii::app()->request->cookies['filtersOrders']->value);
        }

        $this->render(
            'index',
            array(
                'model' => $model,
                'filters' => $filters,
            )
        );
    }

    public function actionGetGridOrders()
    {
        $filters = null;

        $model = new Orders('search');
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['Orders'])) {
            Yii::app()->request->cookies['filtersOrders'] = new CHttpCookie('filtersOrders', serialize(
                $_GET['Orders']
            ));
            $filters = $_GET['Orders'];
        } elseif (!empty(Yii::app()->request->cookies['filtersOrders'])) {
            $filters = unserialize(Yii::app()->request->cookies['filtersOrders']->value);
        }

        $model->attributes = $filters;
        $dataProvider = $model->search();

        $this->renderPartial(
            '_gridOrders',
            array(
                'dataProvider' => $dataProvider,
            )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Orders the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Orders::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Orders $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'orders-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetComments($order_id,$request_id)
    {

        $criteriaComment = new CDbCriteria;
        if(!empty($order_id) and !empty($request_id)){
            $criteriaComment->compare('request_id', $request_id);
            $criteriaComment->compare('order_id', $order_id);
        }elseif(empty($request_id) and !empty($order_id)){
            $criteriaComment->compare('order_id', $order_id);
        }else{
            $criteriaComment->addInCondition('id',Yii::app()->session['comments_buffer'],'OR');
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
                'controller' => 'orders',
            )
        );
    }

    /**
     * return list of order participants
     * @param $order_id
     * @internal param $criteria
     */
    public function actionGetGrid($order_id)
    {
        $criteria = new CDbCriteria();
        if ($order_id == null) {
            $criteria->addInCondition('id', Yii::app()->session['participants_buffer']);
        } else {
            $criteria->condition = 'order_id=:id';
            $criteria->params = array(':id' => $order_id);
        }
        $this->renderPartial('_grid', array('order_id' => $order_id, 'criteria' => $criteria));
    }

    /**
     * return selected currency symbol
     * @param $currency_id
     */
    public function actionGetCurrency($currency_id)
    {
        $currency = Currency::model()->findByPk($currency_id);
        echo CHtml::encode($currency->symbol);
    }

    public function actionCreateParticipant()
    {
        $model = new Participants;
        if (Yii::app()->request->getParam('order_id')) {
            $model->order_id = Yii::app()->request->getParam('order_id');
        } else {
            if (empty(Yii::app()->session['participants_buffer'])) {
                Yii::app()->session['participants_buffer'] = array();
            }
        }

        if (isset($_POST['Participants'])) {
            $model->attributes = $_POST['Participants'];
            if ($model->save()) {
                if (empty($model->order_id)) {
                    $ids = Yii::app()->session['participants_buffer'];
                    $ids[] = $model->id;
                    Yii::app()->session['participants_buffer'] = $ids;
                }
                echo true;
            }
        } else {
            $this->renderPartial(
                '_participant',
                array(
                    'model' => $model,
                    'title' => 'Добавление участника'
                ),
                false,
                true
            );
        }
    }

    public function actionViewParticipant($id)
    {
        $model = $this->loadParticipantModel($id);
        $this->renderPartial('_participantView', array('model' => $model));
    }

    public function actionUpdateParticipant($id)
    {
        $model = $this->loadParticipantModel($id);

        if (isset($_POST['Participants'])) {
            $model->attributes = $_POST['Participants'];
            if ($model->save()) {
                echo true;
            }
        } else {
            $this->renderPartial(
                '_participant',
                array(
                    'model' => $model,
                    'title' => 'Обновление информации об участнике'
                ),
                false,
                true
            );
        }

    }

    public function actionDeleteParticipant($id)
    {
        $this->loadParticipantModel($id)->delete();
        $session = Yii::app()->session['participants_buffer'];
        if (!empty($session)) {
            unset($session[array_search($id, $session)]);
        }
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    public function loadParticipantModel($id)
    {
        $model = Participants::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionVisasView($id)
    {
        $model = $this->loadVisasModel($id);

        $this->renderPartial(
            '_visasview',
            array(
                'model' => $model,
            )
        );
    }

    public function actionVisasCreate($id = null)
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
            if (!empty($participantIdOrder)) {
                $this->renderPartial(
                    '_visasform',
                    array(
                        'model' => $model,
                        'orderID' => $id,
                        'header' => 'Добавление визы',
                    ),
                    false,
                    true
                );
            }
        }
    }

    public function actionVisasUpdate($id, $orderID = null)
    {
        $model = $this->loadVisasModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Visas'])) {
            $model->attributes = $_POST['Visas'];
            if ($model->save()) {
                echo true;
            }
        } else {
            $this->renderPartial(
                '_visasform',
                array(
                    'model' => $model,
                    'orderID' => $orderID,
                    'header' => 'Обновление визы',
                ),
                false,
                true
            );
        }
    }

    public function actionVisasDelete($id)
    {
        $this->loadVisasModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    public function loadVisasModel($id)
    {
        $model = Visas::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function getOrdersID($filters)
    {
        $data = null;
        $users = array();

        if (count($filters) != 0) {
            $data = Orders::model()->findAll(
                Orders::model()->searchCriteria(
                    $filters['orders_search'],
                    $filters['date_first'],
                    $filters['date_last'],
                    $filters['user_id']
                )
            );
        } else {
            $data = Orders::model()->findAll();
        }

        foreach ($data as $value) {
            $users[] = $value->id;
        }
        return $users;
    }

    /**
     * @param $id integer
     * @param $depend CActiveRecord
     * @param $key string
     * @return array
     */
    public function actionGetDepend($id, $depend, $key)
    {
        $model = $depend::model()->findAll("$key=:id", array(':id' => $id));
        echo json_encode(CHtml::listData($model, 'id', 'title'));
    }

}
