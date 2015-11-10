<?php
/* @var $this PlacesController */
/* @var $model Airports */
/* @var $form CActiveForm */
?>
<div class="wide form well">
    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'action' => Yii::app()->createUrl('backend/places/getAirportsGrid'),
            'method' => 'get',
            'id' => 'airports-search-form',
        )
    ); ?>
    <div class="row-fluid">
            <div class="control-group">
                <?php echo $form->label($model, 'title', array('class' => 'control-label')); ?>
                <div class="controls">
                        <?php echo $form->textField(
                            $model,
                            'title',
                            array(
                                'placeholder' => 'Название',
                                'submit' => true,
                                'id' => 'airport-title'
                            )
                        ); ?>
                </div>
            </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
