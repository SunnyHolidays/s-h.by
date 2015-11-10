<?php
/* @var $this PlacesController */
/* @var $model Airports */

$this->breadcrumbs = array(
    'Airports' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Airports', 'url' => array('index')),
    array('label' => 'Create Airports', 'url' => array('create')),
    array('label' => 'Update Airports', 'url' => array('update', 'id' => $model->id)),
    array(
        'label' => 'Delete Airports',
        'url' => '#',
        'linkOptions' => array(
            'submit' => array('delete', 'id' => $model->id),
            'confirm' => 'Are you sure you want to delete this item?'
        )
    ),
    array('label' => 'Manage Airports', 'url' => array('admin')),
);
?>

<h1>View Airports #<?php echo $model->id; ?></h1>

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
