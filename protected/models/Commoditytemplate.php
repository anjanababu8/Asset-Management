<?php

/**
 * This is the model class for table "commoditytemplate".
 *
 * The followings are the available columns in table 'commoditytemplate':
 * @property integer $id
 * @property integer $commodity_id
 * @property integer $template_id
 *
 * The followings are the available model relations:
 * @property Commodity $commodity
 * @property Template $template
 */
class Commoditytemplate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Commoditytemplate the static model class
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
		return 'commoditytemplate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('commodity_id, template_id', 'required'),
			array('commodity_id, template_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, commodity_id, template_id', 'safe', 'on'=>'search'),
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
			'commodity' => array(self::BELONGS_TO, 'Commodity', 'commodity_id'),
			'template' => array(self::BELONGS_TO, 'Template', 'template_id'),
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
			'template_id' => 'Template',
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
		$criteria->compare('template_id',$this->template_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}