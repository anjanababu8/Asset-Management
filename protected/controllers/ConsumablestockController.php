<?php

class ConsumablestockController extends Controller
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
				'actions'=>array('create','update','admin','delete','generatePdf'),
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
		$model=new Consumablestock;
                //$allocate = new Allocate;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

                /*Executed when you have data SUBMITTED*/
		if (isset($_POST['Consumablestock'])) {
			$model->attributes=$_POST['Consumablestock'];
			
			$model->commodity_id =$_GET['commodity_id'];
                        
			if(!empty($_FILES['Consumablestock']['tmp_name']['document'])){
                                $file = CUploadedFile::getInstance($model,'document');
                                $model->documentFileName = $file->name;
                                $model->documentFileType = $file->type;
                                $fp = fopen($file->tempName, 'r');
                                $content = fread($fp, filesize($file->tempName));
                                fclose($fp);
                                $model->document = $content;
                        }
                        
			if ($model->save()) {
                            $stocknameRow = Stockname::model()->findByAttributes(array('commodity_id'=>$model->commodity_id)); /***********Change dynamically**/
                            $consumable = Consumable::model()->findByAttributes(array('id'=>$model->consumable_id));
                            for($i=1;$i<=$model->quantity;$i++){
                                $allocate = new Allocate;
                                $allocate->commodity_id=$model->commodity_id;
                                $allocate->cons_id=$model->consumable_id;
                                $allocate->id=$i;
                                $allocate->stock_id=$model->id; 
                                $allocate->date_in=$model->date_in;
                                
                                $allocate->stockname = $stocknameRow['prefix'].$consumable['name'].'/'.$allocate->id;
                                $allocate->barcode = Common::getItemBarcode(array("itemId"=>$allocate->allocate_id , "barcode"=>$allocate->stockname));
                                $allocate->save();
								
                                //print_r($allocate->getErrors());die;
                               }
                            //Yii::app()->request->redirect('http://localhost/asset_management/index.php/consumable/admin');
							//Yii::app()->request->redirect('Yii::app()->request->returnUrl');
							//Yii::app()->request->return;
							echo "<script type='text/javascript'>self.history.go(-2);</script>";
							
			}
		}
                
                /*Executed when you want to create*/
		$this->render('create',array(
			'model'=>$model
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

		if (isset($_POST['Consumablestock'])) {
			$model->attributes=$_POST['Consumablestock'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Consumablestock');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Consumablestock('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Consumablestock'])) {
			$model->attributes=$_GET['Consumablestock'];
		}
		if ($this->isExportRequest()) { 
            $this->exportCSV($model->search(), array( 
			'consumable.name',
		'po_number',
		'unit_cost',
		'quantity',
		'supplier.name',
		'warranty',
		'date_in',
		'expiry_date',
		'inventory_no',
		'status.status',
		'documentFileName',
			));
        }

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function behaviors() {
    return array(
        'exportableGrid' => array(
            'class' => 'application.components.ExportableGridBehavior',
            'filename' => 'file.csv',
            'csvDelimiter' => ',', //i.e. Excel friendly csv delimiter
            ));
}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Consumablestock the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Consumablestock::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Consumablestock $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='consumablestock-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionGeneratePdf(){
		
		$this->layout = 'pdf';
		$model=new Consumablestock('search');
		if(isset($_GET['Consumablestock']))
		$model->attributes=$_GET['Consumablestock']; // to execute the filters (if is the case) 
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