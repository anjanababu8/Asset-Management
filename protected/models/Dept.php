<?php

/**
 * This is the model class for table "dept".
 *
 * The followings are the available columns in table 'dept':
 * @property integer $id
 * @property integer $orgid
 * @property string $name
 * @property string $description
 * @property string $abbr
 * @property string $timestamp
 */
class Dept extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Dept the static model class
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
		return 'dept';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orgid, name, description, abbr', 'required'),
			array('orgid', 'numerical', 'integerOnly'=>true),
			array('name, abbr', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, orgid, name, description, abbr, timestamp', 'safe', 'on'=>'search'),
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
                    'organisation' => array(self::BELONGS_TO, 'Organisation', 'orgid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'orgid' => 'Orgid',
			'name' => 'Name',
			'description' => 'Description',
			'abbr' => 'Abbrevation',
			'timestamp' => 'Timestamp',
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
		$criteria->compare('orgid',$this->orgid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('timestamp',$this->timestamp,true);

                
                $orgId = Yii::app()->user->getState("org_id");
                $criteria->addCondition("orgid = $orgId");
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function beforeSave(){
	
		$this->timestamp=new CDbExpression('NOW()');
		return parent::beforeSave();
	
	}
}