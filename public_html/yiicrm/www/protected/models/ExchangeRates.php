<?php

/**
 * This is the model class for table "exchange_rates".
 *
 * The followings are the available columns in table 'exchange_rates':
 * @property integer $id
 * @property string $date
 * @property integer $first_currency_id
 * @property integer $second_currency_id
 * @property integer $rate
 * @property string $date_first
 * @property string $date_last
 *
 * The followings are the available model relations:
 * @property Currency $secondCurrency
 * @property Currency $firstCurrency
 * @property PaymentCustomers[] $paymentCustomers
 *
 */
class ExchangeRates extends CActiveRecord
{
    public $date_first;
    public $date_last;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'exchange_rates';
    }
    public function behaviors()
    {
        return array(
            'dateBehaviors' => array(
                'class' =>'backend.components.DateFormatBehavior'
            )
        );
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('date, first_currency_id, second_currency_id, rate', 'required'),
            array('second_currency_id', 'compare', 'compareAttribute'=> 'first_currency_id','operator' =>'!=', 'message' => 'Поле "{compareAttribute}" не должна совпадать с полем "{attribute}"!'),
            array('first_currency_id', 'compare', 'compareAttribute'=> 'second_currency_id','operator' =>'!=', 'message' => 'Поле "{attribute}" не должна совпадать с полем "{compareAttribute}"!'),
            array('first_currency_id, second_currency_id', 'numerical', 'integerOnly' => true),

            array('rate', 'numerical'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('date_first, date_last, id, date, first_currency_id, second_currency_id, rate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'secondCurrency' => array(self::BELONGS_TO, 'Currency', 'second_currency_id'),
            'firstCurrency' => array(self::BELONGS_TO, 'Currency', 'first_currency_id'),
            'paymentCustomers' => array(self::HAS_MANY, 'PaymentCustomers', 'exchange_rate_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'date' => 'Дата',
            'first_currency_id' => 'Первая валюта',
            'second_currency_id' => 'Вторая валюта',
            'rate' => 'Коэффициент',
            'date_first' => 'С какого числа',
            'date_last' => 'По какое число ',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.
        return new CActiveDataProvider($this, array(
            'criteria' => $this->searchCriteria(
                DateFormatBehavior::convertDate($this->date_first),
                DateFormatBehavior::convertDate($this->date_last)
            ),
            'sort'=>array(
                'attributes'=>array(
                    'firstCurrency.title'=>array(
                        'asc'=>'firstCurrency.title',
                        'desc'=>'firstCurrency.title DESC',
                    ),
                    'secondCurrency.title'=>array(
                        'asc'=>'secondCurrency.title',
                        'desc'=>'secondCurrency.title DESC',
                    ),
                    '*',
                ),
            ),

        ));
    }

    public function searchCriteria($dateFirst, $dateLast)
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('secondCurrency', 'firstCurrency', 'paymentCustomers');
        if (trim($dateFirst) == "" && (trim($dateLast) != "")) {
            $criteria->addCondition("t.date<='" . $dateLast . "'");
        } elseif (trim($dateLast) == "" && trim($dateFirst) != "") {
            $criteria->addCondition("t.date>='" . $dateFirst . "'");
        } elseif (trim($dateFirst) != "" && trim($dateLast) != "") {
            $criteria->addBetweenCondition('t.date', '' . $dateFirst . '', '' . $dateLast . '', 'AND');
        }
        $criteria->compare('first_currency_id', $this->first_currency_id);
        $criteria->compare('second_currency_id', $this->second_currency_id);
        return $criteria;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ExchangeRates the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
