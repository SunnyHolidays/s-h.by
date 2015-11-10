<?php

$inWeek = date('Y-m-d', strtotime('+7 days'));

$criteria = new CDbCriteria();
$criteria->with = array('packageTour');
$criteria->addCondition('package_tour_id is not null');
$criteria->addBetweenCondition('packageTour.date_departure', date('Y-m-d'), $inWeek, 'AND');
$optionsButtons = <<<EOD
<span class="icon" style="float:right">
    <a href=""  class="widget-delete close"><i class="icon-remove" widget-id="$this->id"></i></a>
</span>
EOD;
$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'grid',
            'id' => 'orders-grid',
            'dataProvider' =>  new CActiveDataProvider('Orders', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => 3,
                    'route' => 'dashboard/UpdateGrid',
                    'params' => array('gridName' => '_ordersGrid')
                )
            )),
            'ajaxUrl' => array('backend/dashboard/updateGrid', array('viewName' => '_ordersGrid')),
            'columns' => array(
                'packageTour.country.title',
                array(
                    'name' => 'clients',
                    'value' => '$data->request->first_name." ".$data->request->last_name." ".$data->request->phone',
                    'header' => 'Клиент',
                ),
               array(
                   'header' => 'Дата вылета',
                   'value' => '$data->packageTour->date_departure',
               )
            )
        ),
        'headerElements' => array(
            'optionsButtons' => $optionsButtons
        ),
        'header' => 'Заказы',
        'footer' => false,
        'icon' => 'icon-th',
    )
);

Yii::app()->clientScript->registerScript('orders-grid',
    " $(document).on('widgetAdded',function(){
        jQuery('#orders-grid').yiiGridView({
            'ajaxUpdate':['orders-grid'],
            'ajaxVar':'ajax',
            'pagerClass':'pager',
            'loadingClass':'grid-view-loading',
            'filterClass':'filters',
            'tableClass':'items',
            'selectableRows':1,
            'enableHistory':false,
            'updateSelector':'{page}, {sort}',
            'filterSelector':'{filter}',
            'pageVar':'Orders_page'});
    });"
)
?>
