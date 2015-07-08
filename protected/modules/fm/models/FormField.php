<?php

/**
 * This is the model class for table "FORM_FIELDS".
 *
 * The followings are the available columns in table 'FORM_FIELDS':
 * @property integer $FIELD_ID
 * @property integer $FORM_ID
 * @property string $VARNAME
 * @property string $TITLE
 * @property string $FIELD_TYPE
 * @property integer $FIELD_SIZE
 * @property integer $FIELD_SIZE_MIN
 * @property integer $REQUIRED
 * @property string $MATCH
* @property string $SELECT
 * @property string $RANGE
 * @property string $ERROR_MESSAGE
 * @property string $OTHER_VALIDATOR
 * @property string $DEFAULT
 * @property string $WIDGET
 * @property string $WIDGETPARAMS
 * @property integer $POSITION
 * @property integer $VISIBLE
 * @property string $CREATED_BY
 * @property string $LAST_MODIFIED_BY
 * @property string $CREATED_DATE
 * @property string $LAST_MODIFIED_DATE
 */
class FormField extends CActiveRecord
{
	const VISIBLE_ALL=3;
	const VISIBLE_REGISTER_USER=2;
	const VISIBLE_ONLY_OWNER=1;
	const VISIBLE_NO=0;
	
	const SELECT_DROP = 0;
	const SELECT_RADIO = 1;
	const SELECT_CHECK = 2;

	

	
	const REQUIRED_NO = 0;
	const REQUIRED_YES = 1;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FormField the static model class
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
		return 'FORM_FIELDS';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FORM_ID, FIELD_SIZE, FIELD_SIZE_MIN, REQUIRED,SELECT, POSITION, VISIBLE', 'numerical', 'integerOnly'=>true),
			array('VARNAME, FIELD_TYPE', 'length', 'max'=>50),
			array('TITLE, MATCH, RANGE, ERROR_MESSAGE, DEFAULT, WIDGET, CREATED_BY, LAST_MODIFIED_BY', 'length', 'max'=>255),
			array('OTHER_VALIDATOR, WIDGETPARAMS, CREATED_DATE, LAST_MODIFIED_DATE', 'safe'),
			array('VARNAME, TITLE, FIELD_TYPE, FIELD_SIZE, REQUIRED, POSITION, VISIBLE', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FIELD_ID, FORM_ID, VARNAME, TITLE, FIELD_TYPE, FIELD_SIZE, FIELD_SIZE_MIN, SELECT,REQUIRED, MATCH, RANGE, ERROR_MESSAGE, OTHER_VALIDATOR, DEFAULT, WIDGET, WIDGETPARAMS, POSITION, VISIBLE, CREATED_BY, LAST_MODIFIED_BY, CREATED_DATE, LAST_MODIFIED_DATE', 'safe', 'on'=>'search'),
			//Tracking
			array('LAST_MODIFIED_DATE','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'update'),
			array('CREATED_DATE','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'insert'),
			array('LAST_MODIFIED_BY','default','value'=>Yii::app()->user->id,'setOnEmpty'=>false,'on'=>'update'),
			array('CREATED_BY','default','value'=>Yii::app()->user->id,'setOnEmpty'=>false,'on'=>'insert'),
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
		);
	}
	
	public function scopes()
    {
        return array(
            'forAll'=>array(
                'condition'=>'visible='.self::VISIBLE_ALL,
                'order'=>'position',
            ),
            'forUser'=>array(
                'condition'=>'visible>='.self::VISIBLE_REGISTER_USER,
                'order'=>'position',
            ),
            'forOwner'=>array(
                'condition'=>'visible>='.self::VISIBLE_ONLY_OWNER,
                'order'=>'position',
            ),
            'sort'=>array(
                'order'=>'position',
            ),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FIELD_ID' => 'Field',
			'FORM_ID' => 'Form',
			'VARNAME' => 'Varname',
			'TITLE' => 'Field Name',
			'FIELD_TYPE' => 'Field Type',
			'FIELD_SIZE' => 'Field Size',
			'FIELD_SIZE_MIN' => 'Field Size Min',
			'REQUIRED' => 'Required',
			'MATCH' => 'Match',
			'SELECT'=>'Select',
			'RANGE' => 'Range',
			'ERROR_MESSAGE' => 'Error Message',
			'OTHER_VALIDATOR' => 'Other Validator',
			'DEFAULT' => 'Default Value',
			'WIDGET' => 'Widget',
			'WIDGETPARAMS' => 'Widgetparams',
			'POSITION' => 'Position',
			'VISIBLE' => 'Visible',
			'CREATED_BY' => 'Created By',
			'LAST_MODIFIED_BY' => 'Last Modified By',
			'CREATED_DATE' => 'Created Date',
			'LAST_MODIFIED_DATE' => 'Last Modified Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($form_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('FIELD_ID',$this->FIELD_ID);
		if($form_id!=NULL){
			$criteria->compare('FORM_ID',$form_id);
		}else{
			$criteria->compare('FORM_ID',$this->FORM_ID);
		}
		$criteria->compare('VARNAME',$this->VARNAME,true);
		$criteria->compare('TITLE',$this->TITLE,true);
		$criteria->compare('FIELD_TYPE',$this->FIELD_TYPE,true);
		$criteria->compare('FIELD_SIZE',$this->FIELD_SIZE);
		$criteria->compare('FIELD_SIZE_MIN',$this->FIELD_SIZE_MIN);
		$criteria->compare('REQUIRED',$this->REQUIRED);
		$criteria->compare('MATCH',$this->MATCH,true);
		$criteria->compare('SELECT',$this->SELECT);

		$criteria->compare('RANGE',$this->RANGE,true);
		$criteria->compare('ERROR_MESSAGE',$this->ERROR_MESSAGE,true);
		$criteria->compare('OTHER_VALIDATOR',$this->OTHER_VALIDATOR,true);
		$criteria->compare('DEFAULT',$this->DEFAULT,true);
		$criteria->compare('WIDGET',$this->WIDGET,true);
		$criteria->compare('WIDGETPARAMS',$this->WIDGETPARAMS,true);
		$criteria->compare('POSITION',$this->POSITION);
		$criteria->compare('VISIBLE',$this->VISIBLE);
		$criteria->compare('CREATED_BY',$this->CREATED_BY,true);
		$criteria->compare('LAST_MODIFIED_BY',$this->LAST_MODIFIED_BY,true);
		$criteria->compare('CREATED_DATE',$this->CREATED_DATE,true);
		$criteria->compare('LAST_MODIFIED_DATE',$this->LAST_MODIFIED_DATE,true);
		
		/*
		if($condition)
		{
			$criteria->condition=$condition;
		}
		*/
		
		/*
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		*/
		return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
			'pagination'=>array(
				//'pageSize'=>Yii::app()->controller->module->fields_page_size,
			),
			'sort'=>array(
				'defaultOrder'=>'POSITION',
			),
        ));
	}
	
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'field_type' => array(
				'INTEGER' => 'INTEGER',
				'VARCHAR' => 'VARCHAR',
				'TEXT'=> 'TEXT',
				'DATE'=> 'DATE',
				'FLOAT'=> 'FLOAT',
				'DECIMAL'=> 'DECIMAL',
				'BOOL'=> 'BOOL',
				'BLOB'=> 'BLOB',
				'BINARY'=> 'BINARY',
			),
			'required' => array(
				self::REQUIRED_NO => 'No',
				self::REQUIRED_YES => 'Yes',
			),
			
			'select' => array(
				self::SELECT_DROP => '---',
				self::SELECT_RADIO => 'Radio Button',
				self::SELECT_CHECK => 'Check box',
			),
		
			'visible' => array(
				self::VISIBLE_ALL => 'For all',
				self::VISIBLE_REGISTER_USER => 'Registered users',
				self::VISIBLE_ONLY_OWNER => 'Only owner',
				self::VISIBLE_NO => 'Hidden',
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
	
	/**
     * @param $value
     * @return formated value (string)
     */
    public function widgetView($model) {
		echo "inside wv";
    	if ($this->WIDGET && class_exists($this->WIDGET)) {
			$widgetClass = new $this->WIDGET;
			echo " yes";
    		$arr = $this->WIDGETPARAMS;
			if ($arr) {
				echo " 1";
				$newParams = $widgetClass->params;
				$arr = (array)CJavaScript::jsonDecode($arr);
				foreach ($arr as $p=>$v) {
					if (isset($newParams[$p])) $newParams[$p] = $v;
				}
				$widgetClass->params = $newParams;
			}
			
			if (method_exists($widgetClass,'viewAttribute')) {
				echo " 2";
				return $widgetClass->viewAttribute($model,$this);
			}
		} 
		return false;
    }
    
    public function widgetEdit($model,$params=array()) {
    	if ($this->WIDGET && class_exists($this->WIDGET)) {
			$widgetClass = new $this->WIDGET;
			
    		$arr = $this->WIDGETPARAMS;
			if ($arr) {
				$newParams = $widgetClass->params;
				$arr = (array)CJavaScript::jsonDecode($arr);
				foreach ($arr as $p=>$v) {
					if (isset($newParams[$p])) $newParams[$p] = $v;
				}
				$widgetClass->params = $newParams;
			}
			
			if (method_exists($widgetClass,'editAttribute')) {
				return $widgetClass->editAttribute($model,$this,$params);
			}
		}
		return false;
    }
}