<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Логин';
$this->breadcrumbs = array(
    'Логин',
);
$this->header = "Логин";
$errors = $model->getErrors();
if (isset($errors['error'])) {
    echo "<script>
    $.gritter.add({
title: 'Ошибка',
text: '" . $errors['error'][0] . "',
sticky: false,
time: 5000
});
    </script>";
}
?>

<div class="form">
    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'afterValidate' => 'js:renderErrorMessage',
                'afterValidateAttribute' => 'js:renderAttributeErrorMessage'
            ),

        )
    ); ?>
    <script>

    </script>
    <p>Введите Логин и Пароль</p>

    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span>
                <?php echo $form->textField($model, 'login', array('placeholder' => 'Логин'))?>
            </div>
            <?php
            echo $form->error($model, "login", array('hideErrorMessage' => true));
            ?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-lock"></i></span>
                <?php echo $form->passwordField($model, 'password', array('placeholder' => 'Пароль')); ?>
            </div>
            <?php echo $form->error($model, 'password', array('hideErrorMessage' => true)); ?>

        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
                <?php echo $form->checkBox($model, 'rememberMe'); ?>  <?php echo $form->label($model, 'rememberMe'); ?>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <span class="pull-left"><!--<a href="#" class="flip-link" id="to-recover">Lost password?</a>--></span>
        <span class="pull-right"><?php echo CHtml::submitButton('Login', array('class' => 'btn btn-inverse')); ?></span>
    </div>

    <?php $this->endWidget(); ?>
    <form id="recoverform" action="#" class="form-vertical">
        <p>Enter your e-mail address below and we will send you instructions how to recover a password.</p>

        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-envelope"></i></span><input type="text"
                                                                                    placeholder="E-mail address"/>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link" id="to-login">&lt; Back to login</a></span>
            <span class="pull-right"><input type="submit" class="btn btn-inverse" value="Recover"/></span>
        </div>
</div><!-- form -->

