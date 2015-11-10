<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
/* @var $wrapper Wrapper */
?>
<?php
$wrapper = $this->beginWidget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'activeForm',
            'id' => 'users-form',
            'htmlOptions' =>array('enctype' => 'multipart/form-data')
        ),
        'header' => $this->header,
        'icon' => 'icon-th',
    )
);
$form = $wrapper->getWidget();
?>
    <div class="row-fluid">
        <div class="span5">
            <div class="control-group">
                <?php echo $form->labelEx($model, 'login', array('class' => 'control-label'))?>
                <div class="controls">
                    <?php echo $form->textField($model, 'login'); ?>
                    <?php echo $form->error($model, 'login', array('hideErrorMessage' => true)); ?>
                </div>
            </div>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'newPassword', array('class' => 'control-label'))?>
                <div class="controls">
                    <?php echo $form->passwordField($model, 'newPassword'); ?>
                    <?php echo $form->error($model, 'newPassword', array('hideErrorMessage' => true)); ?>
                </div>
            </div>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'passwordRepeat', array('class' => 'control-label'))?>
                <div class="controls">
                    <?php echo $form->passwordField(    $model, 'passwordRepeat'); ?>
                    <?php echo $form->error($model, 'passwordRepeat', array('hideErrorMessage' => true)); ?>
                </div>
            </div>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'first_name', array('class' => 'control-label'))?>
                <div class="controls">
                    <?php echo $form->textField($model, 'first_name'); ?>
                    <?php echo $form->error($model, 'first_name', array('hideErrorMessage' => true)); ?>
                </div>
            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model, 'last_name', array('class' => 'control-label'))?>
                <div class="controls">
                    <?php echo $form->textField($model, 'last_name'); ?>
                    <?php echo $form->error($model, 'last_name', array('hideErrorMessage' => true)); ?>
                </div>
            </div>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'email', array('class' => 'control-label'))?>
                <div class="controls">
                    <?php echo $form->textField($model, 'email'); ?>
                    <?php echo $form->error($model, 'email', array('hideErrorMessage' => true)); ?>
                </div>
            </div>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'image', array('class' => 'control-label'))?>
                <div class="controls">
                    <?php echo $form->fileField($model, 'image'); ?>
                    <?php echo $form->error($model, 'image', array('hideErrorMessage' => true)); ?>
                </div>
            </div>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'role_id', array('class' => 'control-label'))?>
                <div class="controls">
                    <?php echo $form->dropDownList(
                        $model,
                        'role_id',
                        array(1 => 'Менеджер', 2 => 'Администратор'),
                        array(
                            'class' => 'chzn-select',
                            'data-placeholder' => 'Роль'
                        )
                    )?>
                    <?php echo $form->error($model, 'role_id', array('hideErrorMessage' => true)); ?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php echo CHtml::submitButton(
                        $model->isNewRecord ? 'Создать' : 'Сохранить',
                        array(
                            'class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-success'
                        )
                    ); ?>

                </div>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>