<?php
/* @var $this PackageTourController */
/* @var $model PackageTour */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number'); ?>
		<?php echo $form->textField($model,'number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tour_operator_id'); ?>
		<?php echo $form->textField($model,'tour_operator_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_departure'); ?>
		<?php echo $form->textField($model,'date_departure'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_return'); ?>
		<?php echo $form->textField($model,'date_return'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country_id'); ?>
		<?php echo $form->textField($model,'country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'region_id'); ?>
		<?php echo $form->textField($model,'region_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hotel_id'); ?>
		<?php echo $form->textField($model,'hotel_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'airport_id'); ?>
		<?php echo $form->textField($model,'airport_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->