<?php

/**
 * This is the model class for table "report".
 *
 * The followings are the available columns in table 'report':
 * @property integer $rid
 * @property string $name
 * @property integer $uid
 * @property string $timestamp
 * @property string $description
 * @property string $query
 */
class Reportloc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Report the static model class
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
		return 'reportloc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,description', 'required'),
			array('uid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rid, name, uid, timestamp, description, query', 'safe', 'on'=>'search'),
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
			'rid' => 'Rid',
			'name' => 'Name',
			'uid' => 'Uid',
			'timestamp' => 'Timestamp',
			'description' => 'Description',
			
			'query' => 'Query',
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

		$criteria->compare('rid',$this->rid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('timestamp',$this->timestamp,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('query',$this->query,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
		
        
        public function beforeSave(){
	
		$this->timestamp=new CDbExpression('NOW()');
		$this->uid=Yii::app()->user->getState("user_id");
		
		return parent::beforeSave();
	
	}
        
      public function after_save()
      {
          
      }
}