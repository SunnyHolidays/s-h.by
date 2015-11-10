<?php
/* @var $this PackageTourController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Package Tours',
);

$this->menu=array(
	array('label'=>'Create PackageTour', 'url'=>array('create')),
	array('label'=>'Manage PackageTour', 'url'=>array('admin')),
);
?>

<h1>Package Tours</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
