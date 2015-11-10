<?php
/* @var $this PaymentCustomersController */
/* @var $model PaymentCustomers */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'payment-customers-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        )
    ); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php echo $form->textField($model, 'date'); ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'amount_due'); ?>
        <?php echo $form->textField($model, 'amount_due'); ?>
        <?php echo $form->error($model, 'amount_due'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_payment'); ?>
        <?php echo $form->textField($model, 'date_payment'); ?>
        <?php echo $form->error($model, 'date_payment'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'amount_paid'); ?>
        <?php echo $form->textField($model, 'amount_paid'); ?>
        <?php echo $form->error($model, 'amount_paid'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'currency_id'); ?>
        <?php echo $form->textField($model, 'currency_id'); ?>
        <?php echo $form->error($model, 'currency_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'exchange_rate_id'); ?>
        <?php echo $form->textField($model, 'exchange_rate_id'); ?>
        <?php echo $form->error($model, 'exchange_rate_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'order_id'); ?>
        <?php echo $form->textField($model, 'order_id'); ?>
        <?php echo $form->error($model, 'order_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->