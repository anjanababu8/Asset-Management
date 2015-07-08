<?php

/**
 * This is the model class for table "manufacturer".
 *
 * The followings are the available columns in table 'manufacturer':
 * @property integer $id
 * @property string $name
 * @property string $add1
 * @property string $add2
 * @property string $emailid
 * @property string $mobile
 * @property string $pan
 * @property string $tin
 */
class Manufacturer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Manufacturer the static model class
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
		return 'manufacturer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, add1, add2, emailid, mobile, pan, tin', 'required'),
			array('name, emailid', 'length', 'max'=>50),
			array('id, name, add1, add2, emailid, mobile, pan, tin', 'safe', 'on'=>'search'),
                        array('emailid', 'email'),
                        array('mobile', 'match' , 'pattern'=> '/^[0-9]{10}$/',
                                'message'=> 'Mobile number should be exactly of 10 digits.'
                        ),
                        array('pan', 'match' , 'pattern'=> '/^[A-Za-z0-9]{10}$/',
                                'message'=> 'PAN number should be exactly 10 alphanumeric characters.'
                        ),
						array('name','unique', 'message'=>'This manufacturer already exists.'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'add1' => 'Address 1',
			'add2' => 'Address 2',
			'emailid' => 'Email',
			'mobile' => 'Mobile',
			'pan' => 'Pan Number',
			'tin' => 'Tin Number',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('add1',$this->add1,true);
		$criteria->compare('add2',$this->add2,true);
		$criteria->compare('emailid',$this->emailid,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('pan',$this->pan,true);
		$criteria->compare('tin',$this->tin,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}