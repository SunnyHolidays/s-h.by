<?php
/* @var $this RequestsController */
/* @var $data Requests */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
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

    <b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
    <?php echo CHtml::encode($data->duration); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('adults')); ?>:</b>
    <?php echo CHtml::encode($data->adults); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('children')); ?>:</b>
    <?php echo CHtml::encode($data->children); ?>
    <br/>

    <?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('budget')); ?>:</b>
	<?php echo CHtml::encode($data->budget); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('params')); ?>:</b>
	<?php echo CHtml::encode($data->params); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_next_step')); ?>:</b>
	<?php echo CHtml::encode($data->date_next_step); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description_next_step')); ?>:</b>
	<?php echo CHtml::encode($data->description_next_step); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('source')); ?>:</b>
	<?php echo CHtml::encode($data->source); ?>
	<br />

	*/ ?>

</div>