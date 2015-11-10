<?php
/* @var $this AttachmentsController */
/* @var $data Attachments */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('path')); ?>:</b>
    <?php echo CHtml::encode($data->path); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
    <?php echo CHtml::encode($data->type); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('owner')); ?>:</b>
    <?php echo CHtml::encode($data->owner); ?>
    <br/>


</div>