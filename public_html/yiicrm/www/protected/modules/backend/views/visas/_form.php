<?php
/* @var $this VisasController */
/* @var $model Visas */
/* @var $wrapper Wrapper */
/* @var $form CActiveForm */
/* @var $val Participants */
Yii::app()->clientScript->corePackages = array();
?>
<?php
$wrapper = $this->beginWidget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'activeForm',
            'id' => 'visas-form',
            'validateFunction' => 'js:customRenderErrorMessage'

        ),
        'header' => $this->header,
        'icon' => 'icon-th',
    )
);
$form = $wrapper->getWidget();
?>
<div class="control-group">
    <?php echo $form->labelEx($model, 'participant_id', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        $data = null;

        $participantIdOrder = Participants::model()->findAll('order_id=:order_id', array(':order_id' => $orderID));

        if ($this->action->id == 'create') {
            foreach ($participantIdOrder as $key => $val) {
                if (!empty($val->visas)) {
                    unset($participantIdOrder[$key]);
                }
            }
            $data = CHtml::listData($participantIdOrder, 'id', 'last_name');

        } else {
            $data = CHtml::listData(
                $participantIdOrder,
                'id',
                'last_name'
            );
        }

        echo $form->dropDownList(
            $model,
            'participant_id',
            $data,
            array(
                'class' => 'input-xlarge chzn-select',
                'id' => 'participantList',
            )
        ); ?>
        <?php echo $form->error($model, 'participant_id', array('hideErrorMessage' => true)); ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'type', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList(
            $model,
            'type',
            $model->getType(),
            array(
                'class' => 'input-xlarge chzn-select',
            )
        );
        ?>
        <?php echo $form->error($model, 'type', array('hideErrorMessage' => true)); ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'fee', array('class' => 'control-label')); ?>
    <div class="controls">
        <div class="input-prepend">
            <span class="add-on" style="width: 30px">$</span>
            <?php echo $form->textField($model, 'fee'); ?>
            <?php echo $form->error($model, 'fee', array('hideErrorMessage' => true)); ?>
        </div>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'amount', array('class' => 'control-label')); ?>
    <div class="controls">
        <div class="input-prepend">
            <span class="add-on" style="width: 30px">$</span>
            <?php echo $form->textField($model, 'amount'); ?>
            <?php echo $form->error($model, 'amount', array('hideErrorMessage' => true)); ?>
        </div>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList(
            $model,
            'status',
            Requests::model()->getStatus(),
            array(
                'class' => 'input-xlarge chzn-select',
            )
        );
        ?>
        <?php echo $form->error($model, 'status', array('hideErrorMessage' => true)); ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'date_next_step', array('class' => 'control-label')); ?>
    <div class="controls">
        <div class="input-prepend">
                    <span class="add-on" style="width: 30px">
                            <i class="icon-calendar"></i>
                        </span>
            <?php echo $form->textField(
                $model,
                'date_next_step',
                array(
                    'class' => 'juiDate',
                )
            );?>
            <?php echo $form->error($model, 'date_next_step', array('hideErrorMessage' => true)); ?>
        </div>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'description_next_step', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textArea($model, 'description_next_step', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description_next_step', array('hideErrorMessage' => true)); ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'comment', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textArea($model, 'comment', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'comment', array('hideErrorMessage' => true)); ?>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <?php echo CHtml::submitButton(
            $model->isNewRecord ? 'Добавить' : 'Сохранить',
            array('class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success')
        ); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
<script>
    function customRenderErrorMessage(form, data, hasError) {
        if (renderErrorMessage(form, data, hasError)) {
            $.ajax({
                type: 'post',
                url: "<?php echo !$model->isNewRecord ? Yii::app()->createUrl('backend/visas/update', array('id' => $model->id)) :
                                Yii::app()->createUrl('backend/visas/create')?>",
                data: $("#visas-form").serialize(),
                success: function (response) {
                    if (response == '1') {
                        $.fn.yiiGridView.update('visas-grid', {
                        });
                    }
                    $(".global-modal").modal('hide');
                }
            });
            return false;
        } else {
            return false;
        }
    }
    $(document).ready(function () {

        $(".juiDate").datepicker({
            dateFormat: 'dd.mm.yy'
        });
        $('.chzn-select').select2();
    });
</script>
