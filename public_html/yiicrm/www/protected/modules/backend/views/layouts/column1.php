<?php /* @var $this Controller */ ?>
<?php $this->beginContent('backend.views.layouts.main'); ?>

    <div id="content-header">
        <h1><?php echo $this->header; ?></h1>
        <?php
        $this->widget(
            'HeaderMenu',
            array(
                'items' => $this->headerMenu,
                'htmlOptions' => array('class' => 'menu btn-group', 'id' => 'header-menu'),
            )
        );
        ?>

    </div>

<?php if (isset($this->breadcrumbs)): ?>
    <?php $this->widget(
        'Breadcrumbs',
        array(
            'links' => $this->breadcrumbs,
        )
    ); ?>
<?php endif ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php echo $content; ?>
        </div>
        <div class="row-fluid">
            <div id="footer" class="span12">
                2013 &copy; Itransition
            </div>
        </div>
    </div>

<?php $this->endContent(); ?>