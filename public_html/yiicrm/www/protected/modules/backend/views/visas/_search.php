<?php
/* @var $this VisasController */
/* @var $model Visas */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'action' => Yii::app()->createUrl($this->route),
            'method' => 'get',
        )
    ); ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'participant_id'); ?>
        <?php echo $form->textField($model, 'participant_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'type'); ?>
        <?php echo $form->textField($model, 'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'fee'); ?>
        <?php echo $form->textField($model, 'fee'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'amount'); ?>
        <?php echo $form->textField($model, 'amount'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php echo $form->textField($model, 'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'date_next_step'); ?>
        <?php echo $form->textField($model, 'date_next_step'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'description_next_step'); ?>
        <?php echo $form->textArea($model, 'description_next_step', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'comment'); ?>
        <?php echo $form->textArea($model, 'comment', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->