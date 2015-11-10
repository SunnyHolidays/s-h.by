<?php
/* @var $this PaymentCustomersController */
/* @var $model PaymentCustomers */
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
        <?php echo $form->label($model, 'date'); ?>
        <?php echo $form->textField($model, 'date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'amount_due'); ?>
        <?php echo $form->textField($model, 'amount_due'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'date_payment'); ?>
        <?php echo $form->textField($model, 'date_payment'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'amount_paid'); ?>
        <?php echo $form->textField($model, 'amount_paid'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'currency_id'); ?>
        <?php echo $form->textField($model, 'currency_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'exchange_rate_id'); ?>
        <?php echo $form->textField($model, 'exchange_rate_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'order_id'); ?>
        <?php echo $form->textField($model, 'order_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->