<?php
/* @var $this FinancesController */
/* @var $model ExchangeRates */
$this->breadcrumbs = array(
    'Курсы валют' => array('index'),
);
Yii::app()->clientScript->registerCoreScript('yiiactiveform');

$this->header = 'Финансы';
$this->setPageTitle('Финансы');

echo $this->renderPartial(
    '_exchangeRatesGrid',
    array(
        'model' => $model
    )
);
echo $this->renderPartial(
    '_currencyGrid',
    array(
        'header' => 'Валюта'
    )
);
