<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property integer $role_id
 *
 * The followings are the available model relations:
 * @property Orders[] $orders
 * @property RequestComments[] $requestComments
 * @property Requests[] $requests
 * @property Attachments $image
 * @property UserWidgets[] $widgets
 */
class Users extends CActiveRecord
{
    public function getWidgets()
    {
        return $this->widgets;
    }
    public $newPassword;
    public $passwordRepeat;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('login, first_name, last_name, email, role_id', 'required'),
            array('role_id', 'numerical', 'integerOnly' => true),
            array('email', 'email'),
            array('login, first_name, last_name, email', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('login, first_name, last_name, email, role_id', 'safe', 'on' => 'search'),
            array('newPassword, passwordRepeat', 'safe'),
            array('newPassword, passwordRepeat', 'required', 'on' => 'register, update'),
            array('passwordRepeat', 'compare', 'compareAttribute'=> 'newPassword', 'operator' =>'=','message' => 'Пароли не совпадают'),
            array('image', 'file',
                'types'=>'jpeg,jpg,png',
                'maxSize'=>2048 * 2048 * 2,
                'tooLarge'=>'The file was larger than 1MB. Please upload a smaller file.',
                'allowEmpty'=>1,
            )
        );
    }
    public function behaviors()
    {
        return array(
            'attachments' => array(
                'class'=>'backend.components.AttachmentsBehavior',
                'attributeName' => 'image',
                'relationName' => 'image',
                'singleAttachment' => true
            ),

        );
    }

    /**
     * @return bool
     */
    protected function beforeSave()
    {
        $this->password = crypt($this->newPassword, Yii::app()->params['salt']);
        return parent::beforeSave();
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'orders' => array(self::HAS_MANY, 'Orders', 'user_id'),
            'requestComments' => array(self::HAS_MANY, 'RequestComments', 'user_id'),
            'requests' => array(self::HAS_MANY, 'Requests', 'user_id'),
            'image' => array(self::HAS_ONE, 'Attachments', 'owner', 'condition' => 'type="'.get_class($this).'"'),
            'widgets' => array(self::HAS_MANY, 'UserWidgets', 'user_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'newPassword' => 'Пароль',
            'passwordRepeat' => 'Подтверждение пароля',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'Email адрес',
            'role_id' => 'Роль',
            'image' => 'Аватар'
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
        $criteria->compare('login', $this->login, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('role_id', $this->role_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getRole(){
        switch ($this->role_id){
            case 1:
                return "Менеджер";
            case 2:
                return "Администратор";
            default:
                return "Гость";
        }

    }
}
