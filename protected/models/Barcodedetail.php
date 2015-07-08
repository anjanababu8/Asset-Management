<?php

/**
 * This is the model class for table "barcodedetail".
 *
 * The followings are the available columns in table 'barcodedetail':
 * @property integer $id
 * @property integer $organisation_id
 * @property integer $bar_width
 * @property integer $bar_height
 * @property string $type
 * @property string $format
 */
class Barcodedetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Barcodedetail the static model class
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
		return 'barcodedetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('organisation_id, bar_width, bar_height, type, format', 'required'),
			array('organisation_id, bar_width, bar_height', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>50),
			array('format', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, organisation_id, bar_width, bar_height, type, format', 'safe', 'on'=>'search'),
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
			'bar_width' => 'Bar Width',
			'bar_height' => 'Bar Height',
			'type' => 'Type',
			'format' => 'Format',
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
		$criteria->compare('bar_width',$this->bar_width);
		$criteria->compare('bar_height',$this->bar_height);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('format',$this->format,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}