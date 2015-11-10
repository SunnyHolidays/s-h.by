<?php
/* @var $this PlacesController */
/* @var $model Hotels */
/* @var $form CActiveForm */
?>
<div class="wide form well">
    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'action' => Yii::app()->createUrl('backend/places/getHotelsGrid'),
            'method' => 'get',
            'id' => 'hotels-search-form',
        )
    ); ?>
    <div class="row-fluid">
        <div class="span2">
            <?php echo $form->label($model, 'title', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField(
                    $model,
                    'title',
                    array(
                        'placeholder' => 'Название',
                        'submit' => true,
                        'id' => 'hotel-title'
                    )
                ); ?>
            </div>
        </div>
        <div class="span2">
            <?php echo $form->label($model, 'region_id', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->dropDownList(
                    $model,
                    'region_id',
                    array(''=> 'Любой') + CHtml::listData(Regions::model()->findAll(),'id', 'title'),
                    array(
                        'placeholder' => 'Название',
                        'submit' => true,
                        'id' => 'region-id',
                        'class' => 'input-medium chzn-select'
                    )
                ); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<script>
    $('.chzn-select').select2().select2('val','');
</script>