<?php

/**
 * This is the model class for table "transfer_file".
 *
 * The followings are the available columns in table 'transfer_file':
 * @property integer $id
 * @property integer $fid
 * @property string $ownedby
 * @property integer $transfer_to
 * @property string $previous_location
 * @property integer $transfer_location
 * @property string $Remark
 * @property string $timestamp
 * @property integer $uid
 * @property string $transfer_date
 */
class TransferFile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransferFile the static model class
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
		return 'transfer_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transfer_to, transfer_location, Remark,transfer_date', 'required'),
			array('fid, transfer_to, transfer_location, uid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fid, ownedby, transfer_to, previous_location, transfer_location, Remark, timestamp, uid, transfer_date', 'safe', 'on'=>'search'),
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
		
			'transfer_to' => 'Handed over To',
			'transfer_location' => 'Location',
			'Remark' => 'Remark',
			
			'transfer_date' => 'Date',
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


		$criteria->compare('transfer_to',$this->transfer_to);
	
		$criteria->compare('transfer_location',$this->transfer_location);
		$criteria->compare('Remark',$this->Remark,true);
	
		$criteria->compare('transfer_date',$this->transfer_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}