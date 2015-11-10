<?php
/* @var $this PlacesController */
/* @var $model Airports */

$this->header = 'Добавить аэропорт';
?>
<?php $this->renderPartial('_airportForm', array('model' => $model)); ?>