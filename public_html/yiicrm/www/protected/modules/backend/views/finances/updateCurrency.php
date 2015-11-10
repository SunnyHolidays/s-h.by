<?php
/* @var $this FinancesController */
/* @var $model Currency */

$this->header='Обновление валюты "' . $model->title . '"';
?>


<?php $this->renderPartial('_currencyform', array('model' => $model)); ?>