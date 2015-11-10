<?php

$dataProvider->pagination->route = 'requests/GetGrid';

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
            'id' => 'requests-grid',
            'dataProvider' => $dataProvider,
            'columns' => array(
                'id',
                'date',
                array(
                    'name' => 'clients',
                    'value' => '$data->first_name." ".$data->last_name." ".$data->phone',
                    'header' => 'Клиенты',
                ),
                'description_next_step',
                'date_next_step',
                array(
                    'name'=>'status',
                    'header' => 'Статус',
                    'value' => '$data->getStatus($data->status)',
                ),
                array(
                    'name' => 'user',
                    'value' => '$data->user_id==null ? "" : $data->user->last_name',
                    'header' => 'Менеджер'
                ),
                array(
                    'class' => 'ButtonColumn',
                    'buttons' => array(
                        'view' => array(

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