<?php
/* @var $this TourOperatorsController */
/* @var $model TourOperators */

$this->breadcrumbs = array(
    'Tour Operators' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List TourOperators', 'url' => array('index')),
    array('label' => 'Create TourOperators', 'url' => array('create')),
    array('label' => 'Update TourOperators', 'url' => array('update', 'id' => $model->id)),
    array(
        'label' => 'Delete TourOperators',
        'url' => '#',
        'linkOptions' => array(
            'submit' => array('delete', 'id' => $model->id),
            'confirm' => 'Are you sure you want to delete this item?'
        )
    ),
    array('label' => 'Manage TourOperators', 'url' => array('admin')),
);
?>

<h1>View TourOperators #<?php echo $model->id; ?></h1>

<?php $this->widget(
    'zii.widgets.CDetailView',
    array(
        'data' => $model,
        'attributes' => array(
            'id',
            'title',
        ),
    )
); ?>
