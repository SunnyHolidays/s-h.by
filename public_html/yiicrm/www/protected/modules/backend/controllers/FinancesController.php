<?php

class FinancesController extends BackendController
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
                    'createExchangeRates',
                    'updateExchangeRates',
                    'delete',
                    'getgrid',
                    'createCurrency',
                    'updateCurrency',
                    'deleteCurrency'
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateExchangeRates()
    {
        $model = new ExchangeRates;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ExchangeRates'])) {
            $model->attributes = $_POST['ExchangeRates'];
            if ($model->save()) {
                echo true;
            }
        } else {
            $this->renderPartial(
                'createExchangeRates',
                array(
                    'model' => $model,
                    'title' => 'Добавить курс обмена'
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
    public function actionUpdateExchangeRates($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ExchangeRates'])) {
            $model->attributes = $_POST['ExchangeRates'];
            if ($model->save()) {
                echo true;
            }
        } else {
            $this->renderPartial(
                'updateExchangeRates',
                array(
                    'model' => $model,
                    'title' => 'Обновить курс обмена ' . $model->firstCurrency->title . ' - ' . $model->secondCurrency->title,
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
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new ExchangeRates('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['ExchangeRates'])) {
            $model->attributes = $_GET['ExchangeRates'];
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
     * @return ExchangeRates the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = ExchangeRates::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ExchangeRates $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'exchange-rates-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetGrid($view)
    {
        if($view === 'rates'){
            $model = new ExchangeRates('search');
            $model->unsetAttributes(); // clear any default values
            if (isset($_GET['ExchangeRates'])) {
                $model->attributes = $_GET['ExchangeRates'];
            }
            $this->renderPartial('_exchangeRatesGrid', array('model' => $model));
        }else{
            $this->renderPartial('_currencyGrid');
        }


    }

    public function actionCreateCurrency()
    {
        $model = new Currency;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Currency'])) {
            $model->attributes = $_POST['Currency'];

            if ($model->save()) {
                echo true;
            }

        } else {
            $this->renderPartial(
                'createCurrency',
                array(
                    'model' => $model,
                ),
                false,
                true
            );
        }
    }

    public function actionUpdateCurrency($id)
    {
        $model = $this->loadCurrencyModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Currency'])) {
            $model->attributes = $_POST['Currency'];
            if ($model->save()) {
                echo true;
            }
        } else {

            $this->renderPartial(
                'updateCurrency',
                array(
                    'model' => $model,
                ),
                false,
                true
            );
        }
    }

    public function actionDeleteCurrency($id)
    {
        $this->loadCurrencyModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    public function loadCurrencyModel($id)
    {
        $model = Currency::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
}
