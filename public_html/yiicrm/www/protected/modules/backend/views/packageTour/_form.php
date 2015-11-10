<?php
/* @var $this PackageTourController */
/* @var $model PackageTour */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'package-tour-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'number'); ?>
		<?php echo $form->textField($model,'number'); ?>
		<?php echo $form->error($model,'number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tour_operator_id'); ?>
		<?php echo $form->textField($model,'tour_operator_id'); ?>
		<?php echo $form->error($model,'tour_operator_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_departure'); ?>
		<?php echo $form->textField($model,'date_departure'); ?>
		<?php echo $form->error($model,'date_departure'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_return'); ?>
		<?php echo $form->textField($model,'date_return'); ?>
		<?php echo $form->error($model,'date_return'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country_id'); ?>
		<?php echo $form->textField($model,'country_id'); ?>
		<?php echo $form->error($model,'country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region_id'); ?>
		<?php echo $form->textField($model,'region_id'); ?>
		<?php echo $form->error($model,'region_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hotel_id'); ?>
		<?php echo $form->textField($model,'hotel_id'); ?>
		<?php echo $form->error($model,'hotel_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'airport_id'); ?>
		<?php echo $form->textField($model,'airport_id'); ?>
		<?php echo $form->error($model,'airport_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->