<?php
/* @var $this VisasController */
/* @var $model Visas */
$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'detailView',
            'id' => 'visas-details',
            'model' => $model,
            'attributes'=>array(
                'type',
                array(
                    'label' => 'Участник',
                    'type' => 'raw',
                    'value' => $model->participant->first_name . " " . $model->participant->last_name,
                ),
                'participant.first_name',
                'fee',
                'amount',
                'status',
                'date_next_step',
                'description_next_step',
                'comment',
            ),
        ),
        'header' => 'Информация о визе',
        'icon' => 'icon-list',
    )
);
?>
