<?php

class BackendModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
        parent::init();
        $config = new CConfiguration($this->basePath.'/config/main.php');
        Yii::app()->configure($config->toArray());
        $widgetsConfig = require_once(dirname(__FILE__) . '/config/widgets.php');
        $this->setParams($widgetsConfig);
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{

            if($controller->id == 'orders' and $action->id == 'create' and empty($_POST['Orders'])){
                $session = Yii::app()->session['participants_buffer'];
                $sessionComment = Yii::app()->session['comments_buffer'];
                $attachments = Yii::app()->session['attachments'];
                if(!empty($session)){
                    foreach($session as $key=>$value){
                        Participants::model()->deleteByPk($value);
                    }
                    unset(Yii::app()->session['participants_buffer']);
                }
                if(!empty($sessionComment)){
                    foreach($sessionComment as $key=>$value){
                        RequestComments::model()->deleteByPk($value);
                    }
                    unset(Yii::app()->session['comments_buffer']);
                }
                if(!empty($attachments)){
                    foreach($attachments as $key=>$value){
                        Attachments::model()->deleteByPk($value);
                    }
                    unset(Yii::app()->session['attachments']);
                }
            }
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
