<?php
/* @var $this OrdersController */
/* @var $model Participants */
/* @var $form CActiveForm */
/* @var $wrapper Wrapper */
/* @var $orderId integer */
/* @var $title string */
Yii::app()->clientScript->corePackages = array();
?>
<?php
$wrapper = $this->beginWidget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'activeForm',
            'id' => 'participants-form',
            'validateFunction' => 'js:customRenderErrorMessage',
            'htmlOptions' => array(
                'data-grid-name' => 'participants-view',
                'data-grid-route' => Yii::app()->createUrl('/backend/orders/getgrid', array('order_id' => !$model->order_id ? null : $model->order_id))
            )
        ),
        'header' => 'Добавление участника',
        'icon' => 'icon-th',
        'headerElements' => array(
            'close'=>true
        ),
    )
);
$form = $wrapper->getWidget();
?>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'first_name', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'first_name'); ?>
                    <?php echo $form->error($model, 'first_name', array('hideErrorMessage' => true)); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'last_name', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'last_name'); ?>
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
                    <?php echo $form->textField($model, 'passport_number'); ?>
                    <?php echo $form->error($model, 'passport_number', array('hideErrorMessage' => true)); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'date_of_issue', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'date_of_issue', array('class' => 'date_of_issue')); ?>
                    <?php echo $form->error($model, 'date_of_issue', array('hideErrorMessage' => true)); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'date_of_expiry', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'date_of_expiry', array('class' => 'date_of_expiry')); ?>
                    <?php echo $form->error($model, 'date_of_expiry', array('hideErrorMessage' => true)); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'nationality', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'nationality'); ?>
                    <?php echo $form->error($model, 'nationality', array('hideErrorMessage' => true)); ?>
                </div>
            </div>

            <?php echo $form->hiddenField($model, 'order_id', array('value' => $model->order_id)) ?>
            <div class="control-group">
                <div class="controls">
                    <?php echo CHtml::submitButton(
                        $model->isNewRecord ? 'Добавить' : 'Сохранить',
                        array('class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success')
                    ); ?>
                    <button data-dismiss="modal" class="btn">Отмена</button>
                </div>
            </div>



        <?php $this->endWidget(); ?>

<script>
    $(document).ready(function () {
        $('.birthday, .date_of_issue, .date_of_expiry').datepicker({
            dateFormat: 'dd.mm.yy',
            changeMonth: true,
            changeYear: true,
            yearRange: '1900:' + new Date().getFullYear()
        });
    })
</script>