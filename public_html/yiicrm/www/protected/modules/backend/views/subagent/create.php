<?php
/* @var $this SubagentController */
/* @var $model Subagent */

$this->breadcrumbs=array(
	'Subagents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Subagent', 'url'=>array('index')),
	array('label'=>'Manage Subagent', 'url'=>array('admin')),
);
?>

<h1>Create Subagent</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>