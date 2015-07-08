<?php

/**
 * This is the model class for table "FORMS".
 *
 * The followings are the available columns in table 'FORMS':
 * @property integer $FORM_ID
 * @property string $TABLE_NAME
 * @property string $FORM_NAME
 * @property string $BEGIN_DATE
 * @property string $END_DATE
 * @property integer $TYPE_ID
 * @property string $CREATED_BY
 * @property string $LAST_MODIFIED_BY
 * @property string $CREATED_DATE
 * @property string $LAST_MODIFIED_DATE
 */
class Form extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Form the static model class
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
		return 'FORMS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('FORM_NAME,TYPE_ID', 'required'),
			array('TYPE_ID', 'numerical', 'integerOnly'=>true),
			array('TABLE_NAME, FORM_NAME', 'length', 'max'=>128),
			array('CREATED_BY, LAST_MODIFIED_BY', 'length', 'max'=>255),
			array('BEGIN_DATE, END_DATE, CREATED_DATE, LAST_MODIFIED_DATE', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FORM_ID, TABLE_NAME, FORM_NAME, BEGIN_DATE, END_DATE, TYPE_ID, CREATED_BY, LAST_MODIFIED_BY, CREATED_DATE, LAST_MODIFIED_DATE', 'safe', 'on'=>'search'),
			//Tracking
			array('LAST_MODIFIED_DATE','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'update'),
			array('CREATED_DATE','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'insert'),
			array('LAST_MODIFIED_BY','default','value'=>Yii::app()->user->id,'setOnEmpty'=>false,'on'=>'update'),
			array('CREATED_BY','default','value'=>Yii::app()->user->id,'setOnEmpty'=>false,'on'=>'insert'),
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
                    'commodity' => array(self::BELONGS_TO, 'Commodity', 'TYPE_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FORM_ID' => 'Form',
			'TABLE_NAME' => 'Table Name',
			'FORM_NAME' => 'Template Name',
			'BEGIN_DATE' => 'Begin Date',
			'END_DATE' => 'End Date',
			'TYPE_ID' => 'Commodity',
			'CREATED_BY' => 'Created By',
			'LAST_MODIFIED_BY' => 'Last Modified By',
			'CREATED_DATE' => 'Created Date',
			'LAST_MODIFIED_DATE' => 'Last Modified Date',
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

		$criteria->compare('FORM_ID',$this->FORM_ID);
		$criteria->compare('TABLE_NAME',$this->TABLE_NAME,true);
		$criteria->compare('FORM_NAME',$this->FORM_NAME,true);
		$criteria->compare('BEGIN_DATE',$this->BEGIN_DATE,true);
		$criteria->compare('END_DATE',$this->END_DATE,true);
		$criteria->compare('TYPE_ID',$this->TYPE_ID);
		$criteria->compare('CREATED_BY',$this->CREATED_BY,true);
		$criteria->compare('LAST_MODIFIED_BY',$this->LAST_MODIFIED_BY,true);
		$criteria->compare('CREATED_DATE',$this->CREATED_DATE,true);
		$criteria->compare('LAST_MODIFIED_DATE',$this->LAST_MODIFIED_DATE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	static public function range($str,$fieldValue=NULL) {
		$rules = explode(';',$str);
		$array = array();
		for ($i=0;$i<count($rules);$i++) {
			$item = explode("==",$rules[$i]);
			if (isset($item[0])) $array[$item[0]] = ((isset($item[1]))?$item[1]:$item[0]);
		}
		if (isset($fieldValue)) 
			if (isset($array[$fieldValue])) return $array[$fieldValue]; else return '';
		else
			return $array;
	}
}