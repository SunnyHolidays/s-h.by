<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs = array(
    'Пользователи' => array('index'),
    $model->first_name . ' ' . $model->last_name => array('view', 'id' => $model->id),
    'Обновить',
);
$this->setPageTitle("Обновить пользователя");
$this->headerMenu = array(
    array('label' => 'Список пользователей', 'url' => array('index'), 'icon' => 'icon-list'),
    array('label' => 'Создать пользователя', 'url' => array('create'), 'icon' => 'icon-plus'),
    array('label' => 'Просмотреть пользователя', 'url' => array('view', 'id' => $model->id), 'icon' => 'icon-eye-open'),
);

$this->header = 'Обновление пользователя';
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>