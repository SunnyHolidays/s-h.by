<?php
/* @var $this FinancesController */
/* @var $model ExchangeRates */

Yii::app()->clientScript->registerScript(
    'search',
    "
   $('.search-form form').submit(function(){

       $('#exchange-rates-grid').yiiGridView('update', {
           data: $(this).serialize() + '&view=rates'
       });
       return false;
   });
   "
);

?>
<div class="search-form">
    <?php $this->renderPartial(
    '_exchangeRatesSearch',
    array(
        'model' => $model,
        'currency' => CHtml::listData(Currency::model()->findAll(), 'id', 'title'),
    )
);
    ?>
</div>
<?php
$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'grid',
            'id' => 'exchange-rates-grid',
            'dataProvider' => $model->search(),
            'columns' => array(

                array(
                    'name' => 'id',
                    'value' => '$data->id',
                    'htmlOptions' => array('width' => '40px'),
                    'sortable' => true,
                ),
                'date',
                'firstCurrency.title',
                'secondCurrency.title',
                'rate',
                array(
                    'class' => 'ButtonColumn',
                    'buttons' => array(
                        'view' => array(
                            'icon' => 'icon-eye-open',
                            'visible' => 'false'
                        ),
                        'update' => array(
                            'icon' => 'icon-edit',
                            'url' => 'Yii::app()->createUrl("/backend/finances/updateExchangeRates", array("id"=> $data->id))',
                            'click' => 'function(){updateModalForm(this);return false;}'
                        ),
                        'delete' => array(
                            'icon' => 'icon-trash'
                        ),
                    ),
                ),
            )
        ),
        'header' => $this->header,
        'footer' => true,
        'icon' => 'icon-th',
        'footerElements' => CHtml::link('Добавить курс обмена', '', array(
            'class' => 'btn btn-primary',
            'id' => 'create-rate',
            'data-toggle' => 'modal',
            'style' => 'float: right; color:#fff;width:155px',
            'enable' => 'true',
            'data-get-form' => Yii::app()->createUrl('backend/finances/createExchangeRates'),
            'onclick' => 'js:getModalForm(this)'
        ))
    )
); ?>