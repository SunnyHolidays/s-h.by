<?php
/* @var $this PaymentCustomersController */
/* @var $model PaymentCustomers */

$this->breadcrumbs = array(
    'Payment Customers' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List PaymentCustomers', 'url' => array('index')),
    array('label' => 'Create PaymentCustomers', 'url' => array('create')),
    array('label' => 'View PaymentCustomers', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage PaymentCustomers', 'url' => array('admin')),
);
?>

    <h1>Update PaymentCustomers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>