<?php

/**
 * This is the model class for table "usergroup".
 *
 * The followings are the available columns in table 'usergroup':
 * @property integer $id
 * @property integer $uid
 * @property integer $gid
 */
class Usergroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usergroup the static model class
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
		return 'usergroup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('uid, gid', 'required'),
			//array('uid, gid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('id, uid, gid', 'safe', 'on'=>'search'),
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
                    'user' => array(self::BELONGS_TO, 'User', 'uid'),
                    'group' => array(self::BELONGS_TO, 'Group', 'gid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'gid' => 'Gid',
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('gid',$this->gid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
	 * @param int $country_id
	 * @return array for listbuilder (id => name)
	 */
	public function findUsersByGroup($gid)
	{
                return CHtml::listData(Usergroup::model()->findAll('gid = :gid',array(':gid' => $gid)),'uid','user.name');
	}
        public function findUsersNotInGroup($gid)
	{
                return CHtml::listData(User::model()->findAll(array(
                        'select'=>'*',
                        'condition'=>'id NOT IN( SELECT uid FROM usergroup WHERE gid = :gid)',
                        'params'=>array(':gid'=>$gid)
                    )),'id','name');
	}
        /**
	 * @param int $id the id (primary key) of person
         * @param int $gid
	 */
	public function updateUserGroup($userId, $newGroupId, $flag)
	{
                if($flag == 0){ // Remove    
                    $oldModel = Usergroup::model()->find(array(
                        'select'=>'id',
                        'condition'=>'uid =:uid AND gid =:gid',
                        'params'=>array(':uid'=>$userId,':gid'=>$newGroupId)
                    ));
                    if(isset($oldModel['id']))
                        Usergroup::model()->findByPk($oldModel['id'])->delete();
                }else if($flag == 1){ //Add
                    $newmodel = new Usergroup();
                    $newmodel->gid = $newGroupId;
                    $newmodel->uid = $userId;
                    $newmodel->save();
                }
	     
	}
}