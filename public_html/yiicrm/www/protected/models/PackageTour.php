<?php

/**
 * This is the model class for table "package_tour".
 *
 * The followings are the available columns in table 'package_tour':
 * @property integer $id
 * @property integer $number
 * @property integer $tour_operator_id
 * @property string $date
 * @property string $date_departure
 * @property string $date_return
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $hotel_id
 * @property integer $airport_id
 * @property integer $pension_type
 *
 * The followings are the available model relations:
 * @property Orders $order
 * @property Airports $airport
 * @property Countries $country
 * @property Hotels $hotel
 * @property TourOperators $tourOperator
 * @property Regions $region
 */
class PackageTour extends CActiveRecord
{
    public $count;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'package_tour';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, tour_operator_id, date, date_departure, date_return, country_id, region_id, hotel_id, airport_id', 'required'),
			array('number, tour_operator_id,pension_type, country_id, region_id, airport_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
            array(
                'id, number,pension_type, tour_operator_id, date, date_departure, date_return, country_id, region_id, hotel_id, airport_id',
                'safe',
                'on' => 'search'
            ),
		);
	}

    public function behaviors()
    {
        return array(
            'dateBehaviors' => array(
                'class' =>'backend.components.DateFormatBehavior'
            ),
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
			'order' => array(self::HAS_ONE, 'Orders', 'package_tour_id'),
			'airport' => array(self::BELONGS_TO, 'Airports', 'airport_id'),
			'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
			'hotel' => array(self::BELONGS_TO, 'Hotels', 'hotel_id'),
			'tourOperator' => array(self::BELONGS_TO, 'TourOperators', 'tour_operator_id'),
			'region' => array(self::BELONGS_TO, 'Regions', 'region_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'number' => 'Номер',
            'tour_operator_id' => 'Туроператор',
            'date' => 'Дата',
            'date_departure' => 'Дата вылета',
            'date_return' => 'Дата прилета',
            'country_id' => 'Страна',
            'region_id' => 'Курорт',
            'hotel_id' => 'Отель',
            'airport_id' => 'Вылет из',
            'pension_type'=>'Тип питания',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('number',$this->number);
		$criteria->compare('tour_operator_id',$this->tour_operator_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('date_departure',$this->date_departure,true);
		$criteria->compare('date_return',$this->date_return,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('hotel_id',$this->hotel_id);
		$criteria->compare('airport_id',$this->airport_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PackageTour the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
