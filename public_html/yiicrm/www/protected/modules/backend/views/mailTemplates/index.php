<?php
/* @var $this MailTemplatesController */
/* @var $model MailTemplates */

$this->breadcrumbs = array(
    'Шаблоны писем',
);
$this->header = 'Шаблоны писем';
$this->setPageTitle("Список шаблонов писем");
$this->headerMenu = array(
    array(
        'label' => 'Создать шаблон',
        'url' => array('create'),
        'icon' => 'icon-plus'
    ),
);
?>
<?php $this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'grid',
            'id' => 'mail-templates-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                'title',
                'subject',
                'from',
                'email',
                'alias',
                array(
                    'class' => 'ButtonColumn',
                    'buttons' => array(
                        'view' => array(
                            //'url' => 'Yii::app()->createUrl("backend/mailTemplates/view", array("alias" => $data->alias))',
                            'icon' => 'icon-eye-open'
                        ),
                        'update' => array(
                            'icon' => 'icon-edit'

                        ),
                        'delete' => array(
                            'icon' => 'icon-trash'
                        ),
                    ),
                ),
            )
        ),
        'header' => $this->header,
        'footer' => true,
        'icon' => 'icon-th',
    )
);
