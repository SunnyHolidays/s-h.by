<?php
/* @var $this RequestsController */
/* @var $model Requests */

$this->breadcrumbs = array(
    'Заявки' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Обновить',
);
$this->setPageTitle("Обновить заявку");
$this->headerMenu = array(
    array(
        'label' => 'Назначить менеджера',
        'url' => "#",
        'linkOptions' => array('onclick' => '$("#assignModal").modal();',),
        'icon' => 'icon-user'
    ),
    array('label' => 'Список заявок', 'url' => array('index'), 'icon' => 'icon-list'),
    array('label' => 'Создать заявку', 'url' => array('create'), 'icon' => 'icon-plus'),
    array('label' => 'Просмотреть заявку', 'url' => array('view', 'id' => $model->id), 'icon' => 'icon-eye-open'),
);

$this->header = 'Обновление заявки на подбор тура';
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
