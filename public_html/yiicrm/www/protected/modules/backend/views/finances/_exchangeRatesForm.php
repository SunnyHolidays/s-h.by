<?php
/* @var $this FinancesController */
/* @var $model ExchangeRates */
/* @var $form CActiveForm */
/* @var $wrapper Wrapper */
/* @var $title string */
 Yii::app()->clientScript->corePackages = array();

?>
<?php $currency = CHtml::listData(Currency::model()->findAll(), 'id', 'title') ?>
<?php
$wrapper = $this->beginWidget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'activeForm',
            'id' => 'exchange-rates-form',
            'validateFunction' => 'js:customRenderErrorMessage',
            'htmlOptions' => array(
                'data-grid-name' => 'exchange-rates-grid',
                'data-grid-route' => Yii::app()->createUrl('backend/finances/getGrid', array('view'=>'rates'))
            )
        ),
        'header' => $this->header,
        'icon' => 'icon-th',
        'headerElements' => array(
            'close'=>true
        ),
    )
);
$form = $wrapper->getWidget();
?>
<fieldset>

    <div class="control-group">
        <?php echo $form->label($model, 'date', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->telField($model, 'date', array('class' => 'date')); ?>
            <?php echo $form->error($model, 'date', array('hideErrorMessage' => true)); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model, 'first_currency_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList(
                $model,
                'first_currency_id',
                $currency
            ); ?>
            <?php echo $form->error($model, 'first_currency_id', array('hideErrorMessage' => true)); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model, 'second_currency_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList(
                $model,
                'second_currency_id',
                $currency
            ); ?>
            <?php echo $form->error($model, 'second_currency_id', array('hideErrorMessage' => true)); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model, 'rate', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->telField($model, 'rate'); ?>
            <?php echo $form->error($model, 'rate', array('hideErrorMessage' => true)); ?>
        </div>
    </div>

    <div class="control-group buttons">
        <div class="controls">
            <?php echo CHtml::submitButton(
                $model->isNewRecord ? 'Добавить' : 'Сохранить',
                array('class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success')
            ); ?>
            <button data-dismiss="modal" class="btn">Отмена</button>
        </div>
    </div>
</fieldset>
<?php $this->endWidget(); ?>

<script>
    $(document).ready(function () {
            $('.date').datepicker({dateFormat: 'dd.mm.yy'});
        }
    );
</script>