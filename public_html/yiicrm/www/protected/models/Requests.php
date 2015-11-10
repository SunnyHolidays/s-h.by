<?php

/**
 * This is the model class for table "requests".
 *
 * The followings are the available columns in table 'requests':
 * @property integer $id
 * @property string $date
 * @property string $date_departure
 * @property string $date_return
 * @property string $duration
 * @property integer $adults
 * @property string $children
 * @property array $child_age
 * @property integer $budget
 * @property integer $category
 * @property string $params
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property integer $user_id
 * @property integer $status
 * @property string $comment
 * @property string $date_next_step
 * @property string $description_next_step
 * @property string $source
 * @property integer $pension_type
 *
 * The followings are the available model relations:
 * @property RequestAirports[] $requestAirports
 * @property RequestComments[] $requestComments
 * @property RequestCountries[] $countries$requestCountries
 * @property Orders $orders
 * @property Users $user
 */
class Requests extends CActiveRecord
{
    public $count;
    public $requests_search;
    public $date_first;
    public $date_last;



    const STATUS_NONE = 0;
    const STATUS_CONSIDERATION = 1;
    const STATUS_CONFIRMED = 2;
    const STATUS_MADE = 3;

    private $statusLabels = array(
        self::STATUS_NONE => 'Без статуса',
        self::STATUS_CONSIDERATION => 'На рассмотрении',
        self::STATUS_CONFIRMED => 'Подтвержден',
        self::STATUS_MADE => 'Выполнено',
    );

    public function getStatus($status = null)
    {
        if(isset($status)){
            return $this->statusLabels[$status];
        }else return $this->statusLabels;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'requests';
    }

    public function behaviors()
    {
        return array(
            'dateBehaviors' => array(
                'class' =>'backend.components.DateFormatBehavior'
            )
        );
    }

    public function setRequestsAirports($data)
    {
        $this->requestAirports = $data;
    }

    public function setRequestCountries($data)
    {
        $this->requestCountries = $data;
    }


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'first_name, last_name, requestAirports, requestCountries, email, phone, date_departure, date_return, duration, adults, budget, category',
                'required'
            ),
            array('requestAirports, requestCountries', 'type', 'type' => 'array', 'allowEmpty' => false),
            array('date_departure,date_return', 'date', 'format' => 'yyyy-MM-dd'),
            array('adults, user_id, status', 'numerical', 'integerOnly' => true),
            array('email', 'email'),
            array('child_age', 'validateAge', 'on' => 'create, update'),
            array('children, first_name, last_name, email, source, phone', 'length', 'max' => 255),
            array(
                'date_departure, date, date_return, params, comment, date_next_step, description_next_step, pension_type',
                'safe'
            ),
            array('params', 'implodeParams'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'pension_type,date_first,date_last,requests_search, id, date, date_departure, date_return, duration, adults, children, child_age, budget, category, params, first_name, last_name, email, phone, user_id, status, comment, date_next_step, description_next_step, source',
                'safe',
                'on' => 'search'
            ),
        );
    }

    public function implodeParams($attribute)
    {
        if(is_array($this->$attribute)) {
            $this->$attribute = implode(',', $this->$attribute);
        }
    }

    public function validateAge($attribute, $params)
    {
        if (!empty($this->children)) {
            foreach ($this->attributes[$attribute] as $key => $value) {
                if ($value <= 0 or $value > 17) {
                    $this->addError($attribute, 'Возраст ребёнка не должен превышать 17 лет.');
                }
            }
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'requestAirports' => array(self::HAS_MANY, 'RequestAirports', 'request_id'),
            'requestComments' => array(self::HAS_MANY, 'RequestComments', 'request_id'),
            'requestCountries' => array(self::HAS_MANY, 'RequestCountries', 'request_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'orders' => array(self::HAS_MANY, 'Orders', 'request_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'date_departure' => 'Заезд',
            'date_return' => 'Выезд',
            'duration' => 'Продолжительность',
            'adults' => 'Взрослых',
            'children' => 'Детей',
            'child_age' => 'Возраст детей',
            'budget' => 'Бюджет',
            'category' => 'Категория',
            'params' => 'Параметры',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'E-mail адрес',
            'phone' => 'Телефон',
            'user_id' => 'Менеджер',
            'status' => 'Статус',
            'comment' => 'Комментарий',
            'date_next_step' => 'Дата следующего шага',
            'description_next_step' => 'Описание следующего шага',
            'source' => 'Источник',
            'requestAirports' => 'Выезд/вылет из',
            'requestCountries' => 'Страна(курорт)',
            'pension_type' => 'Питание',
            'date' => 'Дата',
            'search' => 'Поиск',
            'date_first' => 'С какого числа',
            'date_last' => 'По какое число '
        );
    }

    /**
     * @return bool|void
     */
    protected function afterSave()
    {
        parent::afterSave();
        foreach ($this->requestAirports as $airport) {
            if ($airport->isNewRecord) {
                $airport->request_id = $this->id;
            }
            if ($airport->validate()) {
                $airport->save();
            }
        }
        foreach ($this->requestCountries as $country) {
            if ($country->isNewRecord) {
                $country->request_id = $this->id;
            }
            if ($country->validate()) {
                $country->save();
            }
        }
        return true;
    }

    protected function beforeSave()
    {
        parent::afterSave();
        if (is_array($this->params)) {
            $this->params = implode(',', $this->params);
        }
        if ($this->children == 0) {
            $this->child_age = null;
        } elseif (is_array($this->child_age)) {
            $this->child_age = implode(';', $this->child_age);
        }
        return true;
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
                $this->requests_search,
                DateFormatBehavior::convertDate($this->date_first),
                DateFormatBehavior::convertDate($this->date_last),
                $this->user_id,
                $this->status
            ),
            'sort'=>array(
                'attributes'=>array(
                    'clients'=>array(
                        'asc'=>'t.first_name',
                        'desc'=>'t.first_name DESC',
                    ),
                    'user'=>array(
                        'asc'=>'user.last_name',
                        'desc'=>'user.last_name DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }

    public function searchCriteria($searchString, $dateFirst, $dateLast, $userID, $status)
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('user');
        $attr = array(
            'category',
            't.first_name',
            't.last_name',
            't.email',
            'phone',
            'description_next_step',
            'source',
            'user.last_name',
        );

        if ($searchString != '') {
            foreach ($attr as $val) {
                $criteria->compare($val, $searchString, true, 'OR');
            }
        }

        if (trim($dateFirst) == "" && (trim($dateLast) != "")) {
            $criteria->addCondition("date<='" . $dateLast . "'");
        } elseif (trim($dateLast) == "" && (trim($dateFirst)) != "") {
            $criteria->addCondition("date>='" . $dateFirst . "'");
        } elseif (trim($dateFirst) != "" && trim($dateLast) != "") {
            $criteria->addBetweenCondition('date', '' . $dateFirst . '', '' . $dateLast . '', 'AND');
        }

        if($userID != 'null'){
            $criteria->compare('user_id', $userID);
        }else{
            $criteria->addCondition('user_id IS NULL');
        }

        $criteria->compare('status', $status);

        return $criteria;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Requests the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
