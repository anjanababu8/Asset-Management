<?php

class TypesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
				'actions'=>array('index', 'view', 'new', 'edit', 'delete'),
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
		if (isset($_GET['type']))
		{
			$type_id = $_GET['type'];
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}
	
		$this->render('view',array(
			'model'=>$this->loadModel($type_id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionNew()
	{
		$model=new Type;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Type']))
		{
			$model->attributes=$_POST['Type'];
			if($model->save())
				$this->redirect(array('view','type'=>$model->TYPE_ID));
		}

		$this->render('new',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit()
	{
		if (isset($_GET['type']))
		{
			$type_id = $_GET['type'];
			$model=Type::model()->findByPk($type_id);
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Type']))
		{
			$model->attributes=$_POST['Type'];
			if($model->save())
				$this->redirect(array('view','type'=>$model->TYPE_ID));
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
		if (isset($_GET['type']))
		{
			$type_id = $_GET['type'];
			$this->loadModel($type_id)->delete();
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('all'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Type('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Type']))
			$model->attributes=$_GET['Type'];

		$this->render('all',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Type the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Type::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Type $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='type-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
