<?php

/**
 * This is the model class for table "consumable".
 *
 * The followings are the available columns in table 'consumable':
 * @property integer $id
 * @property integer $commodity_id
 * @property string $category_id
 * @property string $name
 * @property integer $location_id
 * @property integer $technical_incharge_id
 * @property integer $status_id
 * @property integer $manufacturer_id
 * @property integer $consumable_type_id
 * @property integer $management_type_id
 * @property integer $model
 * @property integer $threshold
 * @property string $image
 * @property string $imageFileName
 * @property string $imageFileType
 * @property string $document
 * @property string $documentFileName
 * @property string $documentFileType
 * @property string $enable_financial
 * @property string $available_on_loan
 * @property string $semi_consumable
 * @property integer $is_deleted
 */
class Consumable extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Consumable the static model class
	 */
         public $prefix;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'consumable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id,name, location_id, technical_incharge_id, status_id, manufacturer_id, consumable_type_id, management_type_id, model, threshold', 'required'),
			array('location_id, technical_incharge_id, status_id, manufacturer_id, consumable_type_id, management_type_id, model, threshold,link_to', 'numerical', 'integerOnly'=>true),
			array('name, imageFileType, documentFileType', 'length', 'max'=>50),
			array('imageFileName, documentFileName', 'length', 'max'=>100),
			array('enable_financial, available_on_loan, semi_consumable', 'length', 'max'=>5),

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
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, location_id, technical_incharge_id, status_id, manufacturer_id, consumable_type_id, management_type_id, model, threshold, image, imageFileName, imageFileType, document, documentFileName, documentFileType,link_to', 'safe', 'on'=>'search'),
                        array('name','unique', 'message'=>'This consumable already exists.'),
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
			'consumabletype' => array(self::BELONGS_TO, 'Consumabletype', 'consumable_type_id'),
			'managementtype' => array(self::BELONGS_TO, 'Managementtype', 'management_type_id'),
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
			'category_id' => 'Category',
                        'link_to' => 'Link To',
			'name' => 'Name',
			'location_id' => 'Location',
			'technical_incharge_id' => 'Technical Incharge',
			'status_id' => 'Status',
			'manufacturer_id' => 'Manufacturer',
			'consumable_type_id' => 'Consumable Type',
			'management_type_id' => 'Management Type',
			'model' => 'Model',
			'threshold' => 'Threshold',
			'image' => 'Image',
			//'imageFileName' => 'Image File Name',
			//'imageFileType' => 'Image File Type',
			'document' => 'Document',
			//'documentFileName' => 'Document File Name',
			//'documentFileType' => 'Document File Type',
			'enable_financial' => 'Enable Financial',
			'available_on_loan' => 'Available On Loan',
			'semi_consumable' => 'Semi Consumable',
                        
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

                /*Get the user's group*/
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

            $criteria->compare('id',$this->id);
            $criteria->compare('commodity_id',$this->commodity_id);
            $criteria->compare('category_id',$this->category_id,true);
            $criteria->compare('link_to',$this->link_to);
            $criteria->compare('name',$this->name,true);
            $criteria->compare('location_id',$this->location_id);
            $criteria->compare('technical_incharge_id',$this->technical_incharge_id);
            $criteria->compare('status_id',$this->status_id);
            $criteria->compare('manufacturer_id',$this->manufacturer_id);
            $criteria->compare('consumable_type_id',$this->consumable_type_id);
            $criteria->compare('management_type_id',$this->management_type_id);
            $criteria->compare('model',$this->model);
            $criteria->compare('threshold',$this->threshold);
            $criteria->compare('image',$this->image,true);
            $criteria->compare('imageFileName',$this->imageFileName,true);
            $criteria->compare('imageFileType',$this->imageFileType,true);
            $criteria->compare('document',$this->document,true);
            $criteria->compare('documentFileName',$this->documentFileName,true);
            $criteria->compare('documentFileType',$this->documentFileType,true);
            $criteria->compare('enable_financial',$this->enable_financial,true);
            $criteria->compare('available_on_loan',$this->available_on_loan,true);
            $criteria->compare('semi_consumable',$this->semi_consumable,true);
            $criteria->compare('is_deleted',$this->is_deleted);
            $criteria->addCondition("is_deleted = 0");

            $criteria->addNotInCondition('id',$blockeditemtableIds);

            if(isset($_GET['category_id'])){
                $a = $_GET['category_id'];
                $criteria->addCondition("category_id = '$a'");
            }

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                            'pageSize'=> Yii::app()->user->getState('pageSize',5),
                          ),
            ));
             
	}
        public function search2()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

                /*Get the user's group*/
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

		$criteria->compare('id',$this->id);
                $criteria->compare('commodity_id',$this->commodity_id);
		$criteria->compare('category_id',$this->category_id,true);
                $criteria->compare('link_to',$this->link_to);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('technical_incharge_id',$this->technical_incharge_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('manufacturer_id',$this->manufacturer_id);
		$criteria->compare('consumable_type_id',$this->consumable_type_id);
		$criteria->compare('management_type_id',$this->management_type_id);
		$criteria->compare('model',$this->model);
		$criteria->compare('threshold',$this->threshold);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('imageFileName',$this->imageFileName,true);
		$criteria->compare('imageFileType',$this->imageFileType,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('documentFileName',$this->documentFileName,true);
		$criteria->compare('documentFileType',$this->documentFileType,true);
		$criteria->compare('enable_financial',$this->enable_financial,true);
		$criteria->compare('available_on_loan',$this->available_on_loan,true);
		$criteria->compare('semi_consumable',$this->semi_consumable,true);
                $criteria->compare('is_deleted',$this->is_deleted);
                $criteria->addCondition("is_deleted = 0");
                
                $criteria->addNotInCondition('id',$blockeditemtableIds);
                
                if(isset($_GET['category_id'])){
                    $a = $_GET['category_id'];
                    $criteria->addCondition("category_id = '$a'");
                }
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false
		));
             
	}
}