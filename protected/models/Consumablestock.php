<?php

/**
 * This is the model class for table "consumablestock".
 *
 * The followings are the available columns in table 'consumablestock':
 * @property integer $id
 * @property integer $commodity_id
 * @property integer $consumable_id
 * @property integer $po_number
 * @property double $unit_cost
 * @property integer $quantity
 * @property integer $supplier_id
 * @property string $warranty
 * @property string $date_in
 * @property string $expiry_date
 * @property integer $inventory_no
 * @property integer $status_id
 * @property string $document
 * @property string $documentFileName
 * @property string $documentFileType
 */
class Consumablestock extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Consumablestock the static model class
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
		return 'consumablestock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('consumable_id, po_number, unit_cost, quantity, supplier_id, warranty, date_in, expiry_date, inventory_no, status_id', 'required'),
			array('consumable_id, po_number, quantity, supplier_id, inventory_no, status_id', 'numerical', 'integerOnly'=>true),
			array('unit_cost', 'numerical'),
			array('documentFileName', 'length', 'max'=>100),
			array('documentFileType', 'length', 'max'=>50),

			array('document', 'file', 
    		'types'=>'pdf,txt,docx',
            'maxSize'=>1024 * 1024 * 10, // 10MB
            'tooLarge'=>'The file was larger than 10MB. Please upload a smaller file.',
            'allowEmpty' => true
         ),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, consumable_id, po_number, unit_cost, quantity, supplier_id, warranty, date_in, expiry_date, inventory_no, status_id, document, documentFileName, documentFileType', 'safe', 'on'=>'search'),
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
                    'supplier' => array(self::BELONGS_TO, 'Supplier', 'supplier_id'),
                    'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
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
			'po_number' => 'Po Number',
			'unit_cost' => 'Unit Cost',
			'quantity' => 'Quantity',
			'supplier_id' => 'Supplier',
			'warranty' => 'Warranty',
			'date_in' => 'Date In',
			'expiry_date' => 'Expiry Date',
			'inventory_no' => 'Inventory No',
			'status_id' => 'Status',
			'document' => 'Document',
			'documentFileName' => 'Document File Name',
			'documentFileType' => 'Document File Type',
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
		$criteria->compare('po_number',$this->po_number);
		$criteria->compare('unit_cost',$this->unit_cost);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('supplier_id',$this->supplier_id);
		$criteria->compare('warranty',$this->warranty,true);
		$criteria->compare('date_in',$this->date_in,true);
		$criteria->compare('expiry_date',$this->expiry_date,true);
		$criteria->compare('inventory_no',$this->inventory_no);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('documentFileName',$this->documentFileName,true);
		$criteria->compare('documentFileType',$this->documentFileType,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}