<?php

/**
 * This is the model class for table "cartridge".
 *
 * The followings are the available columns in table 'cartridge':
 * @property integer $id
 * @property integer $commodity_id
 * @property string $category_id
 * @property string $name
 * @property integer $location_id
 * @property integer $technical_incharge_id
 * @property integer $status_id
 * @property integer $manufacturer_id
 * @property integer $cartridge_type_id
 * @property integer $management_type_id
 * @property integer $threshold
 * @property integer $link_to
 * @property string $image
 * @property string $imageFileName
 * @property string $imageFileType
 * @property string $document
 * @property string $documentFileName
 * @property string $documentFileType
 * @property integer $is_deleted
 */
class Cartridge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cartridge the static model class
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
		return 'cartridge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' category_id, name, location_id, technical_incharge_id, status_id, manufacturer_id, cartridge_type_id, management_type_id, threshold', 'required'),
			array('commodity_id, location_id, technical_incharge_id, status_id, manufacturer_id, cartridge_type_id, management_type_id, threshold, link_to, is_deleted', 'numerical', 'integerOnly'=>true),
			array('name, imageFileType, documentFileType', 'length', 'max'=>50),
			array('imageFileName, documentFileName', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			
			array('image', 'file', 
                            'types'=>'jpg, gif, png, bmp, jpeg',
                            'maxSize'=>1024 * 1024 * 10, // 10MB
                            'tooLarge'=>'The file was larger than 10MB. Please upload a smaller file.',
                            'allowEmpty' => true
                            ),
			array('document', 'file', 
                                'types'=>'pdf,txt,docx',
                                'maxSize'=>1024 * 1024 * 10, // 10MB
                                'tooLarge'=>'The file was larger than 10MB. Please upload a smaller file.',
                                'allowEmpty' => true
                                ),
			array('id, commodity_id, category_id, name, location_id, technical_incharge_id, status_id, manufacturer_id, cartridge_type_id, management_type_id, threshold, link_to, image, imageFileName, imageFileType, document, documentFileName, documentFileType, is_deleted', 'safe', 'on'=>'search'),
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
                       //'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'location' => array(self::BELONGS_TO, 'Location', 'location_id'),
			'user' => array(self::BELONGS_TO, 'User', 'technical_incharge_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
			'manufacturer' => array(self::BELONGS_TO, 'Manufacturer', 'manufacturer_id'),
			'cartridgetype' => array(self::BELONGS_TO, 'Consumabletype', 'cartridge_type_id'),
			'managementtype' => array(self::BELONGS_TO, 'Managementtype', 'management_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			
			'category_id' => 'Category',
			'name' => 'Name',
			'location_id' => 'Location',
			'technical_incharge_id' => 'Technical Incharge',
			'status_id' => 'Status',
			'manufacturer_id' => 'Manufacturer',
			'cartridge_type_id' => 'Cartridge Type',
			'management_type_id' => 'Management Type',
			'threshold' => 'Threshold',
			'link_to' => 'Link To',
			'image' => 'Image',
			//'imageFileName' => 'Image File Name',
			//'imageFileType' => 'Image File Type',
			'document' => 'Document',
			//'documentFileName' => 'Document File Name',
			//'documentFileType' => 'Document File Type',
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
		$ugRows = Usergroup::model()->findAll('uid=:uid',array(':uid'=>Yii::app()->user->getState("user_id")));
        $grps = [];
        foreach($ugRows as $ug){
            $grps[] = $ug['gid'];
        }

        /*Get Blocked Item  Ids*/
        $getRows = Blockeditem::model()->findAllByAttributes(array('blocked_for'=>Yii::app()->user->getState("user_id"),'flag'=>'U','unblock_by'=>NULL));
        $biU = [];
        foreach($getRows as $row){
            $biU[] = $row['item_id'];
        }
        $getRows = Blockeditem::model()->findAllByAttributes(array('blocked_for'=>$grps,'flag'=>'G','unblock_by'=>NULL));
        $biG = [];
        foreach($getRows as $row){
            $biG[] = $row['item_id'];
        }
        ////////////Blocked For All
        $getRows = Blockeditem::model()->findAllByAttributes(array('flag'=>'A','unblock_by'=>NULL));
        $biA = [];
        foreach($getRows as $row){
            $biA[] = $row['item_id'];
        }
        $blockeditemtableIds =  array_merge($biU, $biG);
        $blockeditemtableIds =  array_unique(array_merge($blockeditemtableIds, $biA));
		
		$criteria=new CDbCriteria;

		
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('technical_incharge_id',$this->technical_incharge_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('manufacturer_id',$this->manufacturer_id);
		$criteria->compare('cartridge_type_id',$this->cartridge_type_id);
		$criteria->compare('management_type_id',$this->management_type_id);
		$criteria->compare('threshold',$this->threshold);
		$criteria->compare('link_to',$this->link_to);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('imageFileName',$this->imageFileName,true);
		$criteria->compare('imageFileType',$this->imageFileType,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('documentFileName',$this->documentFileName,true);
		$criteria->compare('documentFileType',$this->documentFileType,true);
		$criteria->compare('is_deleted',$this->is_deleted);
                $criteria->addCondition("is_deleted = 0");
                
                $criteria->addNotInCondition('id',$blockeditemtableIds);
                if(isset($_GET['printerId'])){
                    $printerId = $_GET['printerId'];
                    $criteria->addCondition("link_to = $printerId");
                }    
                if(isset($_GET['category_id'])){
                    $a = $_GET['category_id'];
                    $criteria->addCondition("category_id = '$a'");
                }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array('pageSize'=> Yii::app()->user->getState('pageSize',3)),
		));
	}
}