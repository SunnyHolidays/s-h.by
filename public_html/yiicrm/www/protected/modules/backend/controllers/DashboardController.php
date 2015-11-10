<?php

class DashboardController extends BackendController
{
    /**
     * @var string layout path
     */
    public $layout = '/layouts/column1';
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'SaveSettings', 'GetWidget'),
                'roles' => array(PhpAuthManager::ROLE_MANAGER),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }


    /**
     * @param $widgetName string called widget name
     * @return mixed
     */
    private function getWidgetConfig($widgetName){
        return Yii::app()->getModule('backend')->params['widgets'][$widgetName];
    }
    /**
     * @param $name string Type of calling widget
     */
    public function actionGetWidget($name)
    {
        if ($name == '_requestsGrid' or $name == '_ordersGrid') {
            $this->renderPartial($name, array(), false, true);
        } else {
            $config = $this->getWidgetConfig($name);
            $this->widget($config['widgetType'], $config['params']);
        }
    }



    public function actionUpdateGrid($gridName)
    {
        $this->renderPartial($gridName,array(),false,true);
    }
    /**
     * @param $settings string Widget configuration JSON array
     *
     */
    public function actionSaveSettings($settings)
    {
        if (!empty($settings)) {
            $userId = Yii::app()->user->id;
            $settings = json_decode($settings, true);
            $userModel = Users::model()->find('id=:id', array('id' => $userId));
            $widgetsCount = count($settings);
            $userWidgets = $userModel->getWidgets();
            $userWidgetsCount = count($userWidgets);

            if (empty($userWidgets)) {
                foreach ($settings as $key => $value) {
                    $widget = new UserWidgets();
                    $widget->attributes = $value;
                    $widget->user_id = $userId;
                    $widget->save();
                }
            } else {
                if ($userWidgetsCount < $widgetsCount) {
                    for ($i = 0; $i < $widgetsCount - 1; $i++) {
                        $userWidgets[$i]->attributes = $settings[$i];
                        $userWidgets[$i]->save();
                    }
                    $newWidget = new UserWidgets();
                    $newWidget->attributes = $settings[$widgetsCount - 1];
                    $newWidget->user_id = $userId;
                    $newWidget->save();
                } elseif ($userWidgetsCount > $widgetsCount) {
                    if ($userWidgets[$userWidgetsCount - 1]->delete()) {
                        for ($i = 0; $i < $userWidgetsCount - 2; $i++) {
                            $userWidgets[$i]->attributes = $settings[$i];
                            $userWidgets[$i]->save();
                        }
                    }
                } elseif ($userWidgetsCount == $widgetsCount) {
                    foreach ($settings as $key => $value) {
                        $userWidgets[$key]->attributes = $value;
                        $userWidgets[$key]->save();
                    }
                }
            }
        }
    }

    /**
     * default action
     */
    public function actionIndex()
    {
        $html = $this->generateDashboard();
        $this->render('index', array('widgets' => $html['widgets'], 'stats' => $html['stats'] ));
    }
    /**
     * Create HTML-code of user dashboard based on Wrapper-widget and extended widgets
     * @return string
     */
    public function generateDashboard()
    {
        $dashboardHtml = '';
        $widgets = '';
        $stats = '';
        /**
         * @var $value UserWidgets
         */
        $dashboard = UserWidgets::model()->findAll('user_id=:id', array(':id' => Yii::app()->user->id));
        foreach ($dashboard as $key => $value) {
            $config = $this->getWidgetConfig($value->widget_name);
            $dashboardHtml = "<li
            data-row='" . $value->row . "'
            data-col='" . $value->col . "'
            data-sizex='" . $config['size_x'] . "'
            data-sizey='" . $config['size_y'] . "'
            type='" . $config['widgetType'] . "'
            widget-name='" . $value->widget_name . "'
            style='z-index:0'>";

            if ($config['widgetType'] != 'grid') {
                $dashboardHtml .= $this->widget($config['widgetType'], $config['params'], true);
            } else {
                $dashboardHtml .= $this->renderPartial($value->widget_name, array(), true);
            }
            $dashboardHtml .= '</li>';
            if(strstr($value->widget_name,'stat')){
                $stats .= $dashboardHtml;
            }else{
                $widgets .= $dashboardHtml;
            }
        }
        return array('widgets' => $widgets, 'stats' => $stats);
    }
}