<?php
/* @var $this PackageTourController */
/* @var $model PackageTour */

$this->breadcrumbs=array(
	'Package Tours'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PackageTour', 'url'=>array('index')),
	array('label'=>'Create PackageTour', 'url'=>array('create')),
	array('label'=>'Update PackageTour', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PackageTour', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PackageTour', 'url'=>array('admin')),
);
?>

<h1>View PackageTour #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'number',
		'tour_operator_id',
		'date',
		'date_departure',
		'date_return',
		'country_id',
		'region_id',
		'hotel_id',
		'airport_id',
	),
)); ?>
