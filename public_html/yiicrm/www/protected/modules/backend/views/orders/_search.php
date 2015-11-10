<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCoreScript('cookie');
?>

<div class="wide form well">

    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'action' => Yii::app()->createUrl('backend/orders/GetGridOrders'),
            'method' => 'get',
            'id' => 'search_form'
        )
    );?>

    <div class="row-fluid">
        <div class="span3">
            <?php
            $data = CHtml::listData(
                Users::model()->findAll('role_id=:role_id', array(':role_id' => 1)),
                'id',
                'last_name'
            );
           ?>
            <?php echo $form->labelEx($model, 'user_id');?>
            <?php echo $form->dropDownList(
                $model,
                'user_id',
                array('' => 'Все записи','null' => 'Без менеджера') + $data,
                array(
                    'name' => 'Orders[user_id]',
                    'id' => 'user_id',
                    'submit' => 'true',
                    'class' => 'input-medium chzn-select',
                )
            );
            ?>
        </div>
        <div class="span4">
            <?php echo $form->labelEx($model, 'search'); ?>
            <?php echo CHtml::activeSearchField(
                $model,
                'orders_search',
                array(
                    'value' => empty($filters['orders_search']) ? '' : $filters['orders_search'],
                    'placeholder' => 'Поиск',
                    'submit' => 'true',
                    'class' => 'input-medium search-query',
                )
            )?>
        </div>
        <div class="span5">
            <div class="control-group">
                <?php echo $form->label($model, 'Период', array('class' => 'control-label')); ?>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on">
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
                        <span class="add-on">
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

</div><!-- search-form -->
<script>

    var filter = "<?php echo $filters["user_id"]?>";

    $('.chzn-select').select2().select2('val', filter);

    $(".juiDate").datepicker({
        dateFormat: 'dd.mm.yy'
    });
    $(".drop-filters").on('click',function(){
        $.cookie('filtersOrders',null);
        $(':input','#search_form').not(':button,:hidden').val('');
        $('.chzn-select').select2('val','');
    })
</script>