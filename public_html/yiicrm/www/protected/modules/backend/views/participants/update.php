<?php
/* @var $this ParticipantsController */
/* @var $model Participants */

$this->breadcrumbs = array(
    'Participants' => array('index'),
    'Update',
);

$this->menu = array(
    array('label' => 'List Participants', 'url' => array('index')),
    array('label' => 'Create Participants', 'url' => array('create')),
    array('label' => 'View Participants', 'url' => array('view', 'id' => $model->id)),
    array('label' => 'Manage Participants', 'url' => array('admin')),
);
?>


<?php $this->renderPartial('_form', array('model' => $model)); ?>