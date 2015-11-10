<?php
/* @var $this ParticipantsController */
/* @var $model Participants */
/* @var $form CActiveForm */
/* @var $orderId integer */
?>
<div class="widget-box">
    <div class="widget-content nopadding">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-align-justify"></i>
            </span>
            <h5><?php echo $this->header ?></h5>
        </div>
        <?php $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'participants-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'class' => 'form form-horizontal'
                ),
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnType' => true,
                    'afterValidate' => 'js:renderErrorMessage',
                    'afterValidateAttribute' => 'js:renderAttributeErrorMessage'
                )
            )
        ); ?>
        <fieldset>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'first_name', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'first_name', array('size' => 60, 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'first_name', array('hideErrorMessage' => true)); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'last_name', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'last_name', array('size' => 60, 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'last_name', array('hideErrorMessage' => true)); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'birthday', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'birthday', array('class' => 'birthday')); ?>
                    <?php echo $form->error($model, 'birthday', array('hideErrorMessage' => true)); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'passport_number', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'passport_number', array('size' => 60, 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'passport_number', array('hideErrorMessage' => true)); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'phone', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'phone'); ?>
                    <?php echo $form->error($model, 'phone', array('hideErrorMessage' => true)); ?>
                </div>
            </div>
            <?php echo $form->hiddenField($model, 'order_id', array('value' => $model->order_id)) ?>
            <div class="control-group">
                <div class="controls">
                    <?php
                    /* @var $model Participants */
                    echo CHtml::link(
                        $model->isNewRecord ? 'Добавить' : 'Сохранить',
                        "",
                        array(
                            'icon' => 'icon-user',
                            'class' => 'btn btn-success create-participant',
                            'data-toggle' => 'modal',
                            'data-url' => !$model->isNewRecord ? Yii::app()->createUrl(
                                'backend/participants/update',
                                array('id' => $model->id)
                            ) :
                                Yii::app()->createUrl('backend/participants/create'),
                        )
                    );
                    ?>
                </div>
            </div>


        </fieldset>
        <?php $this->endWidget(); ?>
        <!-- form -->
    </div>
</div>
<script>

    $('.birthday').datepicker({
        dateFormat: 'dd.mm.yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:' + new Date().getFullYear()
    });
</script>