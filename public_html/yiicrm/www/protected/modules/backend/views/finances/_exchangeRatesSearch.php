<?php
/* @var $this FinancesController */
/* @var $model ExchangeRates */
/* @var $form CActiveForm */
?>
<?php $currency = CHtml::listData(Currency::model()->findAll(), 'id', 'title') ?>


<div class="wide form well">

    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'action' => Yii::app()->createUrl('backend/finances/getgrid'),
            'method' => 'get',
            'id' => 'search-form',
        )


    ); ?>
    <div class="row-fluid">
        <div class="span3">
            <div class="control-group">
                <?php echo $form->label($model, 'first_currency_id'); ?>
                <div class="controls">
                    <?php echo $form->dropDownList(
                        $model,
                        'first_currency_id',
                        array(''=>'Любая') + $currency,
                        array(
                            'submit' => true,
                            'class' => 'input-medium chzn-select',
                            'id' => 'first_currency_id'
                        )
                    ); ?>
                </div>
            </div>
        </div>
        <div class="span2">
            <div class="control-group">
                <?php echo $form->label($model, 'second_currency_id'); ?>
                <div class="controls">
                    <?php echo $form->dropDownList(
                        $model,
                        'second_currency_id',
                        array(''=>'Любая') + $currency,
                        array(
                            'submit' => true,
                            'class' => 'input-medium chzn-select',
                            'id' => 'second_currency_id'
                        )
                    ); ?>
                </div>
            </div>
        </div>
        <div class="span6 offset1">
            <div class="control-group">
                <?php echo $form->label($model, 'Период', array('class' => 'control-label')); ?>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on" style="width: 30px">
                            <i class="icon-calendar"></i>
                        </span>
                        <?php echo $form->textField(
                            $model,
                            'date_first',
                            array(
                                'placeholder' => $model->getAttributeLabel('date_first'),
                                'class' => 'juiDate',
                                'submit' => true
                            )
                        ); ?>
                    </div>
                    <div class="input-prepend">
                        <span class="add-on" style="width: 30px">
                            <i class="icon-calendar"></i>
                        </span>
                        <?php echo $form->textField(
                            $model,
                            'date_last',
                            array(
                                'placeholder' => $model->getAttributeLabel('date_last'),
                                'class' => 'juiDate',
                                'submit' => true
                            )
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
</div>
    <div class="row-fluid">
        <div style="margin-top: 18px">
            <div class="control-group">
                <div class="controls">
                    <?php echo CHtml::button(
                        'Очистить фильтры',
                        array(
                            'submit' => true,
                            'class' => 'btn btn-primary drop-filters',
                        )
                    )?>
                </div>
            </div>
        </div>
</div>
    <?php $this->endWidget(); ?>
    </div>
</div>
<script>

    $('.chzn-select').select2().select2('val','');

    $(".juiDate").datepicker({
        dateFormat: 'dd.mm.yy'
    });
    $(document).ready(function () {
        $(".drop-filters").on('click', function () {
            $(':input', '#search-form').not(':button,:hidden').val('');
            $('.chzn-select').select2('val','');
        })
    })
</script>