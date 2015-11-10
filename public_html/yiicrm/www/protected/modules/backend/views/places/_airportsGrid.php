<?php
/* @var $model Airports*/
/* @var $this PlacesController*/
?>
<?php $this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'grid',
            'id' => 'airports-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                'id',
                'title',
                array(
                    'class' => 'ButtonColumn',
                    'buttons' => array(
                        'view' => array(
                            'icon' => 'icon-eye-open',
                            'visible' => 'false'
                        ),
                        'update' => array(
                            'icon' => 'icon-edit',
                            'click' => 'function(){updateModalForm(this);return false;}',
                            'url'=>'Yii::app()->createUrl("backend/places/updateAirport", array("id"=>$data->id))'

                        ),
                        'delete' => array(
                            'icon' => 'icon-trash',
                            'url'=>'Yii::app()->createUrl("backend/places/deleteAirport", array("id"=>$data->id))',
                            'click' => 'function(){smartDelete(this, "аэропорт", "airports-grid");return false;}'
                        ),
                    ),
                ),
            ),
        ),
        'header' => 'Аэропорты',
        'footer' => true,
        'icon' => 'icon-th',
        'footerElements' => CHtml::link('Добавить аэропорт', '', array(
            'class' => 'btn btn-primary',
            'id' => 'create-airport',
            'data-toggle' => 'modal',
            'style' => 'float: right; color:#fff;width:155px',
            'enable' => 'true',
            'data-get-form' => Yii::app()->createUrl('backend/places/createAirport'),
            'onclick' => 'js:getModalForm(this)'
        ))

    )
); ?>