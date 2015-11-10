<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs = array(
    'Пользователи' => array('index'),
    $model->first_name . ' ' . $model->last_name,
);
$this->header = $model->first_name . ' ' . $model->last_name;
$this->setPageTitle("Просмотреть пользователя");
$this->headerMenu = array(
    array('label' => 'Список пользователей', 'url' => array('index'), 'icon' => 'icon-list'),
    array('label' => 'Создать пользователя', 'url' => array('create'), 'icon' => 'icon-plus'),
    array('label' => 'Обновить пользователя', 'url' => array('update', 'id' => $model->id), 'icon' => 'icon-edit'),
    array(
        'label' => 'Удалить пользователя',
        'url' => '#',
        'linkOptions' => array(
            'submit' => array('delete', 'id' => $model->id),
            'confirm' => 'Вы уверены, что хотите удалить этот элемент?',

        ),
        'icon' => 'icon-trash',
        'visible' => Yii::app()->user->id != $model->id
    ),
);
?>

<?php
$this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'id' => 'users-details',
            'name' => 'detailViewEditable',
            'url' => $this->createUrl('/backend/users/updateEditable'),
            'model' => $model,
            'attributes' => array(
                'id',
                'login',
                'first_name',
                'last_name',
                'email',
                array(
                    'name'=>'role_id',
                    'value' => $model->getRole(),
                    'editable'=>array(
                        'type'=>'select',
                        'source'=>array('Пользователь','Менеджер','Администратор'),
                    ),
                    !empty($model->image)? array(
                        'label' => $model->getAttributeLabel('image'),
                        'type' => 'raw',
                        'value' => CHtml::image(Yii::app()->baseUrl.'/uploads/'.$model->image->path,'image', array('width' => '128px'))):null
                ),
            )
        ),
        'header' => $this->header,
        'icon' => 'icon-list',

    )
);
?>

