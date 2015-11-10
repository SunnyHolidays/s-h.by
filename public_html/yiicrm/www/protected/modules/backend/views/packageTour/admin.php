<?php
/* @var $this PackageTourController */
/* @var $model PackageTour */

$this->breadcrumbs=array(
	'Package Tours'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PackageTour', 'url'=>array('index')),
	array('label'=>'Create PackageTour', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#package-tour-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Package Tours</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-tour-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'number',
		'tour_operator_id',
		'date',
		'date_departure',
		'date_return',
		/*
		'country_id',
		'region_id',
		'hotel_id',
		'airport_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
