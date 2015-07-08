<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property integer $organisation_id
 * @property string $name
 * @property string $password
 * @property string $pw_md5
 * @property string $email
 * @property string $phone
 * @property string $phones
 * @property string $mobile
 * @property string $fn
 * @property string $ln
 * @property integer $active
 * @property integer $id_auth
 * @property string $auth_method
 * @property string $last_login
 * @property string $date_mod
 * @property string $designation
 */
class User extends CActiveRecord
{
        public $g_id;
        public $dept_id;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('organisation_id,name, password, email, phone, mobile, fn, ln,designation', 'required'),
			array('organisation_id,active', 'numerical', 'integerOnly'=>true),
			array('name, password, email,  fn, ln, designation', 'length', 'max'=>50),
			//array('pw_md5', 'length', 'max'=>250),
                        array('email','email'),
                        array('phone', 'match' , 'pattern'=> '/^[0-9]{10}$/',
                                'message'=> 'Phone number should be exactly of 10 digits.'
                        ),
                        array('phones', 'match' , 'pattern'=> '/^[0-9]{10}$/',
                                'message'=> 'Phone number should be exactly of 10 digits.'
                        ),
                        array('mobile', 'match' , 'pattern'=> '/^[0-9]{10}$/',
                                'message'=> 'Mobile number should be exactly of 10 digits.'
                        ),
						array('name','unique', 'message'=>'This user already exists.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, organisation_id,name, password, email, phone, phones, mobile, fn, ln,  active, id_auth, auth_method, last_login, date_mod, designation, g_id,dept_id', 'safe', 'on'=>'search'),
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
			
			'group' => array(self::BELONGS_TO, 'Group', 'g_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'organisation_id' => 'Organisation',
			'name' => 'Username',
			'password' => 'Password',
			'pw_md5' => 'Password Md5',
			'email' => 'Email',
			'phone' => 'Phone 1',
			'phones' => 'Phone 2',
			'mobile' => 'Mobile',
			'fn' => 'First Name',
			'ln' => 'Last Name',
			'active' => 'Active',
			'id_auth' => 'Auth ID',
			'auth_method' => 'Auth Method',
			'last_login' => 'Last Login',
			'date_mod' => 'Date Modified',
			'designation' => 'Designation',
                        'dept_id'=>'Departments'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
                $criteria->compare('organisation_id',$this->organisation_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('pw_md5',$this->pw_md5,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('phones',$this->phones,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('fn',$this->fn,true);
                $criteria->compare('ln',$this->ln,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('id_auth',$this->id_auth);
		$criteria->compare('auth_method',$this->auth_method,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('date_mod',$this->date_mod,true);
		$criteria->compare('designation',$this->designation,true);
                
                $orgId = Yii::app()->user->getState("org_id");
                $criteria->addCondition("organisation_id = $orgId");

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}