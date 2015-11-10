<?php
/* @var $this PaymentCustomersController */
/* @var $model PaymentCustomers */

$this->breadcrumbs = array(
    'Payment Customers' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List PaymentCustomers', 'url' => array('index')),
    array('label' => 'Create PaymentCustomers', 'url' => array('create')),
    array('label' => 'Update PaymentCustomers', 'url' => array('update', 'id' => $model->id)),
    array(
        'label' => 'Delete PaymentCustomers',
        'url' => '#',
        'linkOptions' => array(
            'submit' => array('delete', 'id' => $model->id),
            'confirm' => 'Are you sure you want to delete this item?'
        )
    ),
    array('label' => 'Manage PaymentCustomers', 'url' => array('admin')),
);
?>

<h1>View PaymentCustomers #<?php echo $model->id; ?></h1>

<?php $this->widget(
    'zii.widgets.CDetailView',
    array(
        'data' => $model,
        'attributes' => array(
            'id',
            'date',
            'amount_due',
            'date_payment',
            'amount_paid',
            'currency_id',
            'exchange_rate_id',
            'order_id',
        ),
    )
); ?>
