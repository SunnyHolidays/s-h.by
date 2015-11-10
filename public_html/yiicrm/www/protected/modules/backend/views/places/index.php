<?php
/* @var $this HotelsController */
/* @var $airportsModel Airports */
/* @var $hotelsModel Hotels */



$this->breadcrumbs = array(
    'Места' => array('index'),
);
Yii::app()->clientScript->registerCoreScript('yiiactiveform');
$this->header = 'Места';

$this->pageTitle = 'Места';

Yii::app()->clientScript->registerScript(
    'search',
    "
   $('#hotels-search-form').submit(function(){
       $('#hotels-grid').yiiGridView('update', {
           data: $(this).serialize(),
       });
       return false;
   });
   $('#airports-search-form').submit(function(){
       $('#airports-grid').yiiGridView('update', {
           data: $(this).serialize(),
       });
       return false;
   });
   "
);
?>
<div class="search-form">
    <?php $this->renderPartial('_hotelSearch', array('model' => $hotelsModel))?>
</div>
    <?php $this->renderPartial('_hotelsGrid', array('model'=>$hotelsModel))?>
<div class="search-form">
    <?php $this->renderPartial('_airportSearch', array('model' => $airportsModel))?>
</div>
    <?php $this->renderPartial('_airportsGrid', array('model'=>$airportsModel))?>

