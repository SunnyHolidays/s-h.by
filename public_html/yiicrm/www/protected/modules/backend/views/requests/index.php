<?php
/* @var $this RequestsController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Requests */
/* @var $filters array */

$this->breadcrumbs = array(
    'Заявки',
);
$this->header = 'Заявки';
$this->setPageTitle("Список заявок");
$this->headerMenu = array(
    array(
        'label' => 'Создать заявку',
        'url' => array('create'),
        'icon' => 'icon-plus'
    )
,
);
Yii::app()->clientScript->registerScript(
    'search',
    "
       $('.search-form form').submit(function(){
           if($('#Requests_requests_search').attr('value').length == 0 || $('#Requests_requests_search').attr('value').length >= 3)
           $('#requests-grid').yiiGridView('update', {
               data: $(this).serialize(),

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
    <!-- search-form -->
</div>
<?php $this->actionGetGrid(); ?>

