<?php
/* @var $this PlacesController */
/* @var $model Airports */

$this->header = 'Обновить информацию об аэропорте';

$this->renderPartial('_airportForm', array('model' => $model)); ?>
