<?php
/* @var $this MailTemplatesController */
/* @var $model MailTemplates */

$this->breadcrumbs = array(
    'Шаблоны писем' => array('index'),
    $model->title,
);
$this->header = "Шаблон '" . $model->title . "'";
$this->setPageTitle("Просмотреть шаблон");
$this->headerMenu = array(
    array('label' => 'Список шаблонов', 'url' => array('index'), 'icon' => 'icon-list'),
    array('label' => 'Создать шаблон', 'url' => array('create'), 'icon' => 'icon-plus'),
    array('label' => 'Обновить шаблон', 'url' => array('update', 'id' => $model->id), 'icon' => 'icon-edit'),
    array(
        'label' => 'Удалить шаблон',
        'url' => '#',
        'linkOptions' => array(
            'submit' => array('delete', 'id' => $model->id),
            'confirm' => 'Вы уверены, что хотите удалить этот элемент?',

        ),
        'icon' => 'icon-trash'
    ),
);
$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'id' => 'mailtemplates-details',
            'name' => 'detailViewEditable',
            'url' => $this->createUrl('/backend/mailTemplates/updateEditable'),
            'model' => $model,
            'attributes' => array(
                'id',
                'alias',
                'title',
                'from',
                'email',
                'subject',
                'body',
                array(
                    'label' => 'Превью(html)',
                    'value'=>$model->body,
                    'type' => 'html',
                ),
                'body_text',
                'tags',
            ),
        ),
        'header' => $this->header,
        'icon' => 'icon-list',

    )
);
?>
