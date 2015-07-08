<?php

/**
 * This is the model class for table "blockeditem".
 *
 * The followings are the available columns in table 'blockeditem':
 * @property integer $id
 * @property integer $commodity_id
 * @property integer $item_id
 * @property integer $blocked_by
 * @property string $blocked_on
 * @property string $blocked_from
 * @property string $blocked_to
 * @property integer $unblock_by
 * @property string $unblock_on
 * @property integer $blocked_for
 * @property string $flag
 */
class Blockeditem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Blockeditem the static model class
	 */
        public $block_group;
        public $block_user;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'blockeditem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('commodity_id, item_id, blocked_by, blocked_on, blocked_from, blocked_to', 'required'),
			array('commodity_id, item_id, blocked_by, unblock_by, blocked_for', 'numerical', 'integerOnly'=>true),
			array('flag', 'length', 'max'=>1),
			array('unblock_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, commodity_id, item_id, blocked_by, blocked_on, blocked_from, blocked_to, unblock_by, unblock_on, blocked_for, flag', 'safe', 'on'=>'search'),
                        array('blocked_from, blocked_to', 'date', 'format' => 'yyyy-MM-dd'),  
                        array('blocked_from','comparedate'));
	}

        public function comparedate($attribute,$params){
                if(strtotime($this->blocked_from) > strtotime($this->blocked_to)){
                        $this->addError('blocked_from','BLOCK FROM date should come before BLOCK TO date.');
                }
                $currentDate = strtotime(date('Y-M-d'));
                if(strtotime($this->blocked_from) < $currentDate){
                        $this->addError('blocked_from','BLOCK FROM date should be a future date');
                }
                if(strtotime($this->blocked_to) < $currentDate){
                        $this->addError('blocked_to','BLOCK TO date should be a future date');
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
                    'commodity' => array(self::BELONGS_TO, 'Commodity', 'commodity_id'),
                    'consumable' => array(self::BELONGS_TO, 'Consumable', 'item_id'),
                    'userby' => array(self::BELONGS_TO, 'User', 'blocked_by'),
                    'user' => array(self::BELONGS_TO, 'User', 'blocked_for'),
                    'group' => array(self::BELONGS_TO, 'Group', 'blocked_for'),
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
			'item_id' => 'Item',
			'blocked_by' => 'Blocked By',
			'blocked_on' => 'Blocked On',
			'blocked_from' => 'Blocked From',
			'blocked_to' => 'Blocked To',
			'unblock_by' => 'Unblock By',
			'unblock_on' => 'Unblock On',
			'blocked_for' => 'Blocked For',
			'flag' => 'Flag',
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

                $commodityId = $_GET['commodityId'];
                
                $consumables = MyUtility::getNotDeleted('consumable',$commodityId);    
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('commodity_id',$this->commodity_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('blocked_by',$this->blocked_by);
		$criteria->compare('blocked_on',$this->blocked_on,true);
		$criteria->compare('blocked_from',$this->blocked_from,true);
		$criteria->compare('blocked_to',$this->blocked_to,true);
		$criteria->compare('unblock_by',$this->unblock_by);
		$criteria->compare('unblock_on',$this->unblock_on,true);
		$criteria->compare('blocked_for',$this->blocked_for);
		$criteria->compare('flag',$this->flag,true);

                $criteria->addCondition("unblock_by IS NULL");
                
                $criteria->addCondition("commodity_id = $commodityId");
                $criteria->addInCondition('item_id',$consumables);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}