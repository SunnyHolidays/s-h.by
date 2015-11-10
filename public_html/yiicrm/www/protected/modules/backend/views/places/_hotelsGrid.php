<?php
/* @var $model Hotels */
/* @var $this HotelsController */
$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'grid',
            'id' => 'hotels-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                'id',
                'title',
                'region.title',
                array(
                    'class' => 'ButtonColumn',
                    'buttons' => array(
                        'view' => array(
                            'icon' => 'icon-eye-open',
                            'visible' => 'false'
                        ),
                        'update' => array(
                            'icon' => 'icon-edit',
                            'click' => 'function(){updateModalForm(this);return false;}',
                            'url' => 'Yii::app()->createUrl("backend/places/updateHotel", array("id"=>$data->id))'
                        ),
                        'delete' => array(
                            'icon' => 'icon-trash',
                            'url' => 'Yii::app()->createUrl("backend/places/deleteHotel", array("id"=>$data->id))',
                            'click' => 'function(){smartDelete(this, "отель", "hotels-grid");return false;}'
                        ),
                    ),

                ),
            ),
        ),
        'header' => 'Отели',
        'footer' => true,
        'icon' => 'icon-th',
        'footerElements' => CHtml::link('Добавить отель', '', array(
            'class' => 'btn btn-primary',
            'id' => 'create-hotel',
            'data-toggle' => 'modal',
            'style' => 'float: right; color:#fff;width:155px',
            'enable' => 'true',
            'data-get-form' => Yii::app()->createUrl('backend/places/createHotel'),
            'onclick' => 'js:getModalForm(this)'
        ))

    )
); ?>
<script>
    function smartDelete(lnk, title, grid) {
        if (!confirm('Вы уверены, что хотите удалить этот элемент?')) return false;
        var th = lnk;
        $.ajax({
            type: 'post',
            url: $(th).attr('href'),
            success: function (data) {
                if (!$.isEmptyObject(data)) {
                    var response = $.parseJSON(data);
                    var li = $('<div/>', {class: 'list-group'});
                    $(response).each(function (i, e) {
                        li.append(
                            $('<a/>', {
                                href: "<?php echo Yii::app()->createUrl("backend/orders/view")?>&id=" + e.id,
                                class: (i >= 2) ? 'hidden-link' : 'list-group-item',
                                target: '_blank'
                            }).html(e.l_name + ' ' + e.f_name + ', ' + e.date + ', ' + e.country).css('display', (i >= 2) ? 'none' : 'block')
                        );
                    });
                    if (response.length >= 2) {
                        li.append(
                            $('<a/>', { href: "js:void(0)", class: 'list-group-item'}).html('<i class="icon-chevron-down"></i>').toggle(
                                function () {
                                    $(this).html('<i class="icon-chevron-up"></i>');
                                    $('.hidden-link').addClass('list-group-item').css('display', 'block');
                                },
                                function () {
                                    $(this).html('<i class="icon-chevron-down"></i>');
                                    $('.hidden-link').removeClass('list-group-item').css('display', 'none');
                                }
                            )
                        );
                    }

                    $('.global-modal').empty().append($('<div/>', {class: 'modal-header'}).html('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3>Внимание!</h3>')
                        ).append(
                            $('<div/>', {class: 'modal-body'}).append($('<h5>Данный '+ title +' не может быть удалён, так как используется в следующих заказах:</h5>').css('text-indent', '20px')).append(li)
                        ).append($('<div/>', {class: 'modal-footer'}).html('<a href="#" data-dismiss="modal" class="btn">Закрыть</a>')).modal('show');
                } else {
                    $('#'+grid).yiiGridView('update');
                }
            }
        });
        return false;
    }
</script>