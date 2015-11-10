<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property integer $price
 * @property integer $commission
 * @property double $travel_service_fee
 * @property double $subcommission
 * @property double $discount
 * @property double $amount_paid
 * @property integer $currency_id
 * @property integer $user_id
 * @property string $room_type
 * @property integer $request_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $email
 * @property integer $phone
 * @property integer $tour_type_id
 * @property string $mobile_phone
 * @property string $address
 * @property integer $package_tour_id
 * @property integer $discount_currency_id
 * @property integer $travel_service_fee_currency_id
 * @property string $city
 * @property string $index
 * @property string $company
 * @property integer $sub_agent_id
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property PackageTour $packageTour
 * @property Currency $currency
 * @property Currency $travelServiceFeeCurrency
 * @property Subagent $subagent
 * @property TourOperators $tourOperator
 * @property Participants[] $participants
 * @property PaymentCustomers[] $paymentCustomers
 * @property PaymentOperators[] $paymentOperators
 * @property Requests $request
 * @property Attachments[] attachments
 */
class Orders extends CActiveRecord
{
    public $count;
    public $orders_search;
    public $date_first;
    public $date_last;
    public $newAttach;
    public $tour_type = array(
       1=>'Пакетный тур',
    );

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'orders';
    }

    public function behaviors()
    {
        return array(
            'dateBehaviors' => array(
                'class' =>'backend.components.DateFormatBehavior'
            ),
            'attachmentsBehavior' => array(
                'class' => 'backend.components.AttachmentsBehavior',
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
            array('price,tour_type_id, commission, travel_service_fee, amount_paid, currency_id, first_name, last_name, email,package_tour_id, travel_service_fee_currency_id','required'),
            array('price,tour_type_id,discount_currency_id, commission, currency_id, user_id, phone,package_tour_id, travel_service_fee_currency_id, sub_agent_id','numerical','integerOnly' => true),
            array('room_type, first_name, middle_name, last_name, mobile_phone, email, address, city, index, company', 'length', 'max'=>255),
            array('travel_service_fee, commission, subcommission, discount, amount_paid, price', 'numerical','min'=>0),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'date_first,discount_currency_id, date_last, orders_search, price, commission, travel_service_fee, subcommission, discount, amount_paid, currency_id,
                user_id, first_name, middle_name, last_name, email, phone, mobile_phone, address, package_tour_id,
                 travel_service_fee_currency_id, city, index, company,tour_type_id, sub_agent_id',
                'safe',
                'on' => 'search'
            ),
            array('email','email'),
            array('newAttach', 'file',
                'types'=>'txt,doc,docx,xls,xlsx,odt,pdf,jpg,jpeg,png',
                'maxSize'=>1024 * 1024 * 1, // 1MB
                'tooLarge'=>'The file was larger than 1MB. Please upload a smaller file.',
                'allowEmpty'=>1,
            )
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
            'subagent' => array(self::BELONGS_TO, 'Subagent', 'sub_agent_id'),
            'packageTour' => array(self::BELONGS_TO, 'PackageTour', 'package_tour_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
            'travelServiceFeeCurrency' => array(self::BELONGS_TO, 'Currency', 'travel_service_fee_currency_id'),
            'request' => array(self::BELONGS_TO, 'Requests', 'request_id'),
            'participants' => array(self::HAS_MANY, 'Participants', 'order_id'),
            'paymentCustomers' => array(self::HAS_MANY, 'PaymentCustomers', 'order_id'),
            'paymentOperators' => array(self::HAS_MANY, 'PaymentOperators', 'order_id'),
            'attachments' => array(self::HAS_MANY, 'Attachments', 'owner', 'condition' => 'attachments.type="'.get_class($this).'"')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'price' => 'Стоимость тура',
            'commission' => 'Комиссия',
            'travel_service_fee' => 'Тур. услуга',
            'subcommission' => 'Субкомиссия',
            'discount' => 'Скидка',
            'amount_paid' => 'К оплате',
            'currency_id' => 'Валюта',
            'user_id' => 'Менеджер',
            'search' => 'Поиск',
            'date_first' => 'С какого числа',
            'date_last' => 'По какое число ',
            'room_type' => 'Тип номера',
            'first_name' => 'Имя',
            'middle_name' => 'Отчество',
            'last_name' => 'Фамилия',
            'email' => 'Email',
            'phone' => 'Телефон',
            'mobile_phone' => 'Моб. телефон',
            'address' => 'Адрес',
            'tour_type_id' => 'Тип',
            'travel_service_fee_currency_id_id' => 'Валюта',
            'city' => 'Город',
            'index' => 'Индекс',
            'company' => 'Компания',
            'sub_agent_id' => 'Субагент',
            'discount_currency_id' => 'Валюта скидки',
            'attachments' => 'Прикреплённые файлы',
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
                $this->orders_search,
                DateFormatBehavior::convertDate($this->date_first),
                DateFormatBehavior::convertDate($this->date_last),
                $this->user_id
            ),
            'sort'=>array(
                'attributes'=>array(
                    'currency.title'=>array(
                        'asc'=>'currency.title',
                        'desc'=>'currency.title DESC',
                    ),
                    'participant'=>array(
                        'asc'=>'t.last_name',
                        'desc'=>'t.last_name DESC',
                    ),
                    'user'=>array(
                        'asc'=>'user.last_name',
                        'desc'=>'user.last_name DESC',
                    ),
                    'country'=>array(
                        'asc'=>'country.title',
                        'desc'=>'country.title DESC',
                    ),
                    'airport'=>array(
                        'asc'=>'airport.title',
                        'desc'=>'airport.title DESC',
                    ),
                    'hotel'=>array(
                        'asc'=>'hotel.title',
                        'desc'=>'hotel.title DESC',
                    ),
                    'region'=>array(
                        'asc'=>'region.title',
                        'desc'=>'region.title DESC',
                    ),
                    'tourOperator'=>array(
                        'asc'=>'tourOperator.title',
                        'desc'=>'tourOperator.title DESC',
                    ),
                    'date'=>array(
                        'asc'=>'packageTour.date',
                        'desc'=>'packageTour.date DESC',
                    ),
                    'subagent'=>array(
                        'asc'=>'subagent.title',
                        'desc'=>'subagent.title DESC'
                    ),
                    '*',
                ),
            ),
        ));
    }

    public function searchCriteria($searchString, $dateFirst, $dateLast, $userID)
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('packageTour'=>array('with'=>array('country','airport','hotel','region','tourOperator')),'user', 'subagent', 'currency');
        $attr = array(
            'price',
            'commission',
            'tourOperator.title',
            'country.title',
            'airport.title',
            'hotel.title',
            'region.title',
            't.last_name',
            't.middle_name',
            't.first_name',
            'phone',
            'mobile_phone',
            't.email',
            't.address',
            'user.last_name',
            'currency.title',
            't.city',
            't.discount',
            'subagent.title'
        );

        if ($searchString != '') {
            foreach ($attr as $val) {
                $criteria->compare($val, $searchString, true, 'OR');
            }
        }

        if (trim($dateFirst) == "" && (trim($dateLast) != "")) {
            $criteria->addCondition("packageTour.date<='" . $dateLast . "'");
        } elseif (trim($dateLast) == "" && (trim($dateFirst)) != "") {
            $criteria->addCondition("packageTour.date>='" . $dateFirst . "'");
        } elseif (trim($dateFirst) != "" && trim($dateLast) != "") {
            $criteria->addBetweenCondition('packageTour.date', '' . $dateFirst . '', '' . $dateLast . '', 'AND');
        }

        if($userID != 'null'){
            $criteria->compare('user_id', $userID);
        }else{
            $criteria->addCondition('user_id IS NULL');
        }
        return $criteria;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Orders the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
