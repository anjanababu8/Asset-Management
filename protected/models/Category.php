<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $name
 * @property string $descr
 * @property integer $pid
 *
 * The followings are the available model relations:
 * @property Category $p
 * @property Category[] $categories
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, descr,pid', 'required'),
			array('pid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, descr, pid', 'safe', 'on'=>'search'),
			array('name','unique', 'message'=>'This category already exists.'),
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
			//'p' => array(self::BELONGS_TO, 'Category', 'pid'),
			//'categories' => array(self::HAS_MANY, 'Category', 'id'),
			//'Childs' => array(self::HAS_MANY, 'Category', 'pid'),
			'getparent' => array(self::BELONGS_TO, 'Category', 'pid'),
			'childs' => array(self::HAS_MANY, 'Category', 'pid'),
                         
		);
	}
	//tree view
	public function getListed() {
    $subitems = array();
    if($this->childs) foreach($this->childs as $child) {
        $subitems[] = $child->getListed();
    }
    $returnarray = array('label' => $this->name, 'url' => array('Category/view', 'id' => $this->id));
    if($subitems != array()) 
        $returnarray = array_merge($returnarray, array('items' => $subitems));
    return $returnarray;
}
	
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'descr' => 'Description',
			'pid' => 'Pid',
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
		$criteria->compare('descr',$this->descr,true);
		$criteria->compare('pid',$this->pid);
                $criteria->compare('is_deleted',$this->is_deleted);
                $criteria->addCondition("is_deleted = 0");
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}