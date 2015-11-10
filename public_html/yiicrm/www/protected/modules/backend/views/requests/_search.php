<?php
/* @var $this RequestsController */
/* @var $model Requests */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCoreScript('cookie');
?>

<div class="wide form well">

    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'action' => Yii::app()->createUrl('backend/requests/GetGrid'),
            'method' => 'get',
            'id' => 'search_form'
        )
    );?>

    <div class="row-fluid">
        <div class="span2">
            <?php
            $data = CHtml::listData(
                Users::model()->findAll('role_id=:role_id', array(':role_id' => 1)),
                'id',
                'last_name'
            );
            ?>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'user_id');?>
                <div class="controls">
                    <?php echo $form->dropDownList(
                        $model,
                        'user_id',
                        array('' => 'Все записи','null'=>'Без менеджера') + $data,
                        array(
                            'name' => 'Requests[user_id]',
                            'id' => 'user_id',
                            'submit' => 'true',
                            'class' => 'input-medium chzn-select',
                            'style' => 'width:81%'
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
        <div class="span2">
            <?php $data = CHtml::listData(Requests::model()->findAll(), 'status', 'status');?>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'status'); ?>
                <div class="controls">
                    <?php echo $form->dropDownList(
                        $model,
                        'status',
                        array('' => 'Все записи') + $model->getStatus(),
                        array(
                            'id' => 'status',
                            'submit' => 'true',
                            'class' => 'input-medium chzn-select',
                            'style' => 'width:81%'
                        )
                    ); ?>
                </div>
            </div>
        </div>
        <div class="span2">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'search'); ?>
                <div class="controls">
                    <?php echo CHtml::activeSearchField(
                        $model,
                        'requests_search',
                        array(
                            'value' => empty($filters['requests_search']) ? '' : $filters['requests_search'],
                            'placeholder' => 'Поиск',
                            'submit' => 'true',
                            'class' => 'input-medium search-query',
                            'style' => 'width:81%'
                        )
                    )?>
                </div>
            </div>
        </div>
        <div class="span6">
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
                                'submit' => true,
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
</div>

<script type="text/javascript">

    var filters = {'#user_id':"<?php echo $filters["user_id"]?>",'#status':"<?php echo $filters["status"]?>"};

    $.each(filters, function (key, value) {
        $(key).select2().select2('val', value);
    })

    $(".juiDate").datepicker({
        dateFormat: 'dd.mm.yy'
    });
    $(document).ready(function(){
        $(".drop-filters").on('click',function(){
            $.cookie('filters',null);
            $(':input','#search_form').not(':button,:hidden').val('');
            $('.chzn-select').select2('val','');
        })
    })
</script>