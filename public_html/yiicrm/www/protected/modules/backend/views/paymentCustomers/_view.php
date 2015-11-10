<?php
/* @var $this PaymentCustomersController */
/* @var $data PaymentCustomers */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
    <?php echo CHtml::encode($data->date); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('amount_due')); ?>:</b>
    <?php echo CHtml::encode($data->amount_due); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('date_payment')); ?>:</b>
    <?php echo CHtml::encode($data->date_payment); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('amount_paid')); ?>:</b>
    <?php echo CHtml::encode($data->amount_paid); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('currency_id')); ?>:</b>
    <?php echo CHtml::encode($data->currency_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('exchange_rate_id')); ?>:</b>
    <?php echo CHtml::encode($data->exchange_rate_id); ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('order_id')); ?>:</b>
	<?php echo CHtml::encode($data->order_id); ?>
	<br />

	*/ ?>

</div>