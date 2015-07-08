<?php

class AllocateController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','dynamicrows','loadimage','admin2','dynamicOrganisation','generatePdf'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionAdmin2()
	{
                

		$model=new Allocate('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Allocate'])) {
			$model->attributes=$_GET['Allocate'];
		}

		$this->render('admin2',array(
			'model'=>$model,
		));
	}

        public function actionloadImage($id)
    {
        $model=$this->loadModel($id);
        $this->renderPartial('image', array(
            'model'=>$model
        ));
    }
   /* public function actionExport()
{
    $model=new Allocate;
    $model->unsetAttributes();  // clear any default values
    if(isset($_POST['Allocate']))
        $model->attributes=$_POST['Allocate'];
 
    $exportType = $_POST['fileType'];
 
    if($exportType=='PDF'){
 
        $this->widget('ext.pdffactory.EPdfFactoryHeart', array(
            'title'=>'List of Employee',
            'dataProvider' => $model->search(),
            'filter'=>$model,
            'columns' => array(                     
                     array('name' => 'barcode', 'type' => 'raw', 
                   'htmlOptions'=>array('id'=>'barcode1'),
                    'value'=>'Common::getItemBarcode(array("itemId"=> $data->allocate_id, "barcode"=>$data->stockname))'),
                ),
        ));
    }
}*/
        public function actionDynamic()
	{
		$data=User::model()->findAll('id=:id', 
                  array(':id'=>(int) $_POST['id']));
 
		$data=CHtml::listData($data,'id','name');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
                   array('value'=>$value),CHtml::encode($name),true);
		}
	}
        

	public function renderButtons($data, $row) {
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
		  'size'=>'small',
		  'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		  'buttons'=>array(
		     array('label'=>'Action', 'items'=>array(
		     	array('label'=>'Return to stock', 'url'=>'http://localhost/asset_management/index.php/returntostock/create'),
		     	array('label'=>'Damaged', 'url'=>'http://localhost/asset_management/index.php/damagelog/create'),
		    )),
		  ),
		));
	}

	public function actionDynamicRows()
    {
    	$selectionid = $_POST['selection'];
		switch ($selectionid) {
			case '1':
				die;
			case '2':
				$selectedData = Group::model()->findAll();
				$dataOptions = array(''=>'--- Select Group ---');
                                foreach ($selectedData as $row) {
                                    //$group = Group::model()->findByAttributes(array('name'=>$row->name));
                                    $dataOptions[$row->id] = $row->name;
                                }
				break;
			case '3':
				$selectedData = User::model()->findAll('name != :name',array(':name' => Yii::app()->user->getId()));
				$dataOptions = array(''=>'--- Select User ---');
				foreach ($selectedData as $row) {
                                    //$user = User::model()->findByAttributes(array('name'=>$row->name));
                                    $dataOptions[$row->id] = $row->name;
                                }
                                break;
			default:
				break;
		}
		
	    
        foreach($dataOptions as $value=>$name) {
            $opt = array();
            $opt['value'] = $value;
            echo CHtml::tag('option', $opt , CHtml::encode($name),true);
        }
        die;
    }
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Allocate;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Allocate'])) {
			$model->attributes=$_POST['Allocate'];
			$model->commodity_id =$_GET['commodity_id'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->allocate_id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Allocate'])) {
                    $quantity = $_POST['Allocate']['quantity'];
                    $availQuantity = $_POST['Allocate']['available_quantity'];
                        
                    $model->attributes=$_POST['Allocate'];    
						//$model->commodity_id =$_GET['commodity_id'];
                    $model->available_quantity = $availQuantity; /*Dont remove this */    
                    if($model->validate()){
                         switch($_POST['Allocate']['allocate_to']){
                             case 1: 
                                 $model->given_to = $_POST['Allocate']['given_by'];
                                 $model->user_group = 'U';
                                 break;
                             case 2:
                                 $model->given_to = $_POST['Allocate']['allocate_to_extend'];
                                 $model->user_group = 'G';
                                 break;
                             case 3:
                                 $model->given_to = $_POST['Allocate']['allocate_to_extend'];
                                 $model->user_group = 'U';
                                 break;
                         }
                         
                         $model->save();
                         $allocatedIDs = $model->allocate_id;
                         for($i=2;$i<=$quantity;$i++){
                             $newmodel = Allocate::model()->find('cons_id = :cons_id AND date_out IS NULL',array(':cons_id' => $_POST['Allocate']['cons_id']));    
                             $allocatedIDs .= ', '.$newmodel['allocate_id'];

                             //$newmodel->allocate_to = $model->allocate_to;
                             //$newmodel->allocate_to_extend = $model->allocate_to_extend;
                             $newmodel->date_out = $model->date_out;
                             $newmodel->return_on = $model->return_on;
                             $newmodel->given_by = $model->given_by;
                             $newmodel->given_to = $model->given_to;
                             $newmodel->user_group = $model->user_group;
                             $newmodel->purpose = $model->purpose;
                             $newmodel->comments = $model->comments;

                             $newmodel->update();
                             //print_r($model2->getErrors());die;
                         }
                         Yii::app()->user->setFlash('success', "You have been allocated $quantity items with id $allocatedIDs");
                         //Yii::app()->request->redirect('http://localhost/asset_management/index.php/consumable/admin');
						 echo "<script type='text/javascript'>self.history.go(-2);</script>";
						 //Yii::app()->user->setFlash('success', "You have been allocated $quantity items with id $allocatedIDs");
                    }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Allocate');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                // page size drop down changed
                if (isset($_GET['pageSize'])) {
                    
                    Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
                    unset($_GET['pageSize']);  // would interfere with pager and repetitive page size change
                }
		$model=new Allocate('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Allocate'])) {
			$model->attributes=$_GET['Allocate'];
		}
		if ($this->isExportRequest()) { 
            $this->exportCSV($model->search(), array('consumable.name', 'date_in','date_out','return_on','user.name','stockname','purpose','comments'));
        }

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Allocate the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Allocate::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Allocate $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='allocate-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
		public function behaviors() {
    return array(
        'exportableGrid' => array(
            'class' => 'application.components.ExportableGridBehavior',
            'filename' => 'file.csv',
            'csvDelimiter' => ',', //i.e. Excel friendly csv delimiter
            ));
}

					public function actionGeneratePdf(){
		
		$this->layout = 'pdf';
		$model=new Allocate('search');
		if(isset($_GET['Allocate']))
		$model->attributes=$_GET['Allocate']; // to execute the filters (if is the case) 
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
}