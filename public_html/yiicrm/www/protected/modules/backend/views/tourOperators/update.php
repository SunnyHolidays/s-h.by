<?php
/* @var $this TourOperatorsController */
/* @var $model TourOperators */

$this->breadcrumbs = array(
    'Tour Operators' => array('index'),
    $model->title => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List TourOperators', 'url' => array('index')),
    array('label' => 'Create TourOperators', 'url' => array('create')),
    array('label' => 'View TourOperators', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage TourOperators', 'url' => array('admin')),
);
?>

    <h1>Update TourOperators <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>