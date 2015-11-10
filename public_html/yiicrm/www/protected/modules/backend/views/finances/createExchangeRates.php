<?php
/* @var $this FinancesController */
/* @var $model ExchangeRates */

$this->header='Создание курса обмена' ;
?>

<?php $this->renderPartial('_exchangeRatesForm', array('model' => $model)); ?>