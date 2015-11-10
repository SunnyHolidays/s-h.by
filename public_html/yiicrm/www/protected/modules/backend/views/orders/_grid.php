<?php
/* @var $data CArrayDataProvider */
/* @var $order_id integer */
/* @var $this OrdersController */
/* @var $criteria CDbCriteria */

$dataProvider = new CActiveDataProvider(
    Participants::model(),
    array(
        'criteria' => $criteria,
        'pagination' => array('pageSize' => 5)
    )
);
$dataProvider->pagination->route = 'orders/getGrid';
$dataProvider->pagination->params = array('order_id'=>$order_id);

if (!Yii::app()->request->isAjaxRequest) {
    Yii::app()->clientScript->registerScript(
        'grid-first-load',
        '$("#participants-view").children(".keys").attr("title", "' . $this->createUrl(
            $dataProvider->pagination->route,
            $dataProvider->pagination->params
        ) . '");
      '
    );
}

$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'id' => 'participants-view',
            'name' => 'grid',
            'dataProvider' => $dataProvider,
            'emptyText' => 'Нет ни одного участника',
            'columns' => array(
                'first_name',
                'last_name',
                'birthday',
                'passport_number',
                'date_of_issue',
                'date_of_expiry',
                'nationality',
                array(
                    'class' => 'ButtonColumn',
                    'buttons' => array(
                        'view' => array(
                            'url' => 'Yii::app()->createUrl("backend/orders/viewparticipant", array("id" => $data->id))',
                            'icon' => 'icon-eye-open',
                            'click' => 'function(){updateModalForm(this);return false;}'
                        ),
                        'update' => array(
                            'icon' => 'icon-edit',
                            'url' => 'Yii::app()->createUrl("backend/orders/updateparticipant", array("id"=> $data->id))',
                            'click' => 'function(){updateModalForm(this);return false;}'
                        ),
                        'delete' => array(
                            'icon' => 'icon-trash',
                            'url' => 'Yii::app()->createUrl("backend/orders/deleteparticipant", array("id"=> $data->id))'
                        ),
                    ),
                ),

            )
        ),
        'header' => 'Участники',
        'icon' => ' icon-user',
        'footer' => true,
        'footerElements' => CHtml::link('Добавить участника', '', array(
                'class' => 'btn btn-primary',
                'data-toggle' => 'modal',
                'style' => 'float: right; color:#fff;width:155px',
                'data-get-form' => Yii::app()->createUrl('/backend/orders/createparticipant', array('order_id' => $order_id)),
                'onclick' => 'js:getModalForm(this)',
                'enable' => 'true',
            )
        )
    )
);

?>