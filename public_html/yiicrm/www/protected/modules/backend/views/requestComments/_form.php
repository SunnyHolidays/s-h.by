<?php
/* @var $this RequestCommentsController */
/* @var $model RequestComments */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'request-comments-form',
        'htmlOptions' => array('class' => 'form form-horizontal comment-form'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )
); ?>

<?php echo $form->errorSummary($model); ?>

<div class="row-fluid">
    <?php echo $form->textArea($model, 'comment', array('rows' => 6, 'cols' => 50)); ?>
    <?php echo $form->error($model, 'comment'); ?>
</div>
<br>

<div class="row-fluid">
    <?php if (Yii::app()->controller->action->id != 'update'): ?>
        <?php echo CHtml::link('Сохранить', '', array('class' => 'btn-save-comment btn btn-success')) ?>
        <?php echo CHtml::link('Отмена', '', array('class' => 'btn btn-warning')) ?>
    <?php endif; ?>

    <?php $this->endWidget(); ?>

    <script>
        $(document).ready(function () {
            $(".btn-save-comment").on('click', function () {
                $.ajax({
                    type: 'post',
                    url: "<?php echo Yii::app()->createUrl(
                    '/backend/requestComments/create',
                     array(
                     'order_id'=> $order_id,
                     'request_id'=>$request_id,
                     'controller' => $controller
                     ))?>",
                    data: $('#request-comments-form').serialize(),
                    success: function (response) {
                        $.fn.yiiListView.update("requests-view",{});
                        /*$.fn.yiiListView.update('requests-view', {
                         'url': "<?php /*echo Yii::app()->createUrl(
                                '/backend/'.$controller.'/getComments',
                                    array(
                                    'order_id' => !$model->order_id ? null : $model->order_id,
                                    'request_id'=> !$model->request_id ? null : $model->request_id
                                    ))*/?>"
                         });*/
                        $('#request-comments-form').remove();
                    }
                })
            });
            $(".btn-warning").live('click', function () {
                $('#request-comments-form').remove();
            });
        })
    </script>