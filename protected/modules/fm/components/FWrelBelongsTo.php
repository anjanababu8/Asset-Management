<?php

class FWrelBelongsTo {
	
	public $params = array(
		'modelName'=>'',
		'optionName'=>'',
		'emptyField'=>'---',
		'relationName'=>'ad',
	);
	
	/**
	 * Widget initialization
	 * @return array
	 */
	public function init() {
		return array(
			'name'=>__CLASS__,
			'label'=>'Relation Belongs To',
			'fieldType'=>array('VARCHAR'),
			'params'=>$this->params,
			'paramsLabels' => array(
				'modelName'=>'Model Name',
				'optionName'=>'Label field name',
				'emptyField'=>'Empty item name',
				'relationName'=>'Profile model relation name',
			),
		);
	}
	
	/**
	 * @param $value
	 * @param $model
	 * @param $field_varname
	 * @return string
	 */
	public function setAttributes($value,$model,$field_varname) {
		return $value;
	}
	
	/**
	 * @param $model - profile model
	 * @param $field - profile fields model item
	 * @return string
	 */
	public function viewAttribute($model,$field) {
		$relation = $model->relations();
		if ($this->params['relationName']&&isset($relation[$this->params['relationName']])) {
			$m = $model->__get($this->params['relationName']);
		} else {
			$m = CActiveRecord::model($this->params['modelName'])->findByPk($model->getAttribute($field->VARNAME));
		}
		
		if ($m)
			return (($this->params['optionName'])?$m->getAttribute($this->params['optionName']):$m->name);
		else
			return $this->params['emptyField'];
		
	}
	
	/**
	 * @param $model - profile model
	 * @param $field - profile fields model item
	 * @param $params - htmlOptions
	 * @return string
	 */
	public function editAttribute($model,$field,$htmlOptions=array()) {
		$list = array();
		if ($this->params['emptyField']) $list[0] = $this->params['emptyField'];
		
		$models = CActiveRecord::model($this->params['modelName'])->findAll();
		foreach ($models as $m)
			$list[$m->name] = (($this->params['optionName'])?$m->getAttribute($this->params['optionName']):$m->name);
		return CHtml::activeDropDownList($model,$field->VARNAME,$list,$htmlOptions=array());
	}
	
}