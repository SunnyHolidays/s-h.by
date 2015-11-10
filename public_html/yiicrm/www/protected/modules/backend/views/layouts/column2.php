<?php /* @var $this Controller */ ?>
<?php $this->beginContent('backend.views.layouts.main'); ?>
    <div class="row">
        <div class="span10">
            <?php echo $content; ?>
        </div>
        <!-- content -->
        <div class="span2" style="margin-top:16px">
            <?php
            $this->beginWidget(
                'zii.widgets.CPortlet'
            );
            $this->widget(
                'zii.widgets.CMenu',
                array(
                    'items' => $this->menu,
                    'htmlOptions' => array('class' => 'menu'),
                )
            );
            $this->endWidget();
            ?>
        </div>
        <!-- menu -->
    </div><!-- content row -->
<?php $this->endContent(); ?>