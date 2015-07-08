<?php

/**
 * This is the model class for table "stockname".
 *
 * The followings are the available columns in table 'stockname':
 * @property integer $id
 * @property integer $organisation_id
 * @property integer $commodity_id
 * @property string $prefix
 */
class Stockname extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Stockname the static model class
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
		return 'stockname';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('organisation_id, commodity_id, prefix', 'required'),
			array('organisation_id, commodity_id', 'numerical', 'integerOnly'=>true),
			array('prefix', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, organisation_id, commodity_id, prefix', 'safe', 'on'=>'search'),
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
                    'organisation' => array(self::BELONGS_TO, 'Organisation', 'organisation_id'),
                    'commodity' => array(self::BELONGS_TO, 'Commodity', 'commodity_id'),
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
			'commodity_id' => 'Commodity',
			'prefix' => 'Prefix',
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
		$criteria->compare('commodity_id',$this->commodity_id);
		$criteria->compare('prefix',$this->prefix,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}