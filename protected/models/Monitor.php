<?php

/**
 * This is the model class for table "monitor".
 *
 * The followings are the available columns in table 'monitor':
 * @property integer $id
 * @property integer $commodity_id
  * @property string $category_id
 * @property string $name
 * @property integer $location_id
 * @property integer $technical_incharge_id
 * @property double $size
 * @property integer $status_id
 * @property integer $monitor_type_id
 * @property integer $manufacturer_id
 * @property integer $serial_number
 * @property integer $management_type_id
 * @property string $comments
 * @property string $document
 * @property string $documentFileName
 * @property string $documentFileType
 * @property string $image
 * @property string $imageFileName
 * @property string $imageFileType
 * @property integer $enable_financial
 * @property integer $available_on_loan
 * @property integer $has_microphone
 * @property integer $has_speaker
 * @property integer $has_subD
 * @property integer $has_BNC
 * @property integer $has_DVI
 * @property integer $has_pivot
 * @property integer $has_HDMI
 * @property integer $has_displayport
 */
class Monitor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Monitor the static model class
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
		return 'monitor';
	}
	
	public function formName()
	{
		return 'monitor-form';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id,name, location_id, technical_incharge_id, size, status_id, monitor_type_id, manufacturer_id, serial_number, management_type_id', 'required'),
			array('location_id, technical_incharge_id, status_id, monitor_type_id, manufacturer_id, serial_number, management_type_id, enable_financial, available_on_loan,link_to', 'numerical', 'integerOnly'=>true),
			array('size', 'numerical'),
			array('name, documentFileType, imageFileType', 'length', 'max'=>50),
			array('documentFileName, imageFileName', 'length', 'max'=>100),
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
			array('id, name, location_id, technical_incharge_id, size, status_id, monitor_type_id, manufacturer_id, serial_number, management_type_id, comments, document, documentFileName, documentFileType, image, imageFileName, imageFileType, enable_financial, available_on_loan,link_to', 'safe', 'on'=>'search'),
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
			'monitortype' => array(self::BELONGS_TO, 'Consumabletype', 'monitor_type_id'),
			'managementtype' => array(self::BELONGS_TO, 'Managementtype', 'management_type_id'),
	
		);
	}

	   

   
	
	public function load($data, $formName = null)
    {
        $scope = $formName === null ? $this->formName() : $formName;
        if ($scope === '' && !empty($data)) {
            $this->attributes=$data;
            return true;
        } elseif (isset($data[$scope])) {
            $this->attributes=$data[$scope];
            return true;
        } else {
            return false;
        }
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
			'name' => 'Name',
			'location_id' => 'Location',
			'technical_incharge_id' => 'Technical Incharge',
			'size' => 'Size',
			'status_id' => 'Status',
			'monitor_type_id' => 'Monitor Type',
			'manufacturer_id' => 'Manufacturer',
			'serial_number' => 'Serial Number',
			'management_type_id' => 'Management Type',
			'comments' => 'Comments',
			'document' => 'Document',
			//'documentFileName' => 'Document File Name',
			//'documentFileType' => 'Document File Type',
			'image' => 'Image',
			//'imageFileName' => 'Image File Name',
			//'imageFileType' => 'Image File Type',
			'enable_financial' => 'Enable Financial',
			'available_on_loan' => 'Available On Loan',
                        'has_microphone' => 'Microphone',
			'has_speaker' => 'Speaker',
			'has_subD' => 'Sub-D',
			'has_BNC' => 'BNC',
			'has_DVI' => 'DVI',
			'has_pivot' => 'Pivot',
			'has_HDMI' => 'HDMI',
			'has_displayport' => 'Displayport',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('commodity_id',$this->commodity_id);
		$criteria->compare('category_id',$this->category_id,true);
                $criteria->compare('link_to',$this->link_to);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('technical_incharge_id',$this->technical_incharge_id);
		$criteria->compare('size',$this->size);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('monitor_type_id',$this->monitor_type_id);
		$criteria->compare('manufacturer_id',$this->manufacturer_id);
		$criteria->compare('serial_number',$this->serial_number);
		$criteria->compare('management_type_id',$this->management_type_id);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('documentFileName',$this->documentFileName,true);
		$criteria->compare('documentFileType',$this->documentFileType,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('imageFileName',$this->imageFileName,true);
		$criteria->compare('imageFileType',$this->imageFileType,true);
		$criteria->compare('enable_financial',$this->enable_financial,true);
		$criteria->compare('available_on_loan',$this->available_on_loan,true);
		$criteria->compare('has_microphone',$this->has_microphone,true);
		$criteria->compare('has_speaker',$this->has_speaker,true);
		$criteria->compare('has_subD',$this->has_subD,true);
		$criteria->compare('has_BNC',$this->has_BNC,true);
		$criteria->compare('has_DVI',$this->has_DVI,true);
		$criteria->compare('has_pivot',$this->has_pivot,true);
		$criteria->compare('has_HDMI',$this->has_HDMI,true);
		$criteria->compare('has_displayport',$this->has_displayport,true);
		$criteria->compare('is_deleted',$this->is_deleted);
                $criteria->addCondition("is_deleted = 0");

		$criteria->addNotInCondition('id',$blockeditemtableIds);
                
                if(isset($_GET['category_id'])){
                    $a = $_GET['category_id'];
                    $criteria->addCondition("category_id = '$a'");
                }
                
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array('pageSize'=> Yii::app()->user->getState('pageSize',5)),
		));
	}
        public function search2()
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

		$criteria->compare('id',$this->id);
		$criteria->compare('commodity_id',$this->commodity_id);
		$criteria->compare('category_id',$this->category_id,true);
                $criteria->compare('link_to',$this->link_to);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('technical_incharge_id',$this->technical_incharge_id);
		$criteria->compare('size',$this->size);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('monitor_type_id',$this->monitor_type_id);
		$criteria->compare('manufacturer_id',$this->manufacturer_id);
		$criteria->compare('serial_number',$this->serial_number);
		$criteria->compare('management_type_id',$this->management_type_id);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('documentFileName',$this->documentFileName,true);
		$criteria->compare('documentFileType',$this->documentFileType,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('imageFileName',$this->imageFileName,true);
		$criteria->compare('imageFileType',$this->imageFileType,true);
		$criteria->compare('enable_financial',$this->enable_financial,true);
		$criteria->compare('available_on_loan',$this->available_on_loan,true);
		$criteria->compare('has_microphone',$this->has_microphone,true);
		$criteria->compare('has_speaker',$this->has_speaker,true);
		$criteria->compare('has_subD',$this->has_subD,true);
		$criteria->compare('has_BNC',$this->has_BNC,true);
		$criteria->compare('has_DVI',$this->has_DVI,true);
		$criteria->compare('has_pivot',$this->has_pivot,true);
		$criteria->compare('has_HDMI',$this->has_HDMI,true);
		$criteria->compare('has_displayport',$this->has_displayport,true);
		$criteria->compare('is_deleted',$this->is_deleted);
                $criteria->addCondition("is_deleted = 0");

		$criteria->addNotInCondition('id',$blockeditemtableIds);
                
                if(isset($_GET['category_id'])){
                    $a = $_GET['category_id'];
                    $criteria->addCondition("category_id = '$a'");
                }
                
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false,
		));
	}
	

}