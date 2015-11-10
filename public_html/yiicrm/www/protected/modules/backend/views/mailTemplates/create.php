<?php
/* @var $this MailTemplatesController */
/* @var $model MailTemplates */


$this->breadcrumbs = array(
    'Шаблоны писем' => array('index'),
    'Создать',
);
$this->setPageTitle("Создать шаблон");
$this->headerMenu = array(
    array('label' => 'Список шаблонов', 'url' => array('index'), 'icon' => 'icon-list'),

);
$this->header = 'Создание шаблона письма';
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>