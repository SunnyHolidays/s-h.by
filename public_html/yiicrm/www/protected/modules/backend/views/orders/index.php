<?php
/* @var $this OrdersController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Orders */
/* @var $filters array */

$this->breadcrumbs = array(
    'Заказы',
);
$this->header = 'Заказы';
$this->setPageTitle("Список заказов");
$this->headerMenu = array(
    array(
        'label' => 'Создать заказ',
        'url' => array('create'),
        'icon' => 'icon-plus'
    )
,
);

Yii::app()->clientScript->registerScript(
    'search',
    "
       $('.search-form form').submit(function(){
           if($('#Orders_orders_search').attr('value').length == 0 || $('#Orders_orders_search').attr('value').length >= 3)
           $('#orders-grid').yiiGridView('update', {
               data: $(this).serialize()
           });
           return false;
       });
       "
);
?>

<div class="span12">
    <div class="search-form">
        <?php $this->renderPartial(
            '_search',
            array(
                'model' => $model,
                'filters' => $filters,
            )
        );
        ?>
    </div>
</div>

<?php $this->actionGetGridOrders(); ?>
