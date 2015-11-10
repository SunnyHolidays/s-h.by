<?php
/* @var $this FinancesController */
/* @var $model Currency */
Yii::app()->clientScript->registerCoreScript('yiiactiveform');
?>

<?php $this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'grid',
            'id' => 'currency-grid',
            'dataProvider' => Currency::model()->search(),
            'columns' => array(
                'id',
                'title',
                'symbol',
                array(
                    'class' => 'ButtonColumn',
                    'template' => '{update}{delete}',
                    'buttons' => array(
                        'update' => array(
                            'icon' => 'icon-edit',
                            'url' => 'Yii::app()->createUrl("/backend/finances/updateCurrency", array("id"=> $data->id))',
                            'click' => 'function(){updateModalForm(this);return false;}'
                        ),
                        'delete' => array(
                            'url' => 'Yii::app()->createUrl("/backend/finances/deleteCurrency", array("id"=> $data->id))',
                            'icon' => 'icon-trash'
                        ),
                    ),
                ),
            )
        ),
        'header' => 'Валюта',
        'footer' => true,
        'icon' => 'icon-th',
        'footerElements' => CHtml::link('Добавить валюту', '', array(
                'class' => 'btn btn-primary get-modal-form',
                'id' => 'create-currency',
                'data-toggle' => 'modal',
                'style' => 'float: right; color:#fff;width:155px',
                'enable' => 'true',
                'data-get-form' => Yii::app()->createUrl('backend/finances/createCurrency'),
                'onclick' => 'js:getModalForm(this)'
            ))
    )
); ?>
