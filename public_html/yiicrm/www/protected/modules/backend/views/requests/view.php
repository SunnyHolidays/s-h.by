<?php
/* @var $this RequestsController */
/* @var $model Requests */
/* @var $requestID array */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs = array(
    'Заявки' => array('index'),
    $model->id,
);
$this->header = "Заявка №" . $model->id;
$this->setPageTitle("Просмотреть заявку");
$this->headerMenu = array(
    array('label' => 'Список заявок', 'url' => array('index'), 'icon' => 'icon-list'),
    array('label' => 'Создать заявку', 'url' => array('create'), 'icon' => 'icon-plus'),
    array('label' => 'Обновить заявку', 'url' => array('update', 'id' => $model->id), 'icon' => 'icon-edit'),
    array(
        'label' => 'Удалить заявку',
        'url' => '#',
        'linkOptions' => array(
            'submit' => array('delete', 'id' => $model->id),
            'confirm' => 'Вы уверены, что хотите удалить этот элемент?',

        ),
        'icon' => 'icon-trash'
    ),
);
?>
<div class="well">
    <div class="btn-group">
        <?php
        if (!empty($requestID[$key - 1])) {

            echo CHtml::link(
                'Предыдущая',
                array(
                    'requests/view',
                    'id' => $requestID[$key - 1],

                ),
                array('class' => 'btn')
            );

        } else {
            echo " <button class='btn' disabled='disabled'>Предыдущая</button>";
        }
        if (!empty($requestID[$key + 1])) {

            echo CHtml::link(
                'Следующая',
                array(
                    'requests/view',
                    'id' => $requestID[$key + 1],

                ),
                array('class' => 'btn')

            );
        } else {
            echo " <button class='btn' disabled='disabled'>Следующая</button>";
        }
        ?>
    </div>
</div>

<?php
$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'id' => 'request-details',
            'name' => 'detailViewEditable',
            'url' => $this->createUrl('/backend/requests/updateEditable'),
            'model' => $model,
            'attributes' => array(
                'id',
                'first_name',
                'last_name',
                'email',
                'phone',
                'comment',
                array(
                    'name' => 'requestCountries',
                    'label' => $model->getAttributeLabel('requestCountries'),
                    'value' => implode(', ', CHtml::listData($countries, 'id', 'title')),
                    'editable' => array(
                        'type' => 'select2',
                        'source' => Editable::source(Countries::model()->findAll(), 'id', 'title'),
                        'select2' => array(
                            'multiple' => true
                        )
                    )
                ),
                array(
                    'name' => 'date',
                    'editable' => array(
                        'type' => 'date',
                        'format' => 'dd.mm.yyyy',
                        'viewformat' => 'dd.mm.yyyy'
                    )
                ),
                array(
                    'name' => 'date_departure',
                    'editable' => array(
                        'type' => 'date',
                        'format' => 'dd.mm.yyyy',
                        'viewformat' => 'dd.mm.yyyy'
                    )
                ),
                array(
                    'name' => 'date_return',
                    'editable' => array(
                        'type' => 'date',
                        'format' => 'dd.mm.yyyy',
                        'viewformat' => 'dd.mm.yyyy'
                    )
                ),
                'duration',
                array(
                    'name' => 'requestAirports',
                    'label' => $model->getAttributeLabel('requestAirports'),
                    'value' => implode(', ', CHtml::listData($airports, 'id', 'title')),
                    'editable' => array(
                        'type' => 'select2',
                        'source' => Editable::source(Airports::model()->findAll(), 'id', 'title'),
                        'select2' => array(
                            'multiple' => true
                        )

                    )
                ),
                'adults',
                array(
                    'label' => 'Детей',
                    'type' => 'raw',
                    'value' => !empty($model->children) ?
                        "Количество: $model->children <br> Возраст: $model->child_age" : null
                ),
                'budget',
                'category',
                array( //select loaded from database
                    'name' => 'pension_type',
                    'editable' => array(
                        'type' => 'select',
                        'source' => Editable::source(
                            array('Всё включено', 'Только завтраки', 'Двухразовое', 'Трёхразовое')
                        )
                    )
                ),
                array(
                    'name' => 'params',
                    'editable' => array(
                        'type' => 'checklist',
                        'source' => array(
                            '1-я береговая линия',
                            'Центр курортной зоны',
                            'Корты',
                            'Для семей с детьми',
                            'Wifi internet',
                            'Сауна',
                            'Ночная жизнь',
                            'Анимация для взрослых',
                            'Водные горки',
                            'Анимация для детей'
                        ),
                    ),
                ),
                array(
                    'label' => 'Менеджер',
                    'type' => 'raw',
                    'value' => !empty($model->user) ? CHtml::link(
                        $model->user->first_name . ' ' . $model->user->last_name,
                        array('users/view', 'id' => $model->user->id)
                    ) : null
                ),
                array( //select loaded from database
                    'name' => 'status',
                    'editable' => array(
                        'type' => 'select',
                        'source' => Editable::source(
                            $model->getStatus()
                        )
                    )
                ),
                array(
                    'name' => 'date_next_step',
                    'editable' => array(
                        'type' => 'date',
                        'format' => 'dd.mm.yyyy',
                        'viewformat' => 'dd.mm.yyyy'
                    )

                ),
                'description_next_step',
                'source',
            ),
        ),
        'header' => $this->header,
        'icon' => 'icon-list',

    )
);

?>
<div class="row-fluid multicolumn">
    <div class="span12">
        <div class="control-group">
            <div class="controls">
                <?php $this->actionGetComments(
                    !empty($model->orders) ? Yii::app()->session['orderID'] : null,
                    $model->id
                ) ?>
            </div>
        </div>
    </div>
</div>
