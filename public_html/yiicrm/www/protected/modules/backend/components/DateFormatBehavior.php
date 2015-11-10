<?php
/**
 * Created by JetBrains PhpStorm.
 * User: amd1648
 * Date: 23.07.13
 * Time: 14:14
 * To change this template use File | Settings | File Templates.
 */

class DateFormatBehavior extends CActiveRecordBehavior{
    /**
     * @param $date string date to convert
     * @param string $dateFormat string format to convert
     * @return string formatted date
     */
    public static  function  convertDate($date, $dateFormat = 'Y-m-d')
    {
        if(!empty($date)){
            $formattedDate = new DateTime($date);
            return $formattedDate->format($dateFormat);
        }else{
            return false;
        }

    }

    public function afterFind($event)
    {
        /* @var $sender CActiveRecord*/
        foreach($event->sender->tableSchema->columns as $name=>$column)
        {
            if(($column->dbType !='date') and ($column->dbType != 'datetime')){
                continue;
            }
            if(!strlen($event->sender->$name)){
                $event->sender->$name = null;
                continue;
            }
            $event->sender->$name = $this->convertDate($event->sender->$name, Yii::app()->params['appDateFormat']);
        }
        return true;
    }

        public function beforeValidate($event)
        {
            foreach($event->sender->tableSchema->columns as $name=>$column)
            {
                if(($column->dbType !='date') and ($column->dbType != 'datetime')){
                    continue;
                }
                if(!strlen($event->sender->$name)){
                    $event->sender->$name = null;
                    continue;
                }
                $event->sender->$name = $this->convertDate($event->sender->$name, Yii::app()->params['dbDateFormat']);
            }

            return true;

        }



}