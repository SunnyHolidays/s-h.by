<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $order_id integer */
/* @var $criteria CDbCriteria */
/* @var RequestComments $dataProviderComment */

$this->breadcrumbs = array(
    'Заказы' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Обновить',
);

$this->setPageTitle("Обновить заказ");
$this->headerMenu = array(

    array('label' => 'Список заказов', 'url' => array('index'), 'icon' => 'icon-list'),
    array('label' => 'Создать заказов', 'url' => array('create'), 'icon' => 'icon-plus'),
    array('label' => 'Просмотреть заказов', 'url' => array('view', 'id' => $model->id), 'icon' => 'icon-eye-open'),
);

$this->header = 'Обновление заказа';
?>

<?php $this->renderPartial(
    '_form',
    array('model' => $model, 'order_id' => $order_id)
); ?>