<?php
/* @var $this FinancesController */
/* @var $model ExchangeRates */

$this->header='Обновление курса обмена '.$model->firstCurrency->title.' - '.$model->secondCurrency->title ;
?>


<?php $this->renderPartial('_exchangeRatesForm', array('model' => $model)); ?>