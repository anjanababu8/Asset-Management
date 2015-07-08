<?php

/**
 * This is the model class for table "commodity".
 *
 * The followings are the available columns in table 'commodity':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $organisation_id
 * @property string $categories
 * @property string $categoryname
 * @property integer $is_deleted
 */
class Commodity extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Commodity the static model class
	 */
        
        public $category_names;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'commodity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, organisation_id, categories', 'required'),
			array('organisation_id, is_deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, organisation_id, categories', 'safe', 'on'=>'search'),
                        array('name', 'match' , 'pattern'=> '/^[A-Za-z]([A-Za-z0-9_])*$/',
                                'message'=> 'COMMODITY NAME should start with a letter and contain only alphanumeric characters and _'
                        ),
						array('name','unique', 'message'=>'This commodity already exists.'),
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
			'name' => 'Name',
			'description' => 'Description',
			'organisation_id' => 'Organisation ID',
			'categories' => 'Categories',
                        //'categoryname' => 'Category Names',
                        'is_deleted' => 'Is Deleted',
			
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('organisation_id',$this->organisation_id);
		$criteria->compare('categories',$this->categories,true);
		//$criteria->compare('path',$this->path,true);
                //$criteria->compare('categoryname',$this->categoryname,true);
                $criteria->compare('is_deleted',$this->is_deleted);
                $criteria->addCondition("is_deleted = 0");
                
                $orgId = Yii::app()->user->getState("org_id");
                $criteria->addCondition("organisation_id = $orgId");
                

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}