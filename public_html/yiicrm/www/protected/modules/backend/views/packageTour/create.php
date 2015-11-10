<?php
/* @var $this PackageTourController */
/* @var $model PackageTour */

$this->breadcrumbs=array(
	'Package Tours'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PackageTour', 'url'=>array('index')),
	array('label'=>'Manage PackageTour', 'url'=>array('admin')),
);
?>

<h1>Create PackageTour</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>