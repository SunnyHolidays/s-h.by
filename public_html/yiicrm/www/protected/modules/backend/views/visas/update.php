<?php
/* @var $this VisasController */
/* @var $model Visas */
/* @var $orderID integer */

$this->breadcrumbs = array(
    'Visases' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Visas', 'url' => array('index')),
    array('label' => 'Create Visas', 'url' => array('create')),
    array('label' => 'View Visas', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Visas', 'url' => array('admin')),
);
$this->header = 'Обновление визы';
?>

<?php $this->renderPartial(
    '_form',
    array(
        'model' => $model,
        'orderID' => $orderID
    )); ?>