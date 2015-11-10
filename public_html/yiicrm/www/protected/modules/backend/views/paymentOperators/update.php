<?php
/* @var $this PaymentOperatorsController */
/* @var $model PaymentOperators */

$this->breadcrumbs = array(
    'Payment Operators' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List PaymentOperators', 'url' => array('index')),
    array('label' => 'Create PaymentOperators', 'url' => array('create')),
    array('label' => 'View PaymentOperators', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage PaymentOperators', 'url' => array('admin')),
);
?>

    <h1>Update PaymentOperators <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>