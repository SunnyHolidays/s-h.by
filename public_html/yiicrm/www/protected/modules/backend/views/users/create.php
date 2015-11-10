<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs = array(
    'Пользователи' => array('index'),
    'Создать',
);
$this->setPageTitle("Создать пользователя");
$this->headerMenu = array(
    array('label' => 'Список пользователей', 'url' => array('index'), 'icon' => 'icon-list'),
);

$this->header = 'Создание пользователя';
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>