<?php

/**
 * This is the model class for table "transfer_cons".
 *
 * The followings are the available columns in table 'transfer_cons':
 * @property integer $id
 * @property integer $commodity_id
 * @property integer $consumable_id
 * @property integer $belongs_to
 * @property integer $transfer_to
 */
class TransferCons extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransferCons the static model class
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
		return 'transfer_cons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('consumable_id, transfer_to', 'required'),
			array('consumable_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, consumable_id, belongs_to, transfer_to', 'safe', 'on'=>'search'),
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
                    'consumable' => array(self::BELONGS_TO, 'Consumable', 'consumable_id'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'commodity_id' => 'Commodity',
			'consumable_id' => 'Consumable',
			'belongs_to' => 'Belongs To',
			'transfer_to' => 'Transfer To',
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
		$criteria->compare('commodity_id',$this->commodity_id);
		$criteria->compare('consumable_id',$this->consumable_id);
		$criteria->compare('belongs_to',$this->belongs_to);
		$criteria->compare('transfer_to',$this->transfer_to,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}