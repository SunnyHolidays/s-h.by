<?php
/* @var $this OrdersController */
/* @var $data Orders */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
    <?php echo CHtml::encode($data->number); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('tour_operator_id')); ?>:</b>
    <?php echo CHtml::encode($data->tour_operator_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
    <?php echo CHtml::encode($data->date); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('date_departure')); ?>:</b>
    <?php echo CHtml::encode($data->date_departure); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('date_return')); ?>:</b>
    <?php echo CHtml::encode($data->date_return); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('country_id')); ?>:</b>
    <?php echo CHtml::encode($data->country_id); ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('region_id')); ?>:</b>
	<?php echo CHtml::encode($data->region_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hotel_id')); ?>:</b>
	<?php echo CHtml::encode($data->hotel_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('airport_id')); ?>:</b>
	<?php echo CHtml::encode($data->airport_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commission')); ?>:</b>
	<?php echo CHtml::encode($data->commission); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currency_id')); ?>:</b>
	<?php echo CHtml::encode($data->currency_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	*/ ?>

</div>