<?php
/**
 * FWdropDownDep Widget
 */

class FWdropDownDep {
  
	public $params = array(
		'modelName'=>'',
		'optionName'=>'',
		'emptyField'=>'---',
		'relationName'=>'abc',
		'modelDestName'=>'',
		'destField'=>'',
		'optionDestName'=>'',
	);
	
	/**
	 * Widget initialization
	 * @return array
	 */
	public function init() {
		return array(
			'name'=>__CLASS__,
			'label'=>'DropDown List Dependent',
			'fieldType'=>array('INTEGER'),
			'params'=>$this->params,
			'paramsLabels' => array(
				'modelName'=>'Model Name',
				'optionName'=>'Label field name',
				'emptyField'=>'Empty item name',
				'relationName'=>'Profile model relation name',
				'modelDestName'=>'Model Dest Name',
				'destField'=>'Dest Field',
				'optionDestName'=>'Label Dest field name',
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
			return (($this->params['optionName'])?$m->getAttribute($this->params['optionName']):$m->getAttribute($m->tableSchema->primaryKey));
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
			$list[$m->getAttribute($m->tableSchema->primaryKey)] = 
                                (($this->params['optionName'])?$m->getAttribute($this->params['optionName']):$m->getAttribute($m->tableSchema->primaryKey));
		return CHtml::activeDropDownList($model,$field->varname,$list,$htmlOptions=array(
				'ajax'=>array(
						'type'=>'POST',
						'url'=>CController::createUrl('/fm/fields/getDroDownDepValues'),
						'data'=>array('model'=>$this->params['modelDestName'], 'field_dest'=>$this->params['destField'], 'varname'=>$field->VARNAME, $field->varname=>'js:this.value', 'optionDestName'=>$this->params['optionDestName']),
						'success'=>'function(data){
        						$("#ajax_loader").hide();
        						$("#Profile_'.$this->params['destField'].'").html(data)
        				}',
						'beforeSend'=>'function(){
	        					$("#ajax_loader").fadeIn();
	        			}',
				)
				));
	}
	
}
