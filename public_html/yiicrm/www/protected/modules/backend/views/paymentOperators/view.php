<?php
/* @var $this PaymentOperatorsController */
/* @var $model PaymentOperators */

$this->breadcrumbs = array(
    'Payment Operators' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List PaymentOperators', 'url' => array('index')),
    array('label' => 'Create PaymentOperators', 'url' => array('create')),
    array('label' => 'Update PaymentOperators', 'url' => array('update', 'id' => $model->id)),
    array(
        'label' => 'Delete PaymentOperators',
        'url' => '#',
        'linkOptions' => array(
            'submit' => array('delete', 'id' => $model->id),
            'confirm' => 'Are you sure you want to delete this item?'
        )
    ),
    array('label' => 'Manage PaymentOperators', 'url' => array('admin')),
);
?>

<h1>View PaymentOperators #<?php echo $model->id; ?></h1>

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
            'order_id',
        ),
    )
); ?>
