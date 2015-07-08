<?php

/**
 * This is the model class for table "allocate".
 *
 * The followings are the available columns in table 'allocate':
 * @property integer $allocate_id
 * @property integer $commodity_id
 * @property integer $cons_id
 * @property integer $stock_id
 * @property string $stockname
 * @property string $barcode
  * @property string $barcodeFileType
 * @property integer $id
 * @property string $allocate_to
 * @property integer $allocate_to_extend
 * @property string $date_in
 * @property string $date_out
 * @property integer $given_by
 * @property integer $given_to
 * @property string $user_group
 * @property string $purpose
 * @property string $return_on
 * @property string $comments
 */
class Allocate extends CActiveRecord
{
        public $quantity;
        public $available_quantity;
        public $allocate_to;
        public $allocate_to_extend;
        public $semiYes;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Allocate the static model class
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
		return 'allocate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cons_id, stock_id, id,date_in,allocate_to,quantity', 'required','on'=>'update'),
			array('cons_id, stock_id, id, allocate_to_extend, given_by, given_to', 'numerical', 'integerOnly'=>true),
			array('allocate_to', 'length', 'max'=>50),
                        array('stockname', 'length', 'max'=>100),
			array('user_group', 'length', 'max'=>2),
                        //array('semiYes', 'length', 'max'=>3),
			array('date_out, purpose, return_on, comments', 'safe'),
                        array('date_in', 'type',
                            'type' =>'date',
	                    'message' => '{attribute}: is not of the form yyyy-m-d!',
	                    'dateFormat' => 'yyyy-MM-dd'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('allocate_id, cons_id, stock_id, id,stockname, barcode, allocate_to, allocate_to_extend, date_in, date_out, given_by, given_to, user_group, purpose, return_on, comments', 'safe', 'on'=>'search'),
                        array('quantity','checkAvailability','on'=>'update'), 
                        array('date_in , date_out , return_on', 'type',
                            'type' =>'date',
	                    'message' => '{attribute}: is not of the form yyyy-m-d!',
	                    'dateFormat' => 'yyyy-MM-dd'),
                        array('date_out','comparedate','on'=>'update')	,
                        array('semiYes','semiconsumable','on'=>'update'),
			);
        }
        public function comparedate($attribute,$params){
            $currentDate = strtotime(date('Y-M-d'));
            if(strtotime($this->date_out) < $currentDate){
                    $this->addError('date_out','DATE OUT should be a future date');
            }
        }
        
        public function semiconsumable($attribute,$params){
            if($this->semiYes == 'Yes' && $this->return_on == NULL){
                $this->addError('semiYes','RETURN ON cannot be blank');
            }else if($this->semiYes == 'Yes' && $this->return_on != NULL){
                $currentDate = strtotime(date('Y-M-d'));
                if(strtotime($this->return_on) < $currentDate){
                    $this->addError('return_on','RETURN ON date should be a future date');
                }
            }
        }


        public function checkAvailability($attribute,$params){
                if($this->quantity > $this->available_quantity || $this->quantity < 1){
                    $this->addError('quantity','Invalid Number of QUANTITY');
                        
                }
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    //'consumable' => array(self::BELONGS_TO, 'Consumable', 'cons_id'),
                    'user' => array(self::BELONGS_TO, 'User', 'given_by'),
                    'userto' => array(self::BELONGS_TO, 'User', 'given_to'),
                    'group' => array(self::BELONGS_TO, 'Group', 'given_to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'allocate_id' => 'Allocate ID',
			'commodity_id' => 'Commodity',
			'cons_id' => 'Consumable ID',
			'stock_id' => 'Stock ID',
			'id' => 'ID',
                        'stockname' => 'Stockname',
			'barcode' => 'Barcode',
			'allocate_to' => 'Allocate To',
			'allocate_to_extend' => 'Allocate To Extend',
			'date_in' => 'Date In',
			'date_out' => 'Date Out',
			'given_by' => 'Given By',
			'given_to' => 'Given To',
			'user_group' => 'User Group',
			'purpose' => 'Purpose',
			'return_on' => 'Return On',
			'comments' => 'Comments',
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

		$criteria->compare('allocate_id',$this->allocate_id);
		$criteria->compare('commodity_id',$this->commodity_id);
		$criteria->compare('cons_id',$this->cons_id);
		$criteria->compare('stock_id',$this->stock_id);
		$criteria->compare('id',$this->id);
                $criteria->compare('stockname',$this->stockname,true);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('allocate_to',$this->allocate_to,true);
		$criteria->compare('allocate_to_extend',$this->allocate_to_extend);
		$criteria->compare('date_in',$this->date_in,true);
		$criteria->compare('date_out',$this->date_out,true);
		$criteria->compare('given_by',$this->given_by);
		$criteria->compare('given_to',$this->given_to);
		$criteria->compare('user_group',$this->user_group,true);
		$criteria->compare('purpose',$this->purpose,true);
		$criteria->compare('return_on',$this->return_on,true);
		$criteria->compare('comments',$this->comments,true);
                
                $itemId = $_GET['itemId'];
                $criteria->addCondition("cons_id = $itemId AND date_out IS NOT NULL");

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=> Yii::app()->user->getState('pageSize',3),
                              ),
		));
                
	}
        public function searchPrintBarcode()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('allocate_id',$this->allocate_id);
		$criteria->compare('cons_id',$this->cons_id);
		$criteria->compare('stock_id',$this->stock_id);
		$criteria->compare('id',$this->id);
                $criteria->compare('stockname',$this->stockname,true);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('allocate_to',$this->allocate_to,true);
		$criteria->compare('allocate_to_extend',$this->allocate_to_extend);
		$criteria->compare('date_in',$this->date_in,true);
		$criteria->compare('date_out',$this->date_out,true);
		$criteria->compare('given_by',$this->given_by);
		$criteria->compare('given_to',$this->given_to);
		$criteria->compare('user_group',$this->user_group,true);
		$criteria->compare('purpose',$this->purpose,true);
		$criteria->compare('return_on',$this->return_on,true);
		$criteria->compare('comments',$this->comments,true);
                
                $itemId = $_GET['itemId'];
                $criteria->addCondition("cons_id = $itemId");

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false
		));
                
	}
}