<?php
/* @var $this PaymentOperatorsController */
/* @var $model PaymentOperators */

$this->breadcrumbs = array(
    'Payment Operators' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List PaymentOperators', 'url' => array('index')),
    array('label' => 'Manage PaymentOperators', 'url' => array('admin')),
);
?>

    <h1>Create PaymentOperators</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>