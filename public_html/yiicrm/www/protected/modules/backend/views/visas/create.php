<?php
/* @var $this VisasController */
/* @var $model Visas */
/* @var $orderID integer */

$this->breadcrumbs=array(
	'Visas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Visas', 'url'=>array('index')),
	array('label'=>'Manage Visas', 'url'=>array('admin')),
);
$this->header = 'Добавление визы';
?>

<?php $this->renderPartial(
    '_form',
    array(
        'model' => $model,
        'orderID' => $orderID
    )); ?>