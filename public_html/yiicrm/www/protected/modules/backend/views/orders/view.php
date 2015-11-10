<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $ordersID array */
/* @var $order_id integer */
/* @var $criteria CDbCriteria */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->clientScript->registerCoreScript('yiiactiveform');
$this->breadcrumbs = array(
    'Заказы' => array('index'),
    $model->id,
);
$this->header = "Заказ №" . $model->id;
$this->setPageTitle("Просмотреть заказ");
$this->headerMenu = array(
    array('label' => 'Список заказов', 'url' => array('index'), 'icon' => 'icon-list'),
    array('label' => 'Создать заказ', 'url' => array('create'), 'icon' => 'icon-plus'),
    array('label' => 'Обновить заказ', 'url' => array('update', 'id' => $model->id), 'icon' => 'icon-edit'),
    array(
        'label' => 'Удалить заказ',
        'url' => '#',
        'linkOptions' => array(
            'submit' => array('delete', 'id' => $model->id),
            'confirm' => 'Вы уверены, что хотите удалить этот элемент?',

        ),
        'icon' => 'icon-trash'
    ),
);
?>
<?php
$key = array_search($model->id, $ordersID);
?>
<div class="well">
    <div class="btn-group">
        <?php
        if (!empty($ordersID[$key - 1])) {

            echo CHtml::link(
                'Предыдущий',
                array(
                    'orders/view',
                    'id' => $ordersID[$key - 1],

                ),
                array('class' => 'btn')
            );

        } else {
            echo " <button class='btn' disabled='disabled'>Предыдущий</button>";
        }
        if (!empty($ordersID[$key + 1])) {

            echo CHtml::link(
                'Следующий',
                array(
                    'orders/view',
                    'id' => $ordersID[$key + 1],

                ),
                array('class' => 'btn')

            );
        } else {
            echo " <button class='btn' disabled='disabled'>Следующий</button>";
        }
        ?>

    </div>

    <?php
    if (!empty($model->request_id)) {
        echo CHtml::link(
            'Перейти на заявку',
            array(
                'requests/view',
                'id' => $model->request_id,
            ),
            array(
                'class' => 'btn span2',
                'style' => 'float:right'
            )
        );
    }
    ?>
</div>
<div class="form-horizontal">
<div class=" row-fluid multicolumn">
    <fieldset class="well fieldset">
        <div class="row-fluid">
            <div class="span3">
                <div class="control-group">
                    <?php echo CHtml::activeLabelEx(
                        $model->packageTour,
                        'date',
                        array('class' => 'control-label')
                    ) ?>
                    <div class="controls">
                        <?php
                        $this->widget(
                            'editable.EditableField',
                            array(
                                'type' => 'date',
                                'model' => $model->packageTour,
                                'attribute' => 'date',
                                'url' => $this->createUrl(
                                    '/backend/orders/updateEditable',
                                    array('model' => 'PackageTour')
                                ),
                                'placement' => 'right',
                                'format' => 'dd.mm.yyyy',
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <div class="span3">
                <div class="control-group">
                    <?php echo CHtml::activeLabelEx($model, 'tour_type_id', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $this->widget(
                            'editable.EditableField',
                            array(
                                'type' => 'select',
                                'model' => $model,
                                'attribute' => 'tour_type_id',
                                'url' => $this->createUrl(
                                    '/backend/orders/updateEditable',
                                    array('model' => 'Orders')
                                ),
                                'source' => $model->tour_type,
                                'inputclass' => 'input-medium chzn-select',
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <div class="span3">
                <div class="control-group">
                    <?php echo CHtml::activeLabelEx($model, 'user_id', array('class' => 'control-label')) ?>

                    <div class="controls">
                        <?php
                        $records = Users::model()->findAll('role_id=:role_id', array(':role_id' => 1));
                        $users = array();
                        $userList[""] = 'Не задан';
                        foreach ($records as $user) {
                            $userList[$user->id] = $user->first_name . " " . $user->last_name;
                        }
                        $this->widget(
                            'editable.EditableField',
                            array(
                                'type' => 'select',
                                'model' => $model,
                                'attribute' => 'user_id',
                                'url' => $this->createUrl(
                                    '/backend/orders/updateEditable',
                                    array('model' => 'Orders')
                                ),
                                'source' => $userList,
                                'inputclass' => 'input-medium chzn-select',
                                'htmlOptions' => array(
                                    'data-placeholder' => 'Менеджер',
                                )
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <div class="span3">
                <div class="control-group">
                    <?php echo CHtml::activeLabelEx($model, 'sub_agent_id', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php
                        $sub_agent_records = Subagent::model()->findAll();
                        $sub_agents = array();
                        $sub_agents_list[""] = 'Не задан';
                        foreach ($sub_agent_records as $sub_agents) {
                            $sub_agents_list[$sub_agents->id] = $sub_agents->title;
                        }
                        $this->widget(
                            'editable.EditableField',
                            array(
                                'type' => 'select',
                                'model' => $model,
                                'attribute' => 'sub_agent_id',
                                'url' => $this->createUrl(
                                    '/backend/orders/updateEditable',
                                    array('model' => 'Orders')
                                ),
                                'source' => $sub_agents_list,
                                'inputclass' => 'input-medium chzn-select',
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
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'last_name', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'last_name',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'first_name', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'first_name',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'middle_name', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'middle_name',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'email', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'email',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                    )
                );
                ?>
            </div>
        </div>

    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'mobile_phone', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'mobile_phone',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                    )
                );
                ?>
            </div>
        </div>

    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'phone', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'phone',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'address', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'address',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'Город/Индекс', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'city',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',


                    )
                );
                ?>
                /
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'index',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'company', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'company',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
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
<legend class="legend"><label class="label label-info">Информация о пакетном туре</label></legend>
<div class="row-fluid">
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx(
                $model->packageTour,
                'tour_operator_id',
                array('class' => 'control-label')
            ) ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select',
                        'model' => $model->packageTour,
                        'attribute' => 'tour_operator_id',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'PackageTour')
                        ),
                        'source' => Editable::source(TourOperators::model()->findAll(), 'id', 'title'),
                        'inputclass' => 'input-medium chzn-select',
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model->packageTour, 'number', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model->packageTour,
                        'attribute' => 'number',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'PackageTour')
                        ),
                        'placement' => 'right',
                    )
                );
                ?>
            </div>
        </div>
    </div>

    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model->packageTour, 'country_id', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select',
                        'model' => $model->packageTour,
                        'attribute' => 'country_id',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'PackageTour')
                        ),
                        'source' => Editable::source(Countries::model()->findAll(), 'id', 'title'),
                        'inputclass' => 'input-medium chzn-select',
                        'success' => 'js: function(response, newValue) {
                                     if(!response.success) $.updateEditableList(newValue,["a[rel^=EditableField_region_id_]","a[rel^=EditableField_hotel_id_]"],
                                      "Regions", "country_id","'.Yii::app()->createUrl('backend/orders/getDepend').'");
                                }'
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx(
                $model->packageTour,
                'date_departure',
                array('class' => 'control-label')
            ) ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'date',
                        'model' => $model->packageTour,
                        'attribute' => 'date_departure',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'PackageTour')
                        ),
                        'placement' => 'right',
                        'format' => 'dd.mm.yyyy',
                        'inputclass' => 'juiDate'
                    )
                );
                ?>
            </div>
        </div>
    </div>

    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model->packageTour, 'date_return', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'date',
                        'model' => $model->packageTour,
                        'attribute' => 'date_return',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'PackageTour')
                        ),
                        'placement' => 'right',
                        'format' => 'dd.mm.yyyy',
                        'inputclass' => 'juiDate'
                    )
                );
                ?>

            </div>

        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model->packageTour, 'airport_id', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select',
                        'model' => $model->packageTour,
                        'attribute' => 'airport_id',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'PackageTour')
                        ),
                        'source' => Editable::source(Airports::model()->findAll(), 'id', 'title'),
                        'inputclass' => 'input-medium chzn-select',
                    )
                );
                ?>
            </div>
        </div>

    </div>
</div>
<div class="row-fluid">
    <div class="span4">

        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model->packageTour, 'region_id', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $regionsSrc = Regions::model()->findAll('country_id=:id', array(':id' => $model->packageTour->country_id));
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select2',
                        'model' => $model->packageTour,
                        'attribute' => 'region_id',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'PackageTour')
                        ),
                        'source' => empty($regionsSrc) ? array(array()) : Editable::source($regionsSrc, 'id', 'title'),
                        'inputclass' => 'input-medium chzn-regions',
                        'success' => 'js: function(response, newValue) {
                                     if(!response.success) $.updateEditableList(newValue,"a[rel^=EditableField_hotel_id_]",
                                     "Hotels", "region_id","'.Yii::app()->createUrl('backend/orders/getDepend').'");
                                }',
                        'select2' => array(
                            'formatResult' => 'js:function (item) { return !item.text ? "Ничего не найдено" : item.text }',
                            'formatSelection' => 'js:function (item) { return item.text }',
                            'formatNoMatches' => 'js:function(){return "Ничего не найдено"}'
                        )
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model->packageTour, 'hotel_id', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $hotelsSrc = Hotels::model()->findAll('region_id=:id', array(':id' => $model->packageTour->region_id));
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select2',
                        'model' => $model->packageTour,
                        'attribute' => 'hotel_id',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'PackageTour')
                        ),
                        'source' => empty($hotelsSrc) ? array(array()) :  Editable::source($hotelsSrc, 'id', 'title'),
                        'inputclass' => 'input-medium chzn-select chzn-hotels',
                        'select2' => array(
                            'createSearchChoice' =>  'js:function(term, data){
                                    if ($(data).filter(function () {return this.text.localeCompare(term) === 0;}).length === 0) {
                                        return {id: term, text: term};
                                    }
                                }',
                            'formatResult' => 'js:function (item) { return !item.text ? "Ничего не найдено" : item.text }',
                            'formatSelection' => 'js:function (item) { return item.text }',
                        ),
                        'htmlOptions' => array(
                            'class' => 'test'
                        )
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model->packageTour, 'pension_type', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select',
                        'model' => $model->packageTour,
                        'value' => $model->packageTour->pension_type,
                        'attribute' => 'pension_type',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'PackageTour')
                        ),
                        'source' => array('Всё включено', 'Только завтраки', 'Двухразовое', 'Трёхразовое'),
                        'inputclass' => 'input-medium chzn-select select-without-search',
                        'htmlOptions' => array(
                            'data-placeholder' => 'Тип питания',
                            'class' => 'without-search'
                        )
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
<legend class="legend"><label class="label label-info">Финансы</label></legend>
<div class="row-fluid">
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'price', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'price',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                        'inputclass' => "input-small",
                        'htmlOptions' => array(
                            'id' => 'price-value',
                        )

                    )
                );
                ?>
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select',
                        'model' => $model,
                        'attribute' => 'currency_id',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'source' => Editable::source(Currency::model()->findAll(), 'id', 'title'),
                        'inputclass' => 'chzn-select',
                        'htmlOptions' => array(
                            'class'=>'price-currency'
                        ),

                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'commission', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'commission',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                    )
                );
                ?>
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select',
                        'model' => $model,
                        'attribute' => 'currency_id',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'source' => Editable::source(Currency::model()->findAll(), 'id', 'title'),
                        'inputclass' => 'chzn-select',
                        'htmlOptions' => array(

                            'class'=>'price-currency'
                        ),

                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'subcommission', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'subcommission',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                    )
                );
                ?>
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select',
                        'model' => $model,
                        'attribute' => 'currency_id',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'source' => Editable::source(Currency::model()->findAll(), 'id', 'title'),
                        'inputclass' => 'chzn-select',
                        'htmlOptions' => array(

                            'class'=>'price-currency'
                        ),

                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'discount', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'discount',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                        'inputclass' => "input-small",
                        'htmlOptions' => array(
                            'id' => 'discount-value',
                        )
                    )
                );
                ?>
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select',
                        'model' => $model,
                        'attribute' => 'discount_currency_id',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'source' => array(0 => '%') + ($model->currency ? array($model->currency->id => $model->currency->title) : array()),
                        'inputclass' => 'chzn-select',
                        'htmlOptions' => array(
                            'id' => 'discount-currency',
                        )
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'amount_paid', array('class' => 'control-label')) ?>
            <div class="controls">
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'amount_paid',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                        'inputclass' => "input-small",
                        'htmlOptions' => array(
                            'id' => 'amount_paid-value',
                        )

                    )
                );
                ?>
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select',
                        'model' => $model,
                        'attribute' => 'currency_id',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'source' => Editable::source(Currency::model()->findAll(), 'id', 'title'),
                        'inputclass' => 'chzn-select',
                        'htmlOptions' => array(
                            'class'=>'price-currency'
                        ),

                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="control-group">
            <?php echo CHtml::activeLabelEx($model, 'travel_service_fee', array('class' => 'control-label')) ?>
            <div class="controls">

                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'text',
                        'model' => $model,
                        'attribute' => 'travel_service_fee',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'placement' => 'right',
                        'inputclass' => "input-small",
                        'htmlOptions' => array(
                            'id' => 'travel_service_fee-value',
                        )
                    )
                );
                ?>
                <?php
                $this->widget(
                    'editable.EditableField',
                    array(
                        'type' => 'select',
                        'model' => $model,
                        'attribute' => 'travel_service_fee_currency_id',
                        'url' => $this->createUrl(
                            '/backend/orders/updateEditable',
                            array('model' => 'Orders')
                        ),
                        'source' => Editable::source(Currency::model()->findAll(), 'id', 'title'),
                        'inputclass' => 'chzn-select',
                        'htmlOptions' => array(
                            'id' => 'travel_service_fee-currency',
                        )

                    )
                );
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
</fieldset>
</div>
</div>

<div class="row-fluid multicolumn">
    <fieldset class="well fieldset">
        <legend class="legend"><label class="label label-info">Документы</label></legend>
        <?php $this->widget('AttachmentsWidget',array('model' => $model));?>
    </fieldset>
</div>

<?php $this->renderPartial('_grid', array('order_id' => $order_id, 'criteria' => $criteria)) ?>
<?php //$this->renderPartial(
//    '_visasindex',
//    array(
//        'model' => new Visas(),
//        'orderID' => $model->id,
//    )
//);
?>
<div class="row-fluid multicolumn">
    <div class="span12">
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


<script type="text/javascript">
    $(document).ready(function () {
        $.order_math_editable(
            <?php echo json_encode(CHtml::listData(Currency::model()->findAll(), 'id', 'title'))?>,
            '<?php echo $this->createUrl('/backend/orders/updateEditable', array('model' => 'Orders'))?>'
        );

        $('.addVisa').live('click', function () {
            $.ajax({
                type: 'post',
                url: "<?php echo Yii::app()->createUrl('/backend/orders/visascreate', array('id'=>$model->id)); ?>",
                success: function (response) {
                    if (response) {
                        $('.global-modal').html(response).modal();
                    } else {
                        $.gritter.add({
                            title: "Внимание!",
                            text: "Отсутствуют участники для добавления визы",
                            sticky: false,
                            time: 5000
                        })
                    }
                }
            });
            return false;
        });
    });
</script>
