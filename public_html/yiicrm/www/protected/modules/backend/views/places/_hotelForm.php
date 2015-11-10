<?php
/* @var $this HotelsController */
/* @var $model Hotels */
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
            'id' => 'hotels-form',
            'validateFunction' => 'js:customRenderErrorMessage',
            'htmlOptions' => array(
                'data-grid-name' => 'hotels-grid',
                'data-grid-route' => Yii::app()->createUrl('backend/places/getHotelsGrid')
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
        <?php echo $form->label($model, 'title', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->telField($model, 'title'); ?>
            <?php echo $form->error($model, 'title', array('hideErrorMessage' => true)); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model, 'region_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList(
                $model,
                'region_id',
                CHtml::listData(Regions::model()->findAll(), 'id', 'title'),
                array('empty' => 'выберите регион')
            ); ?>
            <?php echo $form->error($model, 'region_id', array('hideErrorMessage' => true)); ?>
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
<?php $this->endWidget(); ?>