<?php

$dataProvider->pagination->route = 'orders/GetGridOrders';

if (!Yii::app()->request->isAjaxRequest) {
    Yii::app()->clientScript->registerScript(
        'grid-first-load',
        '$("#requests-grid").children(".keys").attr("title", "' . $this->createUrl(
            $dataProvider->pagination->route
        ) . '");
      '
    );
}

$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'grid',
            'id' => 'orders-grid',
            'dataProvider' => $dataProvider,
            'columns' => array(
                'id',
                array(
                    'name' => 'date',
                    'value' => '$data->packageTour->date',
                    'header' => 'Дата'
                ),
                array(
                    'name' => 'tourOperator',
                    'value' => '$data->packageTour->tourOperator->title',
                    'header' => 'Туроператор'
                ),
                array(
                    'name' => 'participant',
                    'value' => '$data->last_name." ".$data->middle_name." ".$data->first_name',
                    'header' => 'Клиенты',
                ),
                'address',
                array(
                    'name' => 'city',
                    'value' => '$data->city." Код:".$data->index',
                    'header' => 'Город'
                ),
                'company',
                array(
                    'name' => 'subagent',
                    'value' => '$data->sub_agent_id==null ? "" : $data->subagent->title',
                    'header' => 'Субагент'
                ),
                array(
                    'name' => 'user',
                    'value' => '$data->user_id==null ? "" : $data->user->last_name',
                    'header' => 'Менеджер'
                ),
                array(
                    'name' => 'country',
                    'value' => '$data->packageTour->country->title',
                    'header' => 'Страна'
                ),
                array(
                    'name' => 'region',
                    'value' => '$data->packageTour->region->title',
                    'header' => 'Регион'
                ),
                array(
                    'name' => 'hotel',
                    'value' => '$data->packageTour->hotel->title',
                    'header' => 'Отель'
                ),
                array(
                    'name' => 'airport',
                    'value' => '$data->packageTour->airport->title',
                    'header' => 'Аэропорт'
                ),
                'price',
                'discount',
                'currency.title',
                array(
                    'class' => 'ButtonColumn',
                    'buttons' => array(
                        'view' => array(
                            'url' => 'Yii::app()->createUrl("backend/orders/view", array("id" => $data->id))',
                            'icon' => 'icon-eye-open'

                        ),
                        'update' => array(
                            'icon' => 'icon-edit'

                        ),
                        'delete' => array(
                            'icon' => 'icon-trash'

                        ),
                    ),
                ),
            )
        ),
        'header' => $this->header,
        'footer' => true,
        'icon' => 'icon-th',
    )
);