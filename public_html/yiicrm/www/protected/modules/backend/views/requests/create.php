<?php
/* @var $this RequestsController */
/* @var $model Requests */

$this->breadcrumbs = array(
    'Заявки' => array('index'),
    'Создать',
);
$this->setPageTitle("Создать заявку");
$this->headerMenu = array(
    array(
        'label' => 'Назначить менеджера',
        'url' => "#",
        'linkOptions' => array('onclick' => '$("#assignModal").modal();',),
        'icon' => 'icon-user'
    ),
    array('label' => 'Список заявок', 'url' => array('index'), 'icon' => 'icon-list'),
);
$this->header = 'Заявка на подбор тура'
?>


<?php $this->renderPartial('_form', array('model' => $model)); ?>