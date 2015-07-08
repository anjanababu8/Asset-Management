<?php

/**
 * This is the model class for table "currency".
 *
 * The followings are the available columns in table 'currency':
 * @property integer $id
 * @property string $name
 * @property string $symbol
 * @property string $filename
 * @property string $filetype
 */
class Currency extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Currency the static model class
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
		return 'currency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, symbol', 'required'),
			array('name, filename, filetype', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, symbol, filename, filetype', 'safe', 'on'=>'search'),
			array('symbol', 'file', 
                            'types'=>'jpg, gif, png, bmp, jpeg',
                            'maxSize'=>1024 * 1024 * 10, // 10MB
                            
                            'tooLarge'=>'The file was larger than 10MB. Please upload a smaller file.',
                            'allowEmpty' => true
                             ),
			array('name','unique', 'message'=>'This currency already exists.'),
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
			'symbol' => 'Symbol',
			//'filename' => 'Filename',
			//'filetype' => 'Filetype',
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
		$criteria->compare('symbol',$this->symbol,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('filetype',$this->filetype,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}