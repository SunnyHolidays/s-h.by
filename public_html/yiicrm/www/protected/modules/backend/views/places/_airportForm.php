<?php
/* @var $this PlacesController */
/* @var $model Airports */
/* @var $form CActiveForm */
/* @var $wrapper Wrapper */
Yii::app()->clientScript->corePackages = array();

?>
<?php
$wrapper = $this->beginWidget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'activeForm',
            'id' => 'airports-form',
            'validateFunction' => 'js:customRenderErrorMessage',
            'htmlOptions' => array(
                'data-grid-name' => 'airports-grid',
                'data-grid-route' => Yii::app()->createUrl('backend/places/getAirportsGrid')
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
<fieldset>
<div class="control-group">
    <?php echo $form->label($model, 'title', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->telField($model, 'title'); ?>
        <?php echo $form->error($model, 'title', array('hideErrorMessage' => true)); ?>
    </div>
</div>

<div class="control-group buttons">
    <div class="controls">
        <?php echo CHtml::submitButton(
            $model->isNewRecord ? 'Добавить' : 'Сохранить',
            array('class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success')
        ); ?>
        <button data-dismiss="modal" class="btn">Отмена</button>
    </div>
</div>
</fieldset>
<?php $this->endWidget(); ?>
