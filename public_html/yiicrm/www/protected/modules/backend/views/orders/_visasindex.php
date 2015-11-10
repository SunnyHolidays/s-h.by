<?php
/* @var $this VisasController */
/* @var $model Visas */
//$criteria = new CDbCriteria();

?>

<?php
$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'grid',
            'id' => 'visas-grid',
            'dataProvider' => $model->search($orderID),
            'columns' => array(
                array(
                    'header' => 'Тип визы',
                    'value' => '$data->getType($data->type)',
                ),
                array(
                    'name' => 'participant.first_name',
                    'header' => 'Участник',
                    'type' => 'raw',
                    'value' => 'CHtml::link(
                        $data->participant->first_name . " " . $data->participant->last_name,
                        array(
                            "/backend/orders/viewparticipant",
                            "id" => $data->participant->id
                        ),
                        array(
                            "class" => "participantView",
                        )
                        )',
                ),
                'fee',
                'amount',
                'status',
                array(
                    'class' => 'ButtonColumn',
                    'buttons' => array(
                        'view' => array(
                            'url' => 'Yii::app()->createUrl("/backend/orders/visasview", array("id"=> $data->id))',
                            'click' => 'function(){
                                            $.ajax({
                                                url:$(this).attr("href"),
                                                success: function(response){
                                                    $(".global-modal").html(response).modal();
                                                }
                                            });
                                            return false;
                                        }',
                            'icon' => 'icon-eye-open'
                        ),
                        'update' => array(
                            'url' => 'Yii::app()->createUrl("/backend/orders/visasupdate", array("id" => $data->id,"orderID" => "'.$orderID.'"))',
                            'click' => 'function(){
                                            $.ajax({
                                                url:$(this).attr("href"),
                                                success: function(response){
                                                    $(".global-modal").html(response).modal();
                                                }
                                            });
                                            return false;
                                        }',
                            'icon' => 'icon-edit'
                        ),
                        'delete' => array(
                            'url' => 'Yii::app()->createUrl("/backend/orders/visasdelete", array("id"=> $data->id))',
                            'icon' => 'icon-trash'
                        ),
                    ),
                )
            ),
        ),
        'header' => 'Визы',
        'footer' => true,
        'icon' => 'icon-plane',
        'footerElements' => CHtml::link('Добавить визу', '', array(
                'class' => 'btn btn-primary addVisa',
                'data-toggle' => 'modal',
                'style' => 'float: right; color:#fff;width:135px',
                'enable' => 'true',
            ))
    )
);
?>

