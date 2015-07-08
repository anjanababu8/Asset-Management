<?php

class LabelController extends Controller
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
				'actions'=>array('create','update','printlabel','printallform','showlabel','dynamicrows2','dynamicrows','generatePdf'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        public function actionDynamicRows2()
    {
    	$selectionid = $_POST['selection'];
        $fileType = FileType::model()->findByAttributes(array('id'=>$selectionid));
        if(count($fileType) != 0){
            $lw = $fileType['label_width']; $lh = $fileType['label_height'];
            echo "<span class='label label-info'> Label Size:$lh px X $lw px</span>";	
        }else{
            echo "<span class='label label-info'>Default : Label Size:100 px X 50 px</span>";	
        }
        die;
    }
        public function actionDynamicRows()
        {
            $selectionid = $_POST['selection'];
            $deptRow = Dept::model()->find('id=:id',array(':id'=>$selectionid));

            $connection=Yii::app()->db;
            $sql = "select ID,TITLE from fopen WHERE DEPARTMENT='".$deptRow['name']."'";
            $command = $connection->createCommand($sql);
            $dataReader = $command->queryAll();
            //$newArray = array(''=>'--- Select File Names ---');
            $newArray = [];
            foreach($dataReader as $data){
                $newArray[$data['ID']] = $data['TITLE'];
            }

            foreach($newArray as $value=>$name) {
                $opt = array();
                $opt['value'] = $value;
                echo CHtml::tag('option', $opt , CHtml::encode($name),true);
            }
            die;
        }
         
        
        /* PRINT ALL LABEL FORM*/
        public function actionPrintAllForm()
        { /**Open Form**/
            $model = new Label;
            $this->render('_printallform',array('model'=>$model));
        }
        public function actionPrintAllScreen()
        { /**Open Form**/
            $model = new Label;
            $this->render('_printall',array('model'=>$model));
        }
        
	public function actionShowLabel()
	{
                $model = new Label;
                $model->attributes = $_POST['Label'];
		$this->render('_showlabel',array('labelParams'=>$_POST['Label']));
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
		$model=new Label;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Label'])) {
			$model->attributes=$_POST['Label'];
			$model->fid=$_GET['itemId'];
			
			
			//print_r($_POST['Label']['fields']);die;
			$model->fields = implode(',',$_POST['Label']['fields']);
			
			if ($model->save()) {
				$this->render('label');

			}
		}else{

		$this->render('create',array(
			'model'=>$model,
		));
                }
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

		if (isset($_POST['Label'])) {
			$model->attributes=$_POST['Label'];
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
		$dataProvider=new CActiveDataProvider('Label');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Label('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Label'])) {
			$model->attributes=$_GET['Label'];
		}
	if ($this->isExportRequest()) { 
            $this->exportCSV($model->search(), array( 
			'id',
		'fields',
		'fid',
		'size',
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
	 * @return Label the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Label::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Label $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='label-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionGeneratePdf(){
		
		$this->layout = 'pdf';
		$model=new Label('search');
		if(isset($_GET['Label']))
		$model->attributes=$_GET['Label']; // to execute the filters (if is the case) 
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