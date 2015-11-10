<?php

/**
 * Class StatBoxWidget
 */
class StatBoxWidget extends CWidget
{

    /**
     * @var CActiveRecord model object. Needs to get info, that used in statBoxes
     */
    public $model;
    /**
     * @var string
     */
    public $label;
    /**
     * @var array
     */
    public $widget = array();

    /**
     * run widget method
     */
    public function run()
    {
        $this->id = uniqid();
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/widgets/yiiStatBox.js');
        $this->render(
            'statBoxView',
            array(
                'data' => $this->getStatBox($this->model),
                'label' => $this->label
            )
        );
    }

    /**
     * @param $model CActiveRecord
     * @return array
     */
    public function getStatBox($model)
    {
        $monthCriteria = new CDbCriteria();
        $lastMonthCriteria = new CDbCriteria();
        $column = 'date';
        if($model == 'Orders'){
            $monthCriteria->with = 'packageTour';
            $lastMonthCriteria->with = 'packageTour';
            $column = 'packageTour.date';
        }

        $monthCriteria->addCondition(
            "$column > LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH AND
             $column < DATE_ADD(LAST_DAY(CURDATE()), INTERVAL 1 DAY)"
        );
        $lastMonthCriteria->addCondition(
            "$column > LAST_DAY( DATE_SUB( CURDATE( ) , INTERVAL 2 MONTH ) ) + INTERVAL 1 DAY AND
             $column < DATE_ADD( LAST_DAY( CURDATE( ) - INTERVAL 1 MONTH ) , INTERVAL 1 DAY )"
        );

        $this->widget['inMonth'] = count($model::model()->findAll($monthCriteria));
        $this->widget['inLastMonth'] = count($model::model()->findAll($lastMonthCriteria));

        if($this->widget['inLastMonth'] != 0)
        {
            $this->widget['incrementDataInPercent'] = number_format(($this->widget['inMonth'] / $this->widget['inLastMonth'] - 1) * 100,2,".","") . '%';
        }else{
            $this->widget['incrementDataInPercent'] = $this->widget['inMonth'] * 100 . '%';
        }

        $this->widget['totalAmount'] = $model::model()->count();

        return $this->widget;
    }
}