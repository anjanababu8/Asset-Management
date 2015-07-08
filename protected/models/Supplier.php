<?php

/**
 * This is the model class for table "supplier".
 *
 * The followings are the available columns in table 'supplier':
 * @property integer $id
 * @property string $name
 * @property integer $suppliertype_id
 * @property string $add1
 * @property string $add2
 * @property integer $pincode
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $website
 * @property string $phone_no
 * @property string $comment
 * @property integer $is_deleted
 * @property integer $tax
 * @property string $email
 * @property string $document
 * @property string $documentFileName
 * @property string $documentFileType
 * @property string $visiting_card
 * @property string $vcardFileName
 * @property string $vcardFileType
 */
class Supplier extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Supplier the static model class
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
		return 'supplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, suppliertype_id, add1, add2, pincode, city, state, country, website, phone_no, comment, tax, email', 'required'),
			array('suppliertype_id, pincode, is_deleted, tax', 'numerical', 'integerOnly'=>true),
			array('name, city, state, country, website, email, documentFileType, vcardFileType', 'length', 'max'=>50),
			array('documentFileName, vcardFileName', 'length', 'max'=>100),
			array('document', 'file', 
                                'types'=>'pdf,txt,docx',
                                'maxSize'=>1024 * 1024 * 10, // 10MB
                                'tooLarge'=>'The file was larger than 10MB. Please upload a smaller file.',
                                'allowEmpty' => true
                                ),
			array('visiting_card', 'file', 
                                'types'=>'jpeg,png,jpg',
                                'maxSize'=>1024 * 1024 * 10, // 10MB
                                'tooLarge'=>'The file was larger than 10MB. Please upload a smaller file.',
                                'allowEmpty' => true
                                ),
                        array('email','email'),
                        array('pincode', 'match' , 'pattern'=> '/^[0-9]{6}$/',
                                'message'=> 'Pincode should be exactly of 6 digits.'
                        ),
						 array('phone_no', 'match' , 'pattern'=> '/^[0-9]{10}$/',
                                'message'=> 'Phone number should be exactly of 10 digits.'
                        ),
						 array('website', 'match' , 'pattern'=> '/^(http:\/\/|https:\/\/)?(www.)?([a-zA-Z0-9]+).[a-zA-Z0-9]*.[a-z]{3}.?([a-z]+)?$/',
                                'message'=> 'website should be like of www.example.com'
                        ),
						array('name','unique', 'message'=>'This supplier already exists.'),
			array('id, name, suppliertype_id, add1, add2, pincode, city, state, country, website, phone_no, comment, is_deleted, tax, email, document, documentFileName, documentFileType, visiting_card, vcardFileName, vcardFileType', 'safe', 'on'=>'search'),
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
        	'suppliertype' => array(self::BELONGS_TO, 'Suppliertype', 'suppliertype_id'),
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
			'suppliertype_id' => 'Supplier Type',
			'add1' => 'Address 1',
			'add2' => 'Address 2',
			'pincode' => 'Pincode',
			'city' => 'City',
			'state' => 'State',
			'country' => 'Country',
			'website' => 'Website',
			'phone_no' => 'Phone No.',
			'comment' => 'Comment',
			'is_deleted' => 'Is Deleted',
			'tax' => 'Tax',
			'email' => 'Email',
			'document' => 'Document',
			'documentFileName' => 'Document File Name',
			'documentFileType' => 'Document File Type',
			'visiting_card' => 'Visiting Card',
			'vcardFileName' => 'Vcard File Name',
			'vcardFileType' => 'Vcard File Type',
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
		$criteria->compare('suppliertype_id',$this->suppliertype_id);
		$criteria->compare('add1',$this->add1,true);
		$criteria->compare('add2',$this->add2,true);
		$criteria->compare('pincode',$this->pincode);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('phone_no',$this->phone_no,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('tax',$this->tax);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('documentFileName',$this->documentFileName,true);
		$criteria->compare('documentFileType',$this->documentFileType,true);
		$criteria->compare('visiting_card',$this->visiting_card,true);
		$criteria->compare('vcardFileName',$this->vcardFileName,true);
		$criteria->compare('vcardFileType',$this->vcardFileType,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}