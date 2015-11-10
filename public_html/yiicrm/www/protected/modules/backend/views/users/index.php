<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs = array(
    'Пользователи',
);
$this->header = 'Пользователи';
$this->setPageTitle("Список пользователей");
$this->headerMenu = array(
    array(
        'label' => 'Создать пользователя',
        'url' => array('create'),
        'icon' => 'icon-plus'
    )
,
);
?>
<?php $this->widget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'grid',
            'id' => 'users-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                'id',
                'login',
                'first_name',
                'last_name',
                'email',
                array(
                    'name' => 'role',
                    'value' => '$data->getRole()',
                    'header'=> 'Роль'
                ),
                array(
                    'class' => 'ButtonColumn',
                    'buttons' => array(
                        'view' => array(
                            'icon' => 'icon-eye-open'
                        ),
                        'update' => array(
                            'icon' => 'icon-edit'
                        ),
                        'delete' => array(
                            'visible' => 'Yii::app()->user->id != $data->id',
                            'icon' => 'icon-trash',
                        ),
                    ),
                ),
            ),
        ),
        'header' => $this->header,
        'footer' => true,
        'icon' => 'icon-th',
    )
); ?>
