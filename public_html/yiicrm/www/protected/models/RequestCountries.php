<?php

/**
 * This is the model class for table "request_countries".
 *
 * The followings are the available columns in table 'request_countries':
 * @property integer $id
 * @property integer $request_id
 * @property integer $country_id
 *
 * The followings are the available model relations:
 * @property Countries $country
 * @property Requests $request
 */
class RequestCountries extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'request_countries';
    }


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('request_id, country_id', 'required'),
            array('request_id, country_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, request_id, country_id', 'safe', 'on' => 'search'),
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
            'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
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
            'country_id' => 'Страна',
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
        $criteria->compare('country_id', $this->country_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RequestCountries the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @var RequestCountries value
     * @param $params array of countries ids
     * @param $model Requests model object
     * @return array
     */
    public static function updating($params, $model)
    {
        $requestCountries = array();
        if (!$model->isNewRecord) {
            foreach ($params as $key => $value) {
                $country = RequestCountries::model()->findByAttributes(
                    array('request_id' => $model->id, 'country_id' => $value)
                );
                if ($country) {
                    $requestCountries[] = $country;
                } else {
                    $newCountry = new RequestCountries();
                    $newCountry->country_id = $value;
                    $requestCountries[] = $newCountry;
                }
            }
            foreach ($model->requestCountries as $value) {
                if (!in_array($value->country_id, $params)) {
                    RequestCountries::model()->findByAttributes(
                        array('request_id' => $model->id, 'country_id' => $value->country_id)
                    )->delete();
                }
            }
        } else {
            foreach ($params as $key => $value) {
                $newCountry = new RequestCountries();
                $newCountry->country_id = $value;
                $requestCountries[] = $newCountry;
            }
        }

        return $requestCountries;
    }
}
