<?php
/* @var $this PaymentCustomersController */
/* @var $model PaymentCustomers */

$this->breadcrumbs = array(
    'Payment Customers' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List PaymentCustomers', 'url' => array('index')),
    array('label' => 'Manage PaymentCustomers', 'url' => array('admin')),
);
?>

    <h1>Create PaymentCustomers</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>