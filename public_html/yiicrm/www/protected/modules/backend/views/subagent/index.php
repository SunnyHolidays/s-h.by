<?php
/* @var $this SubagentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Subagents',
);

$this->menu=array(
	array('label'=>'Create Subagent', 'url'=>array('create')),
	array('label'=>'Manage Subagent', 'url'=>array('admin')),
);
?>

<h1>Subagents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
