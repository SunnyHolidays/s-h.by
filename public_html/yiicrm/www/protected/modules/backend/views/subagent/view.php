<?php
/* @var $this SubagentController */
/* @var $model Subagent */

$this->breadcrumbs=array(
	'Subagents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Subagent', 'url'=>array('index')),
	array('label'=>'Create Subagent', 'url'=>array('create')),
	array('label'=>'Update Subagent', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Subagent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subagent', 'url'=>array('admin')),
);
?>

<h1>View Subagent #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'address',
	),
)); ?>
