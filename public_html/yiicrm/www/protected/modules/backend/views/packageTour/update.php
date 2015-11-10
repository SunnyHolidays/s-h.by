<?php
/* @var $this PackageTourController */
/* @var $model PackageTour */

$this->breadcrumbs=array(
	'Package Tours'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PackageTour', 'url'=>array('index')),
	array('label'=>'Create PackageTour', 'url'=>array('create')),
	array('label'=>'View PackageTour', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PackageTour', 'url'=>array('admin')),
);
?>

<h1>Update PackageTour <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>