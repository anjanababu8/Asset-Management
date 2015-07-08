<?php

/**
 * This is the model class for table "printer_cart".
 *
 * The followings are the available columns in table 'printer_cart':
 * @property integer $id
 * @property integer $printer_id
 * @property integer $cartridge_id
 */
class PrinterCart extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PrinterCart the static model class
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
		return 'printer_cart';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('printer_id, cartridge_id', 'required'),
			array('printer_id, cartridge_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, printer_id, cartridge_id', 'safe', 'on'=>'search'),
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
		'printer' => array(self::BELONGS_TO, 'Printers', 'printer_id'),
        'cartridge' => array(self::BELONGS_TO, 'Cartridge', 'cartridge_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'printer_id' => 'Printer',
			'cartridge_id' => 'Cartridge',
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
		$criteria->compare('printer_id',$this->printer_id);
		$criteria->compare('cartridge_id',$this->cartridge_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}