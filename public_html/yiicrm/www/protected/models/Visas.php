<?php

/**
 * This is the model class for table "visas".
 *
 * The followings are the available columns in table 'visas':
 * @property integer $id
 * @property integer $participant_id
 * @property integer $type
 * @property integer $fee
 * @property integer $amount
 * @property integer $status
 * @property string $date_next_step
 * @property string $description_next_step
 * @property string $comment
 * *
 * The followings are the available model relations:
 * @property Participants $participant
 */
class Visas extends CActiveRecord
{
    const TYPE_NONE = 0;
    const TYPE_TOURIST = 1;
    const TYPE_SHORT = 2;
    const TYPE_LONG = 3;
    const TYPE_GUEST = 4;
    const TYPE_BUSINESS = 5;
    const TYPE_MULTI = 6;
    const TYPE_STUDENT = 7;
    const TYPE_WORKING = 8;
    const TYPE_TRANSIT = 9;

    public $typeLabels = array(
        self::TYPE_NONE => 'Без визы',
        self::TYPE_TOURIST => 'Туристическая',
        self::TYPE_SHORT => 'Короткосрочная',
        self::TYPE_LONG => 'Долгосрочная',
        self::TYPE_GUEST => 'Гостевая',
        self::TYPE_BUSINESS => 'Бизнесс',
        self::TYPE_MULTI => 'Мультивиза(многосрочная)',
        self::TYPE_STUDENT => 'Студенческая',
        self::TYPE_WORKING => 'Рабочая',
        self::TYPE_TRANSIT => 'Транзитная',
    );

    public function getType($type = null)
    {
        if(isset($type)){
            return $this->typeLabels[$type];
        }else return $this->typeLabels;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'visas';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('participant_id, type', 'required'),
            array('participant_id, type, fee, amount, status', 'numerical', 'integerOnly' => true),
            array('date_next_step, description_next_step, comment', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, participant_id, type, fee, amount, status, date_next_step, description_next_step, comment',
                'safe',
                'on' => 'search'
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
            'participant' => array(self::BELONGS_TO, 'Participants', 'participant_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'participant_id' => 'Участник',
            'type' => 'Тип визы',
            'fee' => 'Плата',
            'amount' => 'Сумма',
            'status' => 'Статус',
            'date_next_step' => 'Дата следующего шага',
            'description_next_step' => 'Описание следующего шага',
            'comment' => 'Комметарий',
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
    public function search($orderID = null)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('participant');

        $criteria->compare('id', $this->id);
        $criteria->compare('participant.order_id', $orderID);
        $criteria->compare('type', $this->type);
        $criteria->compare('fee', $this->fee);
        $criteria->compare('amount', $this->amount);
        $criteria->compare('status', $this->status);
        $criteria->compare('date_next_step', $this->date_next_step, true);
        $criteria->compare('description_next_step', $this->description_next_step, true);
        $criteria->compare('comment', $this->comment, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes'=>array(
                    'participant.first_name'=>array(
                        'asc'=>'participant.first_name',
                        'desc'=>'participant.first_name DESC',
                    ),'*'
                )
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Visas the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
