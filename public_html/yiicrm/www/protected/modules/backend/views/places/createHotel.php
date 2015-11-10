<?php
/* @var $this PlacesController */
/* @var $model Airports */

$this->header = 'Добавить отель';
?>
<?php $this->renderPartial('_hotelForm', array('model' => $model)); ?>