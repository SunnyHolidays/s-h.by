<?php

/**
 * This is the model class for table "participants".
 *
 * The followings are the available columns in table 'participants':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthday
 * @property integer $order_id
 * @property string $passport_number
 * @property string $date_of_issue
 * @property string $date_of_expiry
 * @property string $nationality
 *
 * The followings are the available model relations:
 * @property Orders $order
 * @property Visas $visas
 */
class Participants extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'participants';
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
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('first_name, last_name', 'required'),
            array('order_id', 'numerical', 'integerOnly' => true),
            array('first_name, last_name, passport_number, nationality', 'length', 'max' => 255),
            /*array('email', 'email'),*/
            array('birthday, date_of_issue, date_of_expiry', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, first_name, last_name,  birthday, order_id, passport_number, date_of_issue, date_of_expiry, nationality',
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
            'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
            'visas' => array(self::HAS_MANY, 'Visas', 'participant_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'birthday' => 'Дата рождения',
            'order_id' => 'Order',
            'passport_number' => 'Номер паспорта',
            'date_of_issue' => 'Дата выдачи',
            'date_of_expiry' => 'Дата истечения',
            'nationality' => 'Национальность',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('birthday', $this->birthday, true);
        $criteria->compare('order_id', $this->order_id);
        $criteria->compare('passport_number',$this->passport_number,true);
        $criteria->compare('date_of_issue',$this->date_of_issue,true);
        $criteria->compare('date_of_expiry',$this->date_of_expiry,true);
        $criteria->compare('nationality',$this->nationality,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Participants the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
