<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $order_id integer */
/* @var $criteria CDbCriteria */
/* @var RequestComments $dataProviderComment*/

$this->breadcrumbs = array(
    'Заказы' => array('index'),
    'Создать',
);
$this->setPageTitle("Создать заказ");
$this->headerMenu = array(
    array('label' => 'Список заказов', 'url' => array('index'), 'icon' => 'icon-list'),
);
$this->header = 'Создать заказ';

$this->renderPartial(
    '_form',
    array('model' => $model, 'order_id' => null)
); ?>