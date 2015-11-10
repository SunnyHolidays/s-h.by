<?php
/* @var $this MailTemplatesController */
/* @var $model MailTemplates */

$this->breadcrumbs = array(
    'Шаблоны писем' => array('index'),
    $model->title => array('view', 'id' => $model->id),
    'Обновить',
);
$this->setPageTitle("Обновить шаблон");
$this->headerMenu = array(
    array('label' => 'Список шаблонов', 'url' => array('index'), 'icon' => 'icon-list'),
    array('label' => 'Создать шаблон', 'url' => array('create'), 'icon' => 'icon-plus'),
    array('label' => 'Просмотреть шаблон', 'url' => array('view', 'id' => $model->id), 'icon' => 'icon-eye-open'),
);

$this->header = 'Обновление шаблона письма';
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>