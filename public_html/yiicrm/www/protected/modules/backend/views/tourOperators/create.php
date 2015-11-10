<?php
/* @var $this TourOperatorsController */
/* @var $model TourOperators */

$this->breadcrumbs = array(
    'Tour Operators' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List TourOperators', 'url' => array('index')),
    array('label' => 'Manage TourOperators', 'url' => array('admin')),
);
?>

    <h1>Create TourOperators</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>