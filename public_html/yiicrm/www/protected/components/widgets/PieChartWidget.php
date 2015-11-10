<?php

/**
 * Class PieChartWidget
 */
class PieChartWidget extends CWidget
{
    /**
     * @var CActiveRecord model object. Needs to get info, that used in chart
     */
    public $modelData;
    /**
     * @var array Two attributes
     */
    public $dataAttribute;
    /**
     * @var string widget header
     */
    public $widgetHeader = 'Диаграмма';

    public $relation;
    public $header;

    /**
     * run widget method
     */
    public function run()
    {
        $data = null;
        if (!empty($this->modelData) or !empty($this->modelHeader)) {
            $data = $this->getChartInfo($this->modelData, $this->dataAttribute, $this->relation, $this->header);
        }
        $this->id = $this->dataAttribute.'_'.$this->modelData;

        $this->render(
            'pieChartView',
            array(
                'data' => $data,
                'header' => $this->widgetHeader
            )
        );
    }

    /**
     * @param $modelData CActiveRecord
     * @param $dataAttribute
     * @param $headerAttribute
     * @param $relationName
     * @return array
     */
    private function getChartInfo($modelData, $dataAttribute, $relationName, $headerAttribute)
    {
        $sells = array();
        $criteria = new CDbCriteria();
        $criteria->group = $dataAttribute;
        $criteria->select = array("count($dataAttribute) as count");
        $criteria->addCondition("{$dataAttribute} is not null");
        $criteria->with = $relationName;
        foreach ($modelData::model()->findAll($criteria) as $key => $value) {
            $sells[] = array($value->$relationName->$headerAttribute, (int)$value->count);
        }
        return $sells;
    }
}