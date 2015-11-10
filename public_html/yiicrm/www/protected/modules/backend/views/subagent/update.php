<?php
/* @var $this SubagentController */
/* @var $model Subagent */

$this->breadcrumbs=array(
	'Subagents'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Subagent', 'url'=>array('index')),
	array('label'=>'Create Subagent', 'url'=>array('create')),
	array('label'=>'View Subagent', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Subagent', 'url'=>array('admin')),
);
?>

<h1>Update Subagent <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>