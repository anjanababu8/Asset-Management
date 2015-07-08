<?php
/**
 * CActiveRecord implementation that allows specifying
 * DB table name instead of creating a class for each table.
 * 
 * Usage (assuming table 'user' with columns 'id' and 'name'):
 * 
 * 	$userModel = Entry::forTable('user');
 * 	//list existing users
 * 	foreach ($userModel->findAll() as $user)
 * 		echo $user->id . ': ' . $user->name . '<br>';
 * 	//add new user
 * 	$userModel->name = 'Joe Smith';
 * 	$userModel->save();
 * 
 */
class Entry extends CActiveRecord
{
	/**
	 * Name of the DB table
	 * @var string
	 */
	protected $_tableName;

	/**
	 * Table meta-data.
	 * Must redeclare, as parent::_md is private
	 * @var CActiveRecordMetaData
	 */
	protected $_md;
	
	private static $_model;
	private static $_rules = array();

	/**
	 * Constructor
	 * @param string $scenario (defaults to 'insert')
	 * @param string $tableName
	 */
	public function __construct($scenario = 'insert', $tableName = null)
	{
		$this->_tableName = $tableName;
		parent::__construct($scenario);
	}

	/**
	 * Overrides default instantiation logic.
	 * Instantiates AR class by providing table name
	 * @see CActiveRecord::instantiate()
	 * @return DynamicActiveRecord
	 */
	protected function instantiate($attributes)
	{
		return new Entry(null, $this->tableName());
	}

	/**
	 * Returns meta-data for this DB table
	 * @see CActiveRecord::getMetaData()
	 * @return CActiveRecordMetaData
	 */
	public function getMetaData()
	{
		if ($this->_md !== null)
			return $this->_md;
		else
			return $this->_md = new CActiveRecordMetaData($this);
	}

	/**
	 * Returns table name
	 * @see CActiveRecord::tableName()
	 * @return string
	 */
	public function tableName()
	{
		if (!$this->_tableName)
			$this->_tableName = parent::tableName();
		return $this->_tableName;
	}

	/**
	 * Returns an instance of DynamicActiveRecord for the provided DB table.
	 * This is a helper method that may be used instead of constructor.
	 * @param string $tableName
	 * @param string $scenario
	 * @return DynamicActiveRecord
	 */
	public static function forTable($tableName, $scenario = 'insert')
	{
		return new Entry($scenario, $tableName);
	}
	
	public function rules2()
	{

	    $required = array();
	    $rules = array();

	    $model=self::getFields();

	    foreach ($model as $field) {
	       $field_rule = array();
	       if ($field->REQUIRED==FormField::REQUIRED_YES){
	          array_push($required,$field->VARNAME);
	          //print_r($field->VARNAME); //outputs: email
	       }
	       if ($field->FIELD_TYPE=='VARCHAR'||$field->FIELD_TYPE=='TEXT') {
	          $field_rule = array($field->VARNAME, 'length', 'max'=>$field->FIELD_SIZE, 'min' => $field->FIELD_SIZE_MIN);
	          array_push($rules,$field_rule);   
	        }
	    }
	    array_push($rules,array(implode(',',$required), 'required'));
	    return $rules;
	}
	
	public function rules()
	{
	
		if (!self::$_rules) {
			$required = array();
			$numerical = array();
			$float = array();		
			$decimal = array();
			$rules = array();
			$test = array();

			$model=self::getFields();

			foreach ($model as $field) {
				$field_rule = array();
				if ($field->REQUIRED==FormField::REQUIRED_YES){
					array_push($required,$field->VARNAME);
				}
				if ($field->FIELD_TYPE=='FLOAT'){
					array_push($float,$field->VARNAME);
				}
				if ($field->FIELD_TYPE=='DECIMAL'){
					array_push($decimal,$field->VARNAME);
				}
				if ($field->FIELD_TYPE=='INTEGER'){
					array_push($numerical,$field->VARNAME);
				}
				if ($field->FIELD_TYPE=='VARCHAR'||$field->FIELD_TYPE=='TEXT') {
					$field_rule = array($field->VARNAME, 'length', 'max'=>$field->FIELD_SIZE, 'min' => $field->FIELD_SIZE_MIN);
					if ($field->ERROR_MESSAGE) {
						$field_rule['message'] = $field->ERROR_MESSAGE;
					}
					array_push($rules,$field_rule);
				}	
				if ($field->OTHER_VALIDATOR) {
					if (strpos($field->OTHER_VALIDATOR,'{')===0) {
						$validator = (array)CJavaScript::jsonDecode($field->OTHER_VALIDATOR);
						foreach ($validator as $name=>$val) {
							$field_rule = array($field->VARNAME, $name);
							$field_rule = array_merge($field_rule,(array)$validator[$name]);
							if ($field->error_message) $field_rule['message'] = $field->ERROR_MESSAGE;
							array_push($rules,$field_rule);
						}
					} else {
						$field_rule = array($field->VARNAME, $field->OTHER_VALIDATOR);
						if ($field->ERROR_MESSAGE) $field_rule['message'] = $field->ERROR_MESSAGE;
						array_push($rules,$field_rule);
					}
				} elseif ($field->FIELD_TYPE=='DATE') {
                    if ($field->REQUIRED)
                        $field_rule = array($field->VARNAME, 'date', 'format' => array('yyyy-mm-dd'));
                    else
                        $field_rule = array($field->VARNAME, 'date', 'format' => array('yyyy-mm-dd','0000-00-00'), 'allowEmpty'=>true);

					if ($field->ERROR_MESSAGE) $field_rule['message'] = $field->ERROR_MESSAGE;
					array_push($rules,$field_rule);
				}
				if ($field->MATCH) {
					$field_rule = array($field->VARNAME, 'match', 'pattern' => $field->MATCH);
					if ($field->ERROR_MESSAGE) $field_rule['message'] = $field->ERROR_MESSAGE;
					array_push($rules,$field_rule);
				}
				if ($field->RANGE) {
					$field_rule = array($field->VARNAME, 'in', 'range' => self::rangeRules($field->RANGE));
					if ($field->ERROR_MESSAGE) $field_rule['message'] = $field->ERROR_MESSAGE;
					array_push($rules,$field_rule);
				}
			} //foreach $field

			array_push($rules,array(implode(',',$required), 'required'));
			array_push($rules,array(implode(',',$numerical), 'numerical', 'integerOnly'=>true));
			array_push($rules,array(implode(',',$float), 'type', 'type'=>'float'));
			array_push($rules,array(implode(',',$decimal), 'match', 'pattern' => '/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/'));
			
			array_push($rules,array('FORM_ID','default','value'=>Yii::app()->params['form-id'],'setOnEmpty'=>false,'on'=>'insert'));
			array_push($rules,array('CREATED_BY, LAST_MODIFIED_BY', 'length', 'max'=>255));
			array_push($rules,array('CREATED_DATE, LAST_MODIFIED_DATE', 'safe'));
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array_push($rules,array('ID, FORM_ID, CREATED_BY, LAST_MODIFIED_BY, CREATED_DATE, LAST_MODIFIED_DATE', 'safe', 'on'=>'search'));
			//Tracking
			array_push($rules,array('LAST_MODIFIED_DATE','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'update'));
			array_push($rules,array('CREATED_DATE','default','value'=>new CDbExpression('NOW()'),'setOnEmpty'=>false,'on'=>'insert'));
			array_push($rules,array('LAST_MODIFIED_BY','default','value'=>Yii::app()->user->id,'setOnEmpty'=>false,'on'=>'update'));
			array_push($rules,array('CREATED_BY','default','value'=>Yii::app()->user->id,'setOnEmpty'=>false,'on'=>'insert'));
			
			self::$_rules = $rules;
		}
		return self::$_rules;
	}
	
	private function rangeRules($str) {
		$rules = explode(';',$str);
		for ($i=0;$i<count($rules);$i++)
			$rules[$i] = current(explode("==",$rules[$i]));
		return $rules;
	}
	
	static public function range($str,$fieldValue=NULL) {
		$rules = explode(';',$str);
		$array = array();
		for ($i=0;$i<count($rules);$i++) {
			$item = explode("==",$rules[$i]);
			if (isset($item[0])) $array[$item[0]] = ((isset($item[1]))?$item[1]:$item[0]);
		}
		if (isset($fieldValue)) 
			if (isset($array[$fieldValue])) return $array[$fieldValue]; else return '';
		else
			return $array;
	}
	
	public static function getFields() {
		$form_id=Yii::app()->params['form-id'];
		self::$_model=FormField::model()->findAllByAttributes(array('FORM_ID'=>$form_id), array('order'=>'POSITION ASC'));
		return self::$_model;
	}
	
	public static function model($className=__CLASS__)
	{	
		if(isset(self::$_models[$className]))
			return self::$_models[$className];
		else
		{
		   $model = Entry::forTable($className);
		   
		   return $model;
		}
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('ID',$this->ID);
		$criteria->compare('FORM_ID',$this->FORM_ID);
		$criteria->compare('CREATED_BY',$this->CREATED_BY);
		
		return new CActiveDataProvider($this->tableName(), array(
			'criteria'=>$criteria,
		));
	}
	
}