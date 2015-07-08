<?php

class ConsumableController extends Controller
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
				'actions'=>array('create','update','admin','delete','loadImage','admin2','generatePdf'),
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
		$model=new Consumable('search');
                $stockname = Stockname::model()->findByAttributes(array('commodity_id'=>3));
                $model->prefix = $stockname['prefix'];
    
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Consumable'])) {
                    $model->attributes=$_GET['Consumable'];
                    
		}
                $this->render('admin2',array(
			'model'=>$model,
		));
		
	}
	public function actionTextA() {
        if (!Yii::app()->request->isAjaxRequest)
            $this->render('yourView');
        else {
            $this->renderPartial('yourView');
            Yii::app()->end();
        }
    }
    public function actionloadImage($id)
    {
        $model=$this->loadModel($id);
		$this->renderPartial('image', array(
            'model'=>$model
        ));
    }
 
    public function actionTestPopUp() {
        $this->render('popup.php');
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
		$model=new Consumable;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if (isset($_POST['Consumable'])) {
			$model->attributes=$_POST['Consumable'];
                        
                        $model->commodity_id = $_POST['Consumable']['commodity_id'];

			if(!empty($_FILES['Consumable']['tmp_name']['image'])){
                                $file = CUploadedFile::getInstance($model,'image');
                                $model->imageFileName = $file->name;
                                $model->imageFileType = $file->type;
                                $fp = fopen($file->tempName, 'r');
                                $content = fread($fp, filesize($file->tempName));
                                fclose($fp);
                                $model->image = $content;
                            }
 			if(!empty($_FILES['Consumable']['tmp_name']['document'])){
                                $file = CUploadedFile::getInstance($model,'document');
                                $model->documentFileName = $file->name;
                                $model->documentFileType = $file->type;
                                $fp = fopen($file->tempName, 'r');
                                $content = fread($fp, filesize($file->tempName));
                                fclose($fp);
                                $model->document = $content;
                            }

                        //$model->user = Yii::app()->user->id;
                            
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
                                
			}
		}
                    
		$this->render('create',array(
			'model'=>$model,
			//'types'=>Type::model()->findAll(),
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

		if (isset($_POST['Consumable'])) {
			$model->attributes=$_POST['Consumable'];
                     
			if(!empty($_FILES['Consumable']['tmp_name']['image'])){
                                $file = CUploadedFile::getInstance($model,'image');
                                $model->imageFileName = $file->name;
                                $model->imageFileType = $file->type;
                                $fp = fopen($file->tempName, 'r');
                                $content = fread($fp, filesize($file->tempName));
                                fclose($fp);
                                $model->image = $content;
                            }
 			if(!empty($_FILES['Consumable']['tmp_name']['document'])){
                                $file = CUploadedFile::getInstance($model,'document');
                                $model->documentFileName = $file->name;
                                $model->documentFileType = $file->type;
                                $fp = fopen($file->tempName, 'r');
                                $content = fread($fp, filesize($file->tempName));
                                fclose($fp);
                                $model->document = $content;
                            }


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
			//$this->loadModel($id)->delete();
                        $model = $this->loadModel($id);
                        $model->is_deleted = 1;
                        $model->update();
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
		$dataProvider=new CActiveDataProvider('Consumable');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function renderButtons($data, $row) {
            //$getAllocatedItem = Allocate::model()->findByAttributes(array('cons_id'=>$data->id,'date_out'=>NULL));
                $getAllocatedItem = Allocate::model()->find('cons_id = :cons_id AND (date_out IS NULL OR date_out = :date_out)',array(':cons_id' => $data->id,':date_out'=>'0000-00-00'));
                //$getConsStatus = Consumable::model()->find('id = :id',array(':id' => $data->id)); 
                //$status = Status::model()->find('id = :id',array(':id' => $getConsStatus['status_id']));
                
                
                $canAllocate = ($getAllocatedItem['allocate_id'])? true: false;
              
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
		  'size'=>'small',
		  'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		  'buttons'=>array(
		     array('label'=>'Action', 'items'=>array(
		     	array('label'=>'Transfer Item', 'url'=>Yii::app()->homeUrl.'/transferCons/create',
                                                'linkOptions' => array('submit' => array('/transferCons/create', 'itemId' => $data->id,'commodity_id'=>$data->commodity_id))),
		     	array('label'=>'Block for All', 'url'=>Yii::app()->homeUrl.'/blockeditem/create',
                                                'linkOptions' => array('submit' => array('/blockeditem/create', 'id' => 1, 'itemId'=>$data->id,'commodity_id'=>$data->commodity_id))),
		     	array('label'=>'Block for User/Group', 'url'=>Yii::app()->homeUrl.'/blockeditem/create',
                                                'linkOptions' => array('submit' => array('/blockeditem/create', 'id' => 2,'itemId'=>$data->id,'commodity_id'=>$data->commodity_id))),
		        array('label'=>'Add to Stock', 'url'=>Yii::app()->homeUrl.'/consumablestock/create',
                                                'linkOptions' => array('submit' => array('/consumablestock/create', 'itemId' => $data->id,'commodity_id'=>$data->commodity_id))),
		        array('label'=>'Allocate', 'url'=> $canAllocate? Yii::app()->homeUrl.'/allocate/create': NULL,                        
                                                'linkOptions' => array('submit' => array('/allocate/update/'.$getAllocatedItem['allocate_id'].'?allocateId='.$getAllocatedItem['allocate_id'].'&commodity_id='.$data->commodity_id),
                                                                )),
		        array('label'=>'View Allocate History', 'url'=>Yii::app()->homeUrl.'/allocate/admin',
                                            'linkOptions' => array('submit' => array('/allocate/admin','itemId'=>$data->id,'commodity_id'=>$data->commodity_id)))
                                            ),
		  ),
		)));
                
	}

        public function getAvailableQuantity($data, $row) {
            $getAllocatedItem = Allocate::model()->findAll('cons_id = :cons_id AND commodity_id =:commodity_id AND (date_out IS NULL OR date_out = :date_out)',array(':cons_id' => $data->id,':commodity_id'=>$data->commodity_id,'date_out'=>'0000-00-00'));
            if(count($getAllocatedItem) == 0)
                echo "<i style='font-size:12px;color:red'>Out of Stock</i>";
            else 
                echo "<b style='font-size:18px;'>".count($getAllocatedItem)."</b";
                  
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

		$model=new Consumable('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Consumable'])) {
                    $model->attributes=$_GET['Consumable'];
		}
		if ($this->isExportRequest()) { 
            $this->exportCSV($model->search(), array(
			'location.name',
                'commodity.name',
                'category_id',
             'category.name',
		'user.name',
		'status.status',
		'manufacturer.name',
		'consumabletype.name',
		'managementtype.name',
		'model',
		'threshold',
		'imageFileName',
		'documentFileName',
		'enable_financial',
		'available_on_loan',
		'semi_consumable',
			));
        }
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Consumable the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Consumable::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Consumable $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='consumable-form') {
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
        $model=new Consumable('search');
        if(isset($_GET['Consumable']))
        $model->attributes=$_GET['Consumable']; // to execute the filters (if is the case) 
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