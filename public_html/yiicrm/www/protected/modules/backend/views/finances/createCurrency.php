<?php
/* @var $this FinancesController */
/* @var $model Currency */

$this->header='Добавление валюты';
?>


<?php $this->renderPartial('_currencyform', array('model' => $model)); ?>