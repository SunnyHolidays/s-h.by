<?php
$inWeek = date('Y-m-d', strtotime('+7 days'));

$criteria = new CDbCriteria();
$criteria->with = array('request','packageTour');
$criteria->addCondition('request_id is not null');
$criteria->addBetweenCondition('request.date_next_step', date('Y-m-d'), $inWeek, 'AND');
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
            'id' => 'requests-grid',
            'dataProvider' => new CActiveDataProvider('Orders', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => 3,
                    'route' => 'dashboard/UpdateGrid',
                    'params' => array('gridName' => '_requestsGrid')
                )
            )),
            'columns' => array(
                array(
                    'name' => 'clients',
                    'value' => '$data->request->first_name." ".$data->request->last_name." ".$data->request->phone',
                    'header' => 'Клиенты',
                ),
                'packageTour.country.title',
                'request.date_next_step',
                'request.description_next_step',
            )
        ),
        'headerElements' => array(
            'optionsButtons' => $optionsButtons
        ),
        'header' => 'Заявки',
        'footer' => false,
        'icon' => 'icon-th',
    )
);
Yii::app()->clientScript->registerScript('requests-grid',
    " $(document).on('widgetAdded',function(){
        jQuery('#requests-grid').yiiGridView({
        'ajaxUpdate':['requests-grid'],
        'ajaxVar':'ajax',
        'pagerClass':'pager',
        'loadingClass':'grid-view-loading',
        'filterClass':'filters',
        'tableClass':'items',
        'selectableRows':1,
        'enableHistory':false,
        'updateSelector':'{page}, {sort}',
        'filterSelector':'{filter}',
        'pageVar':'Orders_page'
        });
    });"
)
?>

