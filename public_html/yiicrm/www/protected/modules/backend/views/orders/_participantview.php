<?php
/**
 * @var $model Participants
 * @var $this ParticipantsController
 */

$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'detailView',
            'id' => 'participants-details',
            'model' => $model,
            'attributes' => array(
                'id',
                'first_name',
                'last_name',
                'birthday',
                'passport_number',
                'date_of_issue',
                'date_of_expiry',
                'nationality',
                'order_id',
            ),
        ),
        'header' => 'Информация об участнике',
        'icon' => 'icon-list',

    )
);
?>