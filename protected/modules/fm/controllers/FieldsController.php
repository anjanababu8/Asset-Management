<?php

class FieldsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	private $_model;
	private static $_widgets = array();
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index', 'view', 'create', 'update', 'admin' and 'delete' actions
				'actions'=>array('index','view', 'new', 'edit', 'delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		if (isset($_GET['field']))
		{
			$field_id = $_GET['field'];
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}

		$this->render('view',array(
			'model'=>$this->loadModel($field_id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionNew()
	{
		if (isset($_GET['form']))
		{
			$form_id = $_GET['form'];
			
			$model=new FormField;
			
			

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['FormField']))
			{
				$model->attributes=$_POST['FormField'];
				$model->VARNAME=str_replace(' ', '_', $model->TITLE);
				$model->VARNAME=strtoupper($model->VARNAME);
				
				
				
				
				
				
				$model->FORM_ID=$form_id;
				//if($model->save())
				//	$this->redirect(array('view','field'=>$model->FIELD_ID));
				$form=Form::model()->findByPk($form_id);
				
				if($model->FIELD_TYPE=='DATE'){
					$column_t='TIMESTAMP ';
					$column_t.='DEFAULT "0000-00-00 00:00:00"';
				} elseif($model->FIELD_TYPE=='INTEGER') {
					//$column_t='INT('.$model->FIELD_SIZE.') NOT NULL DEFAULT'.($model->DEFAULT)?$model->DEFAULT:$model->DEFAULT;
					$column_t='INT('.$model->FIELD_SIZE.') ';
					if(is_int($model->DEFAULT)){
						$column_t.='DEFAULT '.$model->DEFAULT;
					}
					else{
						$model->DEFAULT='';
					}
				} elseif($model->FIELD_TYPE=='VARCHAR') {
					$column_t='VARCHAR('.$model->FIELD_SIZE.') ';
					if($model->DEFAULT){
						$column_t.='DEFAULT '.$model->DEFAULT;
					}
					else{
						$model->DEFAULT='';
					}
				} else{
					$column_t=$model->FIELD_TYPE.' ';
					if($model->DEFAULT){
						$column_t.='DEFAULT '.$model->DEFAULT;
					}
					else{
						$model->DEFAULT='';
					}
				}
				
				if(!FormField::model()->findAllByAttributes(array('VARNAME'=>$model->VARNAME,'FORM_ID'=>$form_id)))
				{
					if($model->save())
					{	
						Yii::app()->db->createCommand()->addColumn($form->TABLE_NAME, $model->VARNAME, $column_t);
						$this->redirect(array('fields/index','form'=>$model->FORM_ID));
					}
				}
				else
				{
					$model->addError('VARNAME','Column "'.$model->VARNAME.'" already exists. Please pick a new column name.');
				}
			}
			
			$this->render('new',array(
				'model'=>$model,
				'form_id'=>$form_id,
			));
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}
		
		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit()
	{
		if (isset($_GET['field']))
		{
			$field_id = $_GET['field'];
			$model=FormField::model()->findByPk($field_id);
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FormField']))
		{
			$model->attributes=$_POST['FormField'];
			if($model->save())
				$this->redirect(array('view','field'=>$model->FIELD_ID,'form'=>$model->FORM_ID));
		}
		
		$this->render('edit',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		if (isset($_GET['field'])&&isset($_GET['form']))
		{
			$field_id = $_GET['field'];
			$form_id = $_GET['form'];
			$form=Form::model()->findByPk($form_id);
			$field=FormField::model()->findByPk($field_id);
			
			if(FormField::model()->findAllByAttributes(array('VARNAME'=>$field->VARNAME,'FORM_ID'=>$form_id))){
				Yii::app()->db->createCommand()->dropColumn($form->TABLE_NAME, $field->VARNAME);
				$this->loadModel($field_id)->delete();
			}
			else{
				throw new CHttpException(404,'Cannot delete field column. Please contact admin.');
			}			
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index','form'=>$form_id));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//if (isset($_GET['form']))
		//{
			$form_id = $_GET['form'];
			//$model=FormField::model()->findAllByAttributes(array('FORM_ID'=>$form_id), array('order'=>'POSITION ASC'));
			
			$model=new FormField('search');
			$model->unsetAttributes();  // clear any default values
			//$model->findAllByAttributes(array('FORM_ID'=>$form_id), array('order'=>'POSITION ASC'));
			//$model=FormField::model()->findAllByAttributes(array('FORM_ID'=>$form_id), array('order'=>'POSITION ASC'));
			if(isset($_GET['FormField']))
				$model->attributes=$_GET['FormField'];

			$this->render('all',array(
				'model'=>$model,
				'form_id'=>$form_id,
			));
	//	}
	//	else
	//	{
	//		throw new CHttpException(404,'The requested page does not exist.');
	//	}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FormField the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=FormField::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	
	
	/**
	 * MySQL field type
	 * @param $type string
	 * @return string
	 */
	public function fieldType($type) {
		$type = str_replace('UNIX-DATE','INTEGER',$type);
		return $type;
	}
	
	public static function getWidgets($fieldType='') {
		$basePath=Yii::getPathOfAlias('application.modules.fm.components');
		$widgets = array();
		$list = array(''=>'No');
		if (self::$_widgets) {
			$widgets = self::$_widgets;
		} else {
			$d = dir($basePath);
			while (false !== ($file = $d->read())) {
				if (strpos($file,'FW')===0) {
					list($className) = explode('.',$file);
					if (class_exists($className)) {
						$widgetClass = new $className;
						if ($widgetClass->init()) {
							$widgets[$className] = $widgetClass->init();
							if ($fieldType) {
								if (in_array($fieldType,$widgets[$className]['fieldType'])) $list[$className] = $widgets[$className]['label'];
							} else {
								$list[$className] = $widgets[$className]['label'];
							}
						}
					}
				}
			}
			$d->close();
		}
		return array($list,$widgets);		
	}
	
    /**
	 * Get Values for Dependent DropDownList.
	 */
	public function actionGetDroDownDepValues(){
		$post = $_POST;
		$model = new $post['model'];
		$data = CHtml::listData($model->findAll($post['varname'].'=:'.$post['varname'], array(':'.$post['varname']=>$post[$post['varname']])), 'id', $post['optionDestName']);
		echo CHtml::tag('option', array('value'=>''), CHtml::encode('Seleccione...'), true);
		foreach($data AS $value=>$name){
			echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
		}
	}

	/**
	 * Performs the AJAX validation.
	 * @param FormField $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='form-field-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
