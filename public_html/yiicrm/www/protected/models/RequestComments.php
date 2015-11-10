<?php

/**
 * This is the model class for table "request_comments".
 *
 * The followings are the available columns in table 'request_comments':
 * @property integer $id
 * @property integer $request_id
 * @property integer $user_id
 * @property string $date
 * @property string $comment
 * @property integer $order_id
 *
 * The followings are the available model relations:
 * @property Orders $order
 * @property Users $user
 * @property Requests $request
 */
class RequestComments extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'request_comments';
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
            array('user_id, date, comment', 'required'),
            array('request_id, user_id, order_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, request_id, user_id, date, comment, order_id', 'safe', 'on' => 'search'),
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
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'request' => array(self::BELONGS_TO, 'Requests', 'request_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'request_id' => 'Заявка',
            'user_id' => 'Менеджер',
            'date' => 'Дата',
            'comment' => 'Комментарий',
            'order_id' => 'Заказ'
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
        $criteria->compare('request_id', $this->request_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('order_id', $this->orders_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RequestComments the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
