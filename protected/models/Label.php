<?php

/**
 * This is the model class for table "label".
 *
 * The followings are the available columns in table 'label':
 * @property integer $id
 * @property strings $fields
 * @property integer $fid
 * @property integer $size
 */
class Label extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Label the static model class
	 */
    
         /** For Print All Form**/
        public $paper;
        public $fileType;
        public $depts;
        public $fileNames;
        public $fileDetails;
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'label';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fields,size', 'required'),
			array(' fid, size', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fields, fid, size', 'safe', 'on'=>'search'),
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
			
			'fields' => 'Fields',
			'depts'=>'Department',
			'size' => 'Size',
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

	
		$criteria->compare('fields',$this->fields,true);
	
		$criteria->compare('size',$this->size);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}