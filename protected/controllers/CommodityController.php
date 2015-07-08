<?php

class CommodityController extends Controller
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
                $model=new Commodity;
                
		if(isset($_POST['Commodity'])) {
                        $model->attributes=$_POST['Commodity'];
                
                        if($_POST['Commodity']['categories'] !=='') 
                            $model->categories=implode(',',$_POST['Commodity']['categories']); //to string
                        
                        $model->save();
                        
                        $categories=$_POST['Commodity']['categories'];
                        $count = count($categories);
                        //$categoryNames = "";
			foreach ($categories as $category){
                            $comcat_model = new CommodityCategory;
                            $comcat_model->commodity_id = $model->id;
                            $comcat_model->category_id = $category;
							
                            $temp2=$comcat_model->commodity_id;
                            $temp=$comcat_model->category_id;
                            $newmodel = Category::model()->findByAttributes(array('id'=>$temp));
							$newmodel3 = Category::model()->findByAttributes(array('id'=>1));
                            if($category==1)
                                  $comcat_model->path = $newmodel->name;
			    else if($category==2)
								$comcat_model->path = $newmodel3->name."->".$newmodel->name;
                            else
                            {
                                  $newmodel1 = CommodityCategory::model()->findByAttributes(array('category_id'=>$temp-1,'commodity_id'=>$temp2));
                                  $comcat_model->path = $newmodel1->path."->".$newmodel->name;
                                  //$comcat_model->path = $newmodel->name;
                            }
                            //$categoryNames .= $comcat_model->path.',';
                            $comcat_model->save();
                        }
                        //$model->categoryname = $categoryNames;
                        if($model->save()){
                            $this->redirect('http://localhost/asset_management/index.php/new?commodityId='.$model->id);
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

		if (isset($_POST['Commodity'])) {
			$model->attributes=$_POST['Commodity'];
			if($_POST['Commodity']['categories'] !=='') 
                            $model->categories=implode('  ,  ',$_POST['Commodity']['categories']); //to string
                        
                        $model->save();
                        
                        $categories=$_POST['Commodity']['categories'];
                        $count = count($categories);
			foreach ($categories as $category){
                            $comcat_model = new CommodityCategory;
                            $comcat_model->commodity_id = $model->id;
                            $comcat_model->category_id = $category;
                            
                            
                            $temp2=$comcat_model->commodity_id;
                            $temp=$comcat_model->category_id;
                            $newmodel = Category::model()->findByAttributes(array('id'=>$temp));
                       
                            if($category==1)
                                  $comcat_model->path = $newmodel->name;
                            else
                            {
                                  $newmodel1 = CommodityCategory::model()->findByAttributes(array('category_id'=>$temp-1,'commodity_id'=>$temp2));
                                  $comcat_model->path = $newmodel1->path."->".$newmodel->name;
                                  //$comcat_model->path = $newmodel->name;
                            }
                            
                            
                            
                            $comcat_model->save();
                            
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
		$dataProvider=new CActiveDataProvider('Commodity');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Commodity('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Commodity'])) {
			$model->attributes=$_GET['Commodity'];
		}
		if ($this->isExportRequest()) { 
            $this->exportCSV($model->search(), array( 'name',
		'description',
		'organisation.name',
		'categories',
            'categoryname',
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
	 * @return Commodity the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Commodity::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Commodity $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='commodity-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionGeneratePdf(){
		
		$this->layout = 'pdf';
		$model=new Commodity('search');
		if(isset($_GET['Commodity']))
		$model->attributes=$_GET['Commodity']; // to execute the filters (if is the case) 
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