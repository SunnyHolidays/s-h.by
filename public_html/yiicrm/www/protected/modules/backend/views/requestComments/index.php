<?php
/* @var RequestsController $this */
/* @var CActiveDataProvider $dataProvider */

$dataProvider->pagination->route = $controller.'/GetComments';
$dataProvider->pagination->params = array('order_id'=>$order_id,'request_id'=>$request_id);

if (!Yii::app()->request->isAjaxRequest) {
    Yii::app()->clientScript->registerScript(
        'grid-first-load',
        '$("#requests-view").children(".keys").attr("title", "' . $this->createUrl(
            $dataProvider->pagination->route,
            $dataProvider->pagination->params
        ) . '");
      '
    );
}

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/comments/index.js');
$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'id' => 'requests-view',
            'name' => 'listView',
            'dataProvider' => $dataProvider,
            'itemView' => 'backend.views.requestComments._view',
            'summaryText' => 'Показаны {start}-{end} из {count} комментарии',
        ),
        'header' => 'Комментарии',
        'icon' => 'icon-comment',
        'footer' => true,
        'footerElements' => CHtml::link(
            'Добавить комментарий',
            '',
            array('class' => 'addComment btn', 'style' => 'float: right')
        )
    )
);
?>
<div class="addCommentForm"></div>

<script>
    $(document).ready(function () {
        var order_id = <?php echo "'$order_id'"?>, request_id = <?php echo "'$request_id'"?>, controller = <?php echo "'$controller'"?>;

        var urlUpdateListView = "<?php echo Yii::app()->createUrl('/backend/'.$controller.'/getComments')?>" +
            '&order_id=' + order_id +
            '&request_id=' + request_id;

        var selectors = {
            'addButton': '.addComment',
            'parentForm': '#request-comments-form',
            'form': '.addCommentForm',
            'cancelButton': '.btn_cancel',
            'updateButton': 'btn_update_comments'
        };

        addComment(
            selectors,
            "<?php echo Yii::app()->createUrl(
                '/backend/requestComments/create',
                array(
                'order_id'=>$order_id,
                'request_id'=>$request_id,
                'controller' => $controller,
                ))?>"
        );

        deleteComment(
            ".btn_delete_comments",
            'requests-view',
            "<?php echo Yii::app()->createUrl('/backend/requestComments/delete&id=')?>"
        );

        updateComments(
            selectors,
            "<?php echo Yii::app()->createUrl('/backend/requestComments/update&id=')?>",
            {
                'order_id': order_id,
                'request_id': request_id,
                'controller': controller
            }
        );

        saveComment(
            '#request-comments-form',
            'requests-view',
            "<?php echo Yii::app()->createUrl('/backend/requestComments/update&id=')?>",
            urlUpdateListView
        );

        cancelForm(selectors);
    });
</script>
