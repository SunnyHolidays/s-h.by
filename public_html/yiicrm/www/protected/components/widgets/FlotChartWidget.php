<?php

class FlotChartWidget extends CWidget
{

    /**
     * @var CActiveRecord model object. Needs to get info, that used in flot
     */
    public $modelData;
    /**
     * @var attributes
     */
    public $attributes;
    /**
     * @var string
     */
    public $color;
    /**
     * @var string
     */
    public $widgetHeader = 'График';

    /**
     * @var array
     */
    public $labels = array();

    /**
     * @var array
     */
    public $ticks = array();

    /**
     * @var string
     */
    public $type;

    /**
     * run widget method
     */
    public function run()
    {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/widgets/yiiFlotChart.js');
        $this->id = $this->modelData.'_'.$this->type;
        $this->render(
            'flotChartView',
            array(
                'data' => $this->getFlotInfo($this->modelData, $this->attributes),
                'header' => $this->widgetHeader,
                'labels' => $this->labels,
                'ticks' => $this->ticks,
                'type' => $this->type,
                'color' => $this->color,
            )
        );
    }

    /**
     * @param $modelData CActiveRecord
     * @param $attributes array
     * @return array
     */
    private function getFlotInfo($modelData, $attributes)
    {
        $data = array();
        $sells = array();

        $criteriaBars = new CDbCriteria();
        $criteriaBars->select = "{$attributes[0]}, COUNT(*)";
        $criteriaBars->group = "{$attributes[0]}";
        $criteriaBars->order = 'COUNT(*) DESC';
        $criteriaBars->limit = 5;

        $criteriaLines = new CDbCriteria();
        $criteriaLines->select = array($attributes[0], 'count(*) as count');
        $criteriaLines->order = $attributes[0];
        $criteriaLines->group = $attributes[0];
        if ($this->type == 'lines') {
            foreach ($modelData::model()->findAll($criteriaLines) as $value) {
                $sells[] =
                    array(
                        strtotime($value->$attributes[0]) * 1000,
                        (int)$value->count
                    );
            }
        } else {
            $criteriaBars = new CDbCriteria();
            $criteriaBars->select = "{$attributes[0]}, COUNT(*) as count";
            $criteriaBars->group = "{$attributes[0]}";
            $criteriaBars->order = 'COUNT(*) DESC';
            $criteriaBars->limit = 5;
            foreach ($modelData::model()->findAll($criteriaBars) as $key => $value) {
                $this->ticks[] = array(
                    $value->$attributes[1]->$attributes[2]
                );
                $sells[] = (int)$value->count;
            }
        }
        return $sells;
    }
}