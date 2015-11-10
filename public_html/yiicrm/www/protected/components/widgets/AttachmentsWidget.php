<?php
/**
 * Class AttachmentsWidget
 */
class AttachmentsWidget extends CWidget{

    /**
     * @var CActiveRecord
     */
    public $model;
    /**
     * @var
     */
    public $widgetId;

    public $inForm = false;

    public $form = 'fileupload';
    /**
     * start widget
     */
    public function run()
    {
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile(Yii::app()->baseUrl.'/css/jquery.fileupload-ui.css');
        $this->render('attachmentsWidgetView');
    }

}
