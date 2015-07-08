<?php

class FormsController extends Controller
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
				'actions'=>array('index','view', 'new', 'edit', 'delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        public function manageButton($data, $row) {
            $this->widget('bootstrap.widgets.TbButtonGroup', array(
              'size'=>'small',
              'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
              'buttons'=>array(
                 array('label'=>'Manage Fields', 'url'=>Yii::app()->homeUrl.'/fm/fields/index/form/'.$data->FORM_ID,),
              ),
            ));
        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		if (isset($_GET['form']))
		{
			$form_id = $_GET['form'];
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}

		$this->render('view',array(
			'model'=>$this->loadModel($form_id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionNew()
	{
		$model=new Form;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Form']))
		{
			$model->attributes=$_POST['Form'];
			
			$model->TABLE_NAME=str_replace(' ', '_', $model->FORM_NAME);
			$model->TABLE_NAME=strtoupper($model->TABLE_NAME);
			
			if(!Yii::app()->db->schema->getTable($model->TABLE_NAME))
			{
				if($model->save())
				{
					Yii::app()->db->createCommand()->createTable($model->TABLE_NAME, array(
			            'ID' => 'pk',
						'FORM_ID' => 'INT(10)',
						'CREATED_BY' => 'VARCHAR(255)',
						'LAST_MODIFIED_BY' => 'VARCHAR(255)',
						'CREATED_DATE' => 'TIMESTAMP NOT NULL DEFAULT "0000-00-00 00:00:00"',
						'LAST_MODIFIED_DATE' => 'TIMESTAMP NOT NULL DEFAULT "0000-00-00 00:00:00" ON UPDATE CURRENT_TIMESTAMP',
			        ));

					$this->redirect(array('fields/index','form'=>$model->FORM_ID));
				}
			}
			else
			{
				$model->addError('TABLE_NAME','Table "'.$model->TABLE_NAME.'" already used. Pick a new table name.');
			}
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
		if (isset($_GET['form']))
		{
			$form_id = $_GET['form'];
			$model=Form::model()->findByPk($form_id);
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Form']))
		{
			$model->attributes=$_POST['Form'];
			
			//Get current form table name
			$currentForm=Form::model()->findByPk($model->FORM_ID);
			$table_name = $currentForm->TABLE_NAME;
			
			if($model->TABLE_NAME != $table_name)
			{
				if(!Yii::app()->db->schema->getTable($model->TABLE_NAME))
				{
					if($model->save())
					{
						Yii::app()->db->createCommand()->renameTable($table_name, $model->TABLE_NAME);
						$this->redirect(array('view','form'=>$model->FORM_ID));
					}
				}
				else
				{
					$model->addError('TABLE_NAME','Table "'.$model->TABLE_NAME.'" already used. Pick a new table name.');
				}
			}
			else
			{
				if($model->save())
				{
					$this->redirect(array('view','form'=>$model->FORM_ID));
				}
			}	
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
		if (isset($_GET['form']))
		{
			$form_id = $_GET['form'];
			$model=Form::model()->findByPk($form_id);
			$table_name = $model->TABLE_NAME;
			$this->loadModel($form_id)->delete();
			if(Yii::app()->db->schema->getTable($table_name))
			{
				Yii::app()->db->createCommand()->dropTable($table_name);
				FormField::model()->deleteAllByAttributes(array('FORM_ID'=>$form_id));
			}
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
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Form('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Form']))
			$model->attributes=$_GET['Form'];

		$this->render('all',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Form the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Form::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Form $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='form-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
