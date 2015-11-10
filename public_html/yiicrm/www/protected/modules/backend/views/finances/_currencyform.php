<?php
/* @var $model Currency */
/* @var $form CActiveForm */
/* @var $wrapper Wrapper */
/* @var $this FinancesController */
/* @var $header string */


Yii::app()->clientScript->corePackages = array();
?>

<?php
$wrapper = $this->beginWidget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'activeForm',
            'id' => 'currency-form',
            'validateFunction' => 'js:customRenderErrorMessage',
            'htmlOptions' => array(
                'data-grid-name' => 'currency-grid',
                'data-grid-route' => Yii::app()->createUrl('backend/finances/getGrid', array('view'=>'currency'))
            )
        ),
        'header' => $this->header,
        'icon' => 'icon-th',
        'headerElements' => array(
            'close'=>true
        ),
    )
);
$form = $wrapper->getWidget();
?>

<div class="control-group">
    <?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title', array('hideErrorMessage' => true)); ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model, 'symbol', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model, 'symbol'); ?>
        <?php echo $form->error($model, 'symbol', array('hideErrorMessage' => true)); ?>
    </div>
</div>

<div class="control-group buttons">
    <div class="controls">
        <?php echo CHtml::submitButton(
            $model->isNewRecord ? 'Добавить' : 'Сохранить',
            array(
                'class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success'
            )
        ); ?>
        <button data-dismiss="modal" class="btn">Отмена</button>
    </div>
</div>
<?php $this->endWidget(); ?>