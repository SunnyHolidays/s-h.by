<?php
/* @var OrdersController $this */
/* @var Orders $model */
/* @var CActiveForm $form */
/* @var Wrapper $wrapper */
/* @var integer $order_id */
/* @var CDbCriteria $criteria */
/* @var CClientScript $cs */
?>

<?php
$wrapper = $this->beginWidget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'activeForm',
            'id' => 'orders-form',
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ),
        'header' => $this->header,
        'icon' => 'icon-th',
    )
);
$form = $wrapper->getWidget();
?>


<div class="row-fluid multicolumn">
    <fieldset class="well fieldset">
        <div class="row-fluid">
            <div class="span3">
                <div class="control-group">
                    <?php echo $form->labelEx($model->packageTour, 'date', array('class' => 'control-label')) ?>
                    <div class="controls">
                        <div class="input-prepend">
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>
                            <?php
                            echo $form->telField(
                                $model->packageTour,
                                'date',
                                array('class' => 'juiDate', 'placeholder' => 'Дата')
                            );
                            echo $form->error($model->packageTour, "date", array('hideErrorMessage' => true));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span3">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'tour_type_id', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        echo $form->dropDownList(
                            $model,
                            'tour_type_id',
                            $model->tour_type,
                            array(
                                'class' => 'chzn-select',
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <div class="span3">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'user_id', array('class' => 'control-label')) ?>

                    <div class="controls">
                        <?php
                        $records = Users::model()->findAll('role_id=:role_id', array(':role_id' => 1));
                        $users = array();
                        $userList[] = 'Без менеджера';
                        foreach ($records as $user) {
                            $userList[$user->id] = $user->first_name . " " . $user->last_name;
                        }
                        echo $form->dropDownList(
                            $model,
                            'user_id',
                            $userList,
                            array(
                                'class' => ' chzn-select',
                                'data-placeholder' => 'Менеджер',
                                'style' => 'width:40%',
                            )
                        )?>
                    </div>
                </div>
            </div>
            <div class="span3">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'sub_agent_id', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $sub_agent_records = Subagent::model()->findAll();
                        $sub_agents = array();
                        $sub_agents_list[] = 'Без субагента';
                        foreach ($sub_agent_records as $sub_agents) {
                            $sub_agents_list[$sub_agents->id] = $sub_agents->title;
                        }
                        echo $form->dropDownList(
                            $model,
                            'sub_agent_id',
                            $sub_agents_list,
                            array(
                                'class' => 'chzn-select',
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </fieldset>
</div>


<div class="row-fluid multicolumn">
    <fieldset class="well fieldset">
        <legend class="legend"><label class="label label-info">Заказчик</label></legend>
        <div class="row-fluid">
            <div class="span3">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'last_name', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'last_name'); ?>
                        <?php echo $form->error($model, 'last_name', array('hideErrorMessage' => true)); ?>
                    </div>
                </div>
            </div>
            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'first_name', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'first_name'); ?>
                        <?php echo $form->error($model, 'first_name', array('hideErrorMessage' => true)); ?>
                    </div>
                </div>
            </div>
            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'middle_name', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'middle_name'); ?>
                        <?php echo $form->error($model, 'middle_name', array('hideErrorMessage' => true)); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">

            <div class="span3">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'email'); ?>
                        <?php echo $form->error($model, 'email', array('hideErrorMessage' => true)); ?>
                    </div>
                </div>

            </div>
            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'mobile_phone', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'mobile_phone'); ?>
                        <?php echo $form->error($model, 'mobile_phone', array('hideErrorMessage' => true)); ?>
                    </div>
                </div>

            </div>
            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'phone', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'phone'); ?>
                        <?php echo $form->error($model, 'phone', array('hideErrorMessage' => true)); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span3 ">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'address', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'address'); ?>
                        <?php echo $form->error($model, 'address', array('hideErrorMessage' => true)); ?>
                    </div>
                </div>
            </div>
            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'Город/Индекс', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'city', array('class' => 'input-small-custom')); ?> /
                        <?php echo $form->textField($model, 'index', array('class' => 'input-small-custom')); ?>
                        <?php echo $form->error($model, 'city', array('hideErrorMessage' => true)); ?>
                        <?php echo $form->error($model, 'index', array('hideErrorMessage' => true)); ?>
                    </div>
                </div>
            </div>
            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'company', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'company'); ?>
                        <?php echo $form->error($model, 'company', array('hideErrorMessage' => true)); ?>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</div>

<div class="row-fluid multicolumn">
    <fieldset class="well fieldset">
        <legend class="legend"><label class="label label-info">Информация о пакетном туре</label></legend>
        <div class="row-fluid">
            <div class="span3">
                <div class="control-group">
                    <?php echo $form->labelEx(
                        $model->packageTour,
                        'tour_operator_id',
                        array('class' => 'control-label')
                    ) ?>
                    <div class="controls">
                        <?php
                        echo $form->dropDownList(
                            $model->packageTour,
                            'tour_operator_id',
                            CHtml::listData(TourOperators::model()->findAll(), 'id', 'title'),
                            array(
                                'class' => 'chzn-select',

                            )
                        );
                        echo $form->error($model->packageTour, "tour_operator_id", array('hideErrorMessage' => true));
                        ?>
                    </div>
                </div>
            </div>
            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model->packageTour, 'number', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model->packageTour, 'number'); ?>
                        <?php echo $form->error($model->packageTour, 'number', array('hideErrorMessage' => true)); ?>
                    </div>
                </div>
            </div>

            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model->packageTour, 'country_id', array('class' => 'control-label')) ?>
                    <div class="controls">
                        <?php
                        echo $form->dropDownList(
                            $model->packageTour,
                            'country_id',
                            CMap::mergeArray(array(''=>''), CHtml::listData(Countries::model()->findAll(), 'id', 'title')),
                            array(
                                'class' => 'chzn-select dependent-field',
                                'data-placeholder' => 'Выберите страну',
                                'onchange' => CHtml::ajax(array(
                                        'url' => Yii::app()->createUrl(
                                            'backend/orders/getDepend',
                                            array('depend' => 'Regions','key' => "country_id")
                                        ),
                                        'data' => array('id'=>'js:$(this).val()'),
                                        'success' => 'function(response){$.fn.getDependData(response, ["#PackageTour_region_id","#PackageTour_hotel_id"])}',
                                        'beforeSend' => 'function(){$.fn.insertSpinner("#PackageTour_region_id");}'
                                    )
                                ),
                            )
                        );
                        echo $form->error($model->packageTour, "country_id", array('hideErrorMessage' => true));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span3">
                <div class="control-group">
                    <?php echo $form->labelEx(
                        $model->packageTour,
                        'date_departure',
                        array('class' => 'control-label')
                    ) ?>
                    <div class="controls">

                        <div class="input-prepend">
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>
                            <?php
                            echo $form->telField(
                                $model->packageTour,
                                'date_departure',
                                array('class' => 'juiDate', 'placeholder' => 'Дата вылета')
                            );
                            echo $form->error($model->packageTour, "date_departure", array('hideErrorMessage' => true));
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model->packageTour, 'date_return', array('class' => 'control-label')) ?>
                    <div class="controls">
                        <div class="input-prepend">
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>
                            <?php
                            echo $form->telField(
                                $model->packageTour,
                                'date_return',
                                array('class' => 'juiDate', 'placeholder' => 'Дата прилета')
                            );
                            echo $form->error($model->packageTour, "date_return", array('hideErrorMessage' => true));
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model->packageTour, 'airport_id', array('class' => 'control-label')) ?>
                    <div class="controls">
                        <?php
                        echo $form->dropDownList(
                            $model->packageTour,
                            'airport_id',
                            CHtml::listData(Airports::model()->findAll(), 'id', 'title'),
                            array(
                                'class' => 'chzn-select',
                            )
                        );
                        echo $form->error($model->packageTour, "airport_id", array('hideErrorMessage' => true));
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="row-fluid">
            <div class="span3">
                <div class="control-group">
                    <?php echo $form->labelEx($model->packageTour, 'region_id', array('class' => 'control-label')) ?>
                    <div class="controls">
                        <?php
                        echo $form->dropDownList(
                            $model->packageTour,
                            'region_id',
                            $model->isNewRecord ? array() : CHtml::listData(Regions::model()->findAll('country_id=:id', array(':id' => $model->packageTour->country_id)), 'id', 'title'),
                            array(
                                'class' => 'chzn-select',
                                'onchange' => CHtml::ajax(array(
                                        'url' => Yii::app()->createUrl(
                                            'backend/orders/getDepend',
                                            array('depend' => 'Hotels','key' => "region_id")
                                        ),
                                        'data' => array('id'=>'js:$(this).val()'),
                                        'success' => 'function(response){$.fn.getDependData(response, "#PackageTour_hotel_id")}',
                                        'beforeSend' => 'function(){$.fn.insertSpinner("#PackageTour_hotel_id");}'
                                    )
                                ),
                                'data-placeholder' => 'Выберите курорт',
                                'empty' => '',
                            )
                        );
                        echo $form->error($model->packageTour, "region_id", array('hideErrorMessage' => true));
                        ?>
                    </div>
                </div>
            </div>
            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model->packageTour, 'hotel_id', array('class' => 'control-label')) ?>
                    <div class="controls">
                        <?php
                        echo $form->hiddenField(
                            $model->packageTour,
                            'hotel_id',
                            array(
                                'class' => 'chzn-hotels',
                            )
                        );
                        echo $form->error($model->packageTour, "hotel_id", array('hideErrorMessage' => true));
                        ?>
                    </div>
                </div>
            </div>
            <div class="span3 offset1">
                <div class="control-group">
                    <?php echo $form->labelEx($model->packageTour, 'pension_type', array('class' => 'control-label')) ?>
                    <div class="controls">
                        <?php
                        echo $form->dropDownList(
                            $model->packageTour,
                            'pension_type',
                            array('Всё включено', 'Только завтраки', 'Двухразовое', 'Трёхразовое'),
                            array(
                                'class' => 'select-without-search',
                            )
                        );
                        echo $form->error($model->packageTour, "pension_type", array('hideErrorMessage' => true));
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </fieldset>
</div>

<div class="row-fluid multicolumn">
<fieldset class="well fieldset">
<legend class="legend"><label class="label label-info">Финансы</label></legend>
<div class="row-fluid">
    <div class="span3">
        <div class="control-group">
            <?php echo $form->labelEx($model, 'price', array('class' => 'control-label')) ?>
            <div class="controls">
                <div class="input-prepend">
            <span
                class="add-on open-dropdown currency-symbol price-currency-symbol"><?php if (!empty($model->currency_id)) {
                    echo $model->currency->symbol;
                } else {
                    echo '$';
                }?></span>
                    <?php
                    echo $form->dropDownList(
                        $model,
                        'currency_id',
                        CHtml::listData(Currency::model()->findAll(), 'id', 'title'),
                        array(
                            'class' => 'chzn-select chzn-select-hidden currency-dropdown',
                        )
                    );

                    ?>
                    <?php
                    echo $form->numberField(
                        $model,
                        'price',
                        array(
                            'class' => 'input-small overlay calc',
                        )
                    );
                    ?>
                </div>

                <?php
                echo $form->error($model, 'price', array('hideErrorMessage' => true));
//                echo $form->error($model, "currency_id", array('hideErrorMessage' => true));
                ?>
            </div>
        </div>
    </div>
    <div class="span3 offset1">
        <div class="control-group">
            <?php echo $form->labelEx($model, 'commission', array('class' => 'control-label')) ?>
            <div class="controls">
                <div class="input-prepend">
                            <span
                                class="add-on currency-symbol price-currency-symbol"><?php if (!empty($model->currency_id)) {
                                    echo $model->currency->symbol;
                                } else {
                                    echo '$';
                                }?></span>
                    <?php
                    echo $form->numberField($model, 'commission');
                    echo $form->error($model, 'commission', array('hideErrorMessage' => true));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="span3 offset1">
        <div class="control-group">
            <?php echo $form->labelEx($model, 'subcommission', array('class' => 'control-label')) ?>
            <div class="controls">
                <div class="input-prepend">
            <span
                class="add-on currency-symbol price-currency-symbol"><?php if (!empty($model->currency_id)) {
                    echo $model->currency->symbol;
                } else {
                    echo '$';
                }?></span>
                    <?php
                    echo $form->numberField(
                        $model,
                        'subcommission'
                    );
                    ?>
                </div>
                <?php
                echo $form->error($model, 'subcommission', array('hideErrorMessage' => true));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span3">
        <div class="control-group">
            <?php echo $form->labelEx($model, 'discount', array('class' => 'control-label')) ?>
            <div class="controls">
                <div class="input-prepend">
            <span class="add-on open-dropdown currency-symbol discount-currency-symbol">
                <?php
                if (!empty($model->currency_id) and $model->discount_currency_id != 0) {
                    echo $model->currency->symbol;
                } else {
                    echo '%';
                }?></span>
                    <?php
                    echo $form->dropDownList(
                        $model,
                        'discount_currency_id',
                        array(0 => '%') + (($model->currency) ? array($model->currency->id => $model->currency->title) : array(1=>'USD')),
                        array(
                            'class' => 'chzn-select chzn-select-hidden currency-dropdown',
                        )
                    );
                    ?>
                    <?php
                    echo $form->numberField(
                        $model,
                        'discount',
                        array(
                            'class' => 'input-small overlay calc',
                        )
                    );
                    ?>
                </div>
                <?php
                echo $form->error($model, 'discount', array('hideErrorMessage' => true));
//                echo $form->error($model, "currency_id", array('hideErrorMessage' => true));
                ?>
            </div>
        </div>
    </div>
    <div class="span3 offset1">
        <div class="control-group">
            <?php echo $form->labelEx($model, 'amount_paid', array('class' => 'control-label')) ?>
            <div class="controls">
                <div class="input-prepend">
                            <span
                                class="add-on currency-symbol price-currency-symbol"><?php if (!empty($model->currency_id)) {
                                    echo $model->currency->symbol;
                                } else {
                                    echo '$';
                                }?></span>
                    <?php
                    echo $form->numberField($model, 'amount_paid');
                    echo $form->error($model, 'amount_paid', array('hideErrorMessage' => true));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="span3 offset1">
        <div class="control-group">
            <?php echo $form->labelEx($model, 'travel_service_fee', array('class' => 'control-label')) ?>
            <div class="controls">
                <div class="input-prepend">
            <span
                class="add-on open-dropdown currency-symbol travel-service-fee-currency-symbol"><?php if (!empty($model->travel_service_fee_currency_id)) {
                    echo $model->travelServiceFeeCurrency->symbol;
                } else {
                    echo '$';
                }?></span>
                    <?php
                    echo $form->dropDownList(
                        $model,
                        'travel_service_fee_currency_id',
                        CHtml::listData(Currency::model()->findAll(), 'id', 'title'),
                        array(
                            'class' => 'chzn-select chzn-select-hidden currency-dropdown',
                        )
                    );

                    ?>
                    <?php
                    echo $form->numberField(
                        $model,
                        'travel_service_fee',
                        array(
                            'class' => 'input-small overlay',
                        )
                    );
                    ?>
                </div>

                <?php
                echo $form->error($model, 'travel_service_fee', array('hideErrorMessage' => true));
//                echo $form->error($model, "travel_service_fee_currency_id", array('hideErrorMessage' => true));
                ?>
            </div>
        </div>
    </div>
</div>

<div class='row-fluid multicolumn'>
    <div class="offset3 span5">
        <div class="control-group">
            <div class="controls">
                <?php
                echo CHtml::button('График взаиморасчетов', array('class' => 'btn','style'=>'margin-right:2%'));
                echo CHtml::button('Транзакции', array('class' => 'btn'));
                ?>
            </div>
        </div>
    </div>
</div>
</div>


<div class="row-fluid multicolumn">
    <fieldset class="well fieldset">
        <legend class="legend"><label class="label label-info">Документы</label></legend>
        <?php $this->widget('AttachmentsWidget',array('model' => $model, 'inForm' => true, 'form' => 'orders-form'));?>
    </fieldset>
</div>
<div class="row-fluid multicolumn">
    <div class="span11">
        <div class="control-group">
            <div class="controls">

                <?php $this->actionGetGrid(!empty($model->id) ? $model->id : null) ?>
            </div>

        </div>
    </div>
</div>
<div class="row-fluid multicolumn">
    <div class="span11">
        <div class="control-group">
            <div class="controls">
                <?php $this->actionGetComments(
                    !empty($model->id) ? $model->id : null,
                    !empty($model->request_id) ? $model->request_id : null
                ) ?>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid multicolumn">
    <div class="control-group">
        <div class="controls">
            <?php
            echo CHtml::submitButton(
                $model->isNewRecord ? 'Создать заказ' : 'Сохранить заказ',
                array(
                    'class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success'
                )
            );
            ?>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(document).ready(function () {
        var h_data = <?php echo json_encode($model->isNewRecord ?
                array() :
                CHtml::listData(Hotels::model()->findAll(
                'region_id=:id',
                array(
                ':id' => $model->packageTour->region_id)
                ), 'id', 'title'));?>;
        $.order_math_form(<?php echo json_encode(CHtml::listData(Currency::model()->findAll(), 'id', 'symbol'))?>, h_data);
    })
</script>

