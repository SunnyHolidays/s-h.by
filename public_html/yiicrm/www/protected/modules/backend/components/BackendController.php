<?php
/**
 * Created by JetBrains PhpStorm.
 * User: amd1648
 * Date: 13.06.13
 * Time: 14:58
 * To change this template use File | Settings | File Templates.
 */

class BackendController extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='backend.views.layouts.main';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();
    public $header;
    public $headerMenu=array();

    protected  function beforeAction($action)
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $cs = Yii::app()->clientScript;
            $cs->scriptMap = array(
                'jquery.js' => false,
                'jquery-ui.min.js' => false,
                'jquery-ui.css' => false,
            );
        }
        return true;
    }
}