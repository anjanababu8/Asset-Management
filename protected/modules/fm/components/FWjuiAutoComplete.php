<?php

class FWjuiAutoComplete {
	
	public $params = array(
		'ui-theme'=>'base',
		'modelName'=>'',
		'optionName'=>'',
		'emptyFieldLabel'=>'Not found',
		'emptyFieldValue'=>0,
		'relationName'=>'abc',
		'minLength'=>'0',
	);
	
	/**
	 * Widget initialization
	 * @return array
	 */
	public function init() {
		return array(
			'name'=>__CLASS__,
			'label'=>'jQueryUI autocomplete',
			'fieldType'=>array('INTEGER'),
			'params'=>$this->params,
			'paramsLabels' => array(
				'modelName'=>'Model Name',
				'optionName'=>'Label field name',
				'emptyFieldLabel'=>'Empty item name',
				'emptyFieldValue'=>'Empty item value',
				'relationName'=>'Profile model relation name',
				'minLength'=>'minimal start research length',
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
			return (($this->params['optionName'])?$m->getAttribute($this->params['optionName']):$m->ID);
		else
			return $this->params['emptyFieldLabel'];
	}
	
	/**
	 * @param $model - profile model
	 * @param $field - profile fields model item
	 * @param $params - htmlOptions
	 * @return string
	 */
	public function editAttribute($model,$field,$htmlOptions=array()) {
		$list = array();
		if (isset($this->params['emptyFieldValue'])) $list[]=array('id'=>$this->params['emptyFieldValue'],'label'=>$this->params['emptyFieldLabel']);
			$models = CActiveRecord::model($this->params['modelName'])->findAll();
		foreach ($models as $m)
			$list[] = (($this->params['optionName'])?array('label'=>$m->getAttribute($this->params['optionName']),'id'=>$m->ID):array('label'=>$m->ID,'id'=>$m->ID));
		
		if (!isset($htmlOptions['id'])) $htmlOptions['id'] = $field->VARNAME;
		$id = $htmlOptions['id'];
		
		$relation = $model->relations();
		if ($this->params['relationName']&&isset($relation[$this->params['relationName']])) {
			$m = $model->__get($this->params['relationName']);
		} else {
			$m = CActiveRecord::model($this->params['modelName'])->findByPk($model->getAttribute($field->VARNAME));
		}
		
		if ($m)
			$default_value = (($this->params['optionName'])?$m->getAttribute($this->params['optionName']):$m->ID);
		else
			$default_value = '';
		
		$htmlOptions['value'] = $default_value;
		$options['source'] = $list;
		$options['minLength'] = $this->params['minLength'];
		$options['showAnim'] = 'fold';
		$options['select'] = "js:function(event, ui) { $('#".get_class($model)."_".$field->varname."').val(ui.item.id);}";
		$options=CJavaScript::encode($options);
		//$basePath=Yii::getPathOfAlias('application.views.asset');
		$basePath=Yii::getPathOfAlias('application.modules.fm.views.asset');
		$baseUrl=Yii::app()->getAssetManager()->publish($basePath);
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($baseUrl.'/css/'.$this->params['ui-theme'].'/jquery-ui.css');
		$cs->registerScriptFile($baseUrl.'/js/jquery-ui.min.js');
		$js = "jQuery('#{$id}').autocomplete({$options});";
		$cs->registerScript('Autocomplete'.'#'.$id, $js);
		
		return CHtml::activeTextField($model,$field->VARNAME,$htmlOptions).CHtml::activehiddenField($model,$field->VARNAME);
	}
} 