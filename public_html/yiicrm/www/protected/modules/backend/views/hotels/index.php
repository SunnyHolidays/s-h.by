<?php
/* @var $this HotelsController */
/* @var $model Hotels */

Yii::app()->clientScript->registerCoreScript('yiiactiveform');

$this->breadcrumbs = array(
    'Hotels' => array('index'),
    'Manage',
);

$this->header = 'Отели';

$this->headerMenu = array(
    array(
        'label' => 'Добавить отель',
        'url' => '',
        'icon' => 'icon-plus',
        'linkOptions' => array('id' => 'create-hotel')
    ),
);

Yii::app()->clientScript->registerScript(
    'search',
    "
   $('.search-form form').submit(function(){
       $('#hotels-grid').yiiGridView('update', {
           data: $(this).serialize()
       });
       return false;
   });
   "
);
?>

<div class="search-form">
    <?php $this->renderPartial(
        '_search',
        array(
            'model' => $model,
        )
    ); ?>
</div><!-- search-form -->
<?php $this->renderPartial('_grid', array('model' => $model))?>
<script>
    $('body').on('click', '#create-hotel', function () {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('backend/hotels/create')?>',
            success: function (response) {
                $('.global-modal').html(response).modal('show');
            }
        })
    });
</script>
