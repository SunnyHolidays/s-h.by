<?php

/**
 * This is the model class for table "payment_operators".
 *
 * The followings are the available columns in table 'payment_operators':
 * @property integer $id
 * @property string $date
 * @property integer $amount_due
 * @property string $date_payment
 * @property integer $amount_paid
 * @property integer $order_id
 *
 * The followings are the available model relations:
 * @property Orders $order
 */
class PaymentOperators extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'payment_operators';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('date, amount_due, amount_paid, order_id', 'required'),
            array('amount_due, amount_paid, order_id', 'numerical', 'integerOnly' => true),
            array('date_payment', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, date, amount_due, date_payment, amount_paid, order_id', 'safe', 'on' => 'search'),
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
            'amount_due' => 'Сумма долга',
            'date_payment' => 'Дата выплаты',
            'amount_paid' => 'Выплачиваемая сумма',
            'order_id' => 'Заказ',
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
        $criteria->compare('date', $this->date, true);
        $criteria->compare('amount_due', $this->amount_due);
        $criteria->compare('date_payment', $this->date_payment, true);
        $criteria->compare('amount_paid', $this->amount_paid);
        $criteria->compare('order_id', $this->order_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PaymentOperators the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
