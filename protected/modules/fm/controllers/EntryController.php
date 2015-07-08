<?php

class EntryController extends Controller
{
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
				'actions'=>array('index','view', 'new', 'edit', 'delete','generatePdf'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
    public function actionGeneratePdf(){
		
		$this->layout = 'pdf';
		$model=new Entry('search');
		if(isset($_GET['Entry']))
		$model->attributes=$_GET['Entry']; // to execute the filters (if is the case) 
		$dataProvider = $model->search();
		$dataProvider->pagination = false; 
		$mPDF1 = Yii::app()->ePdf->mpdf();
		# You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');

        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('admin',array('model'=>$model), true));

        # Outputs ready PDF
        $mPDF1->Output();
	}
	
	public function loadUser()
	{
		if($this->_model===null)
		{
			if(Yii::app()->user->id)
				$this->_model=Yii::app()->controller->module->user();
			if($this->_model===null)
				$this->redirect(Yii::app()->controller->module->loginUrl);
		}
		return $this->_model;
	}
	
	public function actionDelete()
	{
		if (isset($_GET['form']) && isset($_GET['entry']))
		{
			$form_id = $_GET['form'];
			$entry_id = $_GET['entry'];
			$this->loadModel($form_id,$entry_id)->delete();
			$this->redirect(array('index','form'=>$form_id));
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('all'));
	}
	
	public function actionEdit()
	{
		if (isset($_GET['form']) && isset($_GET['entry'])){
			$table_id = $_GET['form'];
			$entry_id = $_GET['entry'];
			$form=Form::model()->findByPk($table_id);
			$model=Entry::forTable($form->TABLE_NAME);
			$model=$model->findByPk($entry_id);
			Yii::app()->params['form-id'] = $table_id;
		} else {
			throw new CHttpException(404,'The requested page does not exist.');
		}

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Entry']))
		{
			$model->attributes=$_POST['Entry'];
			if($model->save())
				//var_dump($model->attributes);
				$this->redirect(array('view','entry'=>$model->ID,'form'=>$table_id));
		}

		$this->render('edit',array(
			'model'=>$model,
			'form'=>$form,
		));
	}
	
	
	public function renderButtons($data) {
        $getAllocatedItem = Allocate::model()->find('cons_id = :cons_id AND (date_out IS NULL OR date_out = :date_out)',array(':cons_id' => $data->ID,':date_out'=>'0000-00-00'));
        $temp=Form::model()->find("FORM_ID=:FORM_ID",array(":FORM_ID"=>$data->FORM_ID));
		
		$canAllocate = ($getAllocatedItem['allocate_id'])? true: false;
		
		if($data->FORM_ID==16)
		{
			$this->widget('bootstrap.widgets.TbButtonGroup', array(
		  'size'=>'small',
		  'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		  'buttons'=>array(
		     array('label'=>'Action', 'items'=>array(
		     	array('label'=>'Transfer', 'url'=>Yii::app()->homeUrl.'/transferFile/create',
                                                'linkOptions' => array('submit' => array('/transferFile/create','formId' => $data->FORM_ID, 'itemId' => $data->ID,'deptName'=>$data->DEPARTMENT,'owner'=>$data->OWNER))),
		     	array('label'=>'Add details', 'url'=>Yii::app()->homeUrl.'/filedetails/create',
                                                'linkOptions' => array('submit' => array('/filedetails/create','formId' => $data->FORM_ID,'itemId'=>$data->ID,'deptName'=>$data->DEPARTMENT))),
		     	array('label'=>'Add Stock', 'url'=>Yii::app()->homeUrl.'/consumablestock/create',
                                                'linkOptions' => array('submit' => array('/consumablestock/create', 'itemId' => $data->ID,'commodity_id'=>$data->FORM_ID))),

                        array('label'=>'Close File', 'url'=>Yii::app()->homeUrl.'/filedetails/admin',
                                                'linkOptions' => array('submit' => array('/filedetails/admin','itemId'=>$data->ID))),
		        array('label'=>'Sealed', 'url'=>Yii::app()->homeUrl.'/filedetails/admin',
                                                'linkOptions' => array('submit' => array('/filedetails/admin', 'itemId' => $data->ID))),
		        array('label'=>'Print Label', 'url'=>Yii::app()->homeUrl.'/label/printall',                       
                                                'linkOptions' => array('submit' => array('/label/printallform','formId' => $data->FORM_ID, 'itemId' => $data->ID,'fileType'=>$data->FILE_TYPE))),
                                                                
		        array('label'=>'Print Details', 'url'=>Yii::app()->homeUrl.'/fm/entry/view',
                                            'linkOptions' => array('submit' => array('/fm/entry/view'.'?form='.$data->FORM_ID.'&entry='.$data->ID)))
                                            ),
		  ),
		)
		     	
		  
		));
		}
		else
		{
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
		  'size'=>'small',
		  'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		  'buttons'=>array(
		     array('label'=>'Action', 'items'=>array(
		     	//array('label'=>'Transfer Item', 'url'=>Yii::app()->homeUrl.'/transferCons/create',
                                                //'linkOptions' => array('submit' => array('/transferCons/create', 'itemId' => $data->ID,'commodity_id'=>$temp['TYPE_ID']))),
		     	array('label'=>'Block Item', 'url'=>Yii::app()->homeUrl.'/blockeditem/create',
                                                'linkOptions' => array('submit' => array('/blockeditem/create', 'id' => 1, 'itemId'=>$data->ID,'commodity_id'=>$temp['TYPE_ID']))),
		     	array('label'=>'Block User Group', 'url'=>Yii::app()->homeUrl.'/blockeditem/create',
                                                'linkOptions' => array('submit' => array('/blockeditem/create', 'id' => 2,'itemId'=>$data->ID,'commodity_id'=>$temp['TYPE_ID']))),
		        array('label'=>'Add Stock Commodity', 'url'=>Yii::app()->homeUrl.'/consumablestock/create',
                                                'linkOptions' => array('submit' => array('/consumablestock/create', 'itemId' => $data->ID,'commodity_id'=>$temp['TYPE_ID']))),
		        array('label'=>'Allocate Commodity', 'url'=> $canAllocate? Yii::app()->homeUrl.'/allocate/create': NULL,                        
                                                'linkOptions' => array('submit' => array('/allocate/update/'.$getAllocatedItem['allocate_id'].'?allocateId='.$getAllocatedItem['allocate_id'].'&commodity_id='.$temp['TYPE_ID']),
                                                                )),
		        array('label'=>'View Allocate History', 'url'=>Yii::app()->homeUrl.'/allocate/admin',
                                            'linkOptions' => array('submit' => array('/allocate/admin','itemId'=>$data->ID,'commodity_id'=>$temp['TYPE_ID'])))
                                            ),
		  ),
		)
		     	
		  
		));
          }      
         //       
	}
	
	
	
	
	
	
	public function actionNew()
	{
		if (isset($_GET['form'])){
			$table_id = $_GET['form'];
			$form=Form::model()->findByPk($table_id);
			$model=Entry::forTable($form->TABLE_NAME);
			Yii::app()->params['form-id'] = $table_id;
		} else {
			throw new CHttpException(404,'The requested page does not exist.');
		}

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Entry']))
		{
			$model->attributes=$_POST['Entry'];
			if($model->save())
				//var_dump($model->attributes);
				$this->redirect(array('entry/index','entry'=>$model->ID,'form'=>$table_id));
                                
		}

		$this->render('new',array(
			'model'=>$model,
			'form'=>$form,
		));
	}
	
	public function loadModel($table_id, $id=NULL)
	{
		$form=Form::model()->findByPk($table_id);
		$entryModel=Entry::forTable($form->TABLE_NAME);
		if($id!=NULL){
			$model=$entryModel->findByPk($id);
		}else{
			$model=$entryModel->findAll();
			//$model=$entryModel;
		}
		if($model===null){
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}
	
	public function actionIndex()
	{
		//if (isset($_GET['form']))
		//{
			$table_id = $_GET['form'];
			$entry_id = NULL;
			$fields=FormField::model()->findAllByAttributes(array('FORM_ID'=>$table_id), array('order'=>'POSITION ASC'));
			$model=$this->loadModel($table_id, $entry_id);
			//$model->unsetAttributes();  // clear any default values
		//}
		//else
		//{
		//	throw new CHttpException(404,'The requested page does not exist.');
		//}
		
		//$model=new Entry('search');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Entry']))
			$model->attributes=$_GET['Entry'];

		$this->render('all',array(
			'model'=>$model,
			'table_id'=>$table_id,
			'fields'=>$fields,
			'form'=>Form::model()->findByPk($table_id),
		));
	}

	public function actionView()
	{		
		if (isset($_GET['form']))
		{
			$table_id = $_GET['form'];
			if (isset($_GET['entry']))
			{
				$entry_id = $_GET['entry'];
				$fields=FormField::model()->findAllByAttributes(array('FORM_ID'=>$table_id), array('order'=>'POSITION ASC'));
			}
			else
			{
				$entry_id = NULL;
			}
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}

		$this->render('view',array(
			'model'=>$this->loadModel($table_id, $entry_id),
			'table_id'=>$table_id,
			'entry_id'=>$entry_id,
			'fields'=>$fields,
			'form'=>Form::model()->findByPk($table_id),
		));
	}
	
	
}