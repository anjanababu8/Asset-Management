<?php

/**
 * This is the model class for table "TYPES".
 *
 * The followings are the available columns in table 'TYPES':
 * @property integer $TYPE_ID
 * @property string $TYPE_LABEL
 * @property string $CREATED_BY
 * @property string $LAST_MODIFIED_BY
 * @property string $CREATED_DATE
 * @property string $LAST_MODIFIED_DATE
 */
class Type extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Type the static model class
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
		return 'TYPES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TYPE_LABEL, CREATED_BY, LAST_MODIFIED_BY', 'length', 'max'=>255),
			array('CREATED_DATE, LAST_MODIFIED_DATE', 'safe'),
			array('TYPE_LABEL', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TYPE_ID, TYPE_LABEL, CREATED_BY, LAST_MODIFIED_BY, CREATED_DATE, LAST_MODIFIED_DATE', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TYPE_ID' => 'Type',
			'TYPE_LABEL' => 'Type Label',
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

		$criteria->compare('TYPE_ID',$this->TYPE_ID);
		$criteria->compare('TYPE_LABEL',$this->TYPE_LABEL,true);
		$criteria->compare('CREATED_BY',$this->CREATED_BY,true);
		$criteria->compare('LAST_MODIFIED_BY',$this->LAST_MODIFIED_BY,true);
		$criteria->compare('CREATED_DATE',$this->CREATED_DATE,true);
		$criteria->compare('LAST_MODIFIED_DATE',$this->LAST_MODIFIED_DATE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}