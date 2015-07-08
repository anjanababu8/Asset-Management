<?php

class FWbsDatepicker {
	
	/**
	 * @var array
	 */
	public $params = array(
	);
	
	/**
	 * Initialization
	 * @return array
	 */
	public function init() {
		return array(
			'name'=>__CLASS__,
			'label'=>'Bootstrap Datepicker',
			'fieldType'=>array('DATE','VARCHAR'),
			'params'=>$this->params,
			'paramsLabels' => array(
				'dateFormat'=>'Date format',
			),
		);
	}
	
	/**
	 * @param $model - profile model
	 * @param $field - profile fields model item
	 * @return string
	 */
	public function viewAttribute($model,$field) {
		return $model->getAttribute($field->VARNAME);
	}
	
	/**
	 * @param $model - profile model
	 * @param $field - profile fields model item
	 * @param $params - htmlOptions
	 * @return string
	 */
	public function editAttribute($model,$field,$htmlOptions=array()) {
		if (!isset($htmlOptions['size'])) $htmlOptions['size'] = 60;
		if (!isset($htmlOptions['maxlength'])) $htmlOptions['maxlength'] = (($field->FIELD_SIZE)?$field->FIELD_SIZE:10);
		if (!isset($htmlOptions['id'])) $htmlOptions['id'] = get_class($model).'_'.$field->VARNAME;
		if (!isset($htmlOptions['class'])) $htmlOptions['class'] = 'datepicker';
		
		$id = $htmlOptions['id'];
		$options['autoclose'] = true;
		$options['format'] = 'yyyy-mm-dd';
		$options=CJavaScript::encode($options);
		
		$basePath=Yii::getPathOfAlias('fm.views.asset');
		$baseUrl=Yii::app()->getAssetManager()->publish($basePath);
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($baseUrl.'/css/datepicker.css');
		$cs->registerScriptFile($baseUrl.'/js/bootstrap-datepicker.js');
		
		//$js = "$('#{$id}').datepicker({$options});";
		$js = "$('.datepicker').datepicker({$options});";

		$cs->registerScript('FormFieldController'.'#'.$id, $js);
		
		return CHtml::activeTextField($model,$field->VARNAME,$htmlOptions);
	}
	
}