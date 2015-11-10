<?php
/* @var $this MailTemplatesController */
/* @var $model MailTemplates */
/* @var $form CActiveForm */
/* @var $wrapper Wrapper */
?>

<?php
$wrapper = $this->beginWidget(
    'Wrapper',
    array(
        'widget' => array(
            'name' => 'activeForm',
            'id' => 'mail-templates-form',
        ),
        'header' => $this->header,
        'icon' => 'icon-th',
    )
);
$form = $wrapper->getWidget();
?>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'alias', array('class' => 'control-label'))?>
            <div class="controls">
                <?php echo $form->textField($model, 'alias'); ?>
                <?php echo $form->error($model, "alias", array('hideErrorMessage' => true)); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'title', array('class' => 'control-label'))?>
            <div class="controls">
                <?php echo $form->textField($model, 'title'); ?>
                <?php echo $form->error($model, "title", array('hideErrorMessage' => true)); ?>

            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'from', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'from'); ?>
                <?php echo $form->error($model, "from", array('hideErrorMessage' => true)); ?>

            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'email'); ?>
                <?php echo $form->error($model, "email", array('hideErrorMessage' => true)); ?>

            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'subject', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'subject'); ?>
                <?php echo $form->error($model, "subject", array('hideErrorMessage' => true)); ?>

            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'body', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                $this->widget(
                    'ImperaviRedactorWidget',
                    array(
                        // Можно использовать пару имя модели - имя свойства
                        'model' => $model,
                        'attribute' => 'body',
                        'htmlOptions' => array('style' => "width: 100%; height: 400px;"),
                        // или только имя поля ввода
                        'name' => 'body_name',
                        // Немного опций, см. http://imperavi.com/redactor/docs/
                        'options' => array(
                            'lang' => 'ru',
                            'toolbar' => true,
                            'iframe' => false,
                        ),
                    )
                );?>
                <?php echo $form->error($model, "body", array('hideErrorMessage' => true)); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'body_text', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($model, 'body_text', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model, "body_text", array('hideErrorMessage' => true)); ?>
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
        <?php $this->endWidget(); ?>
