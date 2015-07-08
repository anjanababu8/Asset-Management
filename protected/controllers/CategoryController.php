<?php

class CategoryController extends Controller
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
				'actions'=>array('create','update','admin','delete','addnew','generatePdf'),
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
        public function actionAddnew() {
                $model=new Category;
        // Ajax Validation enabled
        $this->performAjaxValidation($model);
        // Flag to know if we will render the form or try to add 
        // new jon.
                $flag=true;
        if(isset($_POST['Category']))
        {       $flag=false;
            $model->attributes=$_POST['Category'];
 
            if($model->save()) {
                //Return an <option> and select it
                            echo CHtml::tag('option',array (
                                'value'=>$model->id,
                                'selected'=>true
                            ),CHtml::encode($model->name),true);
                        }
                }
                if($flag) {
                    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                    $this->renderPartial('createDialog',array('model'=>$model,),false,true);
                }
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
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Category'])) {
			$model->attributes=$_POST['Category'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
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

		if (isset($_POST['Category'])) {
			$model->attributes=$_POST['Category'];
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
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	
	/*public static function getListTreeView() {
        if (empty(self::$catTree)) {
            self::getCategoryTree();
        }
        return self::visualTree(self::$catTree, 0);
 }
 
    private static function visualTree($catTree, $level) {
        $res = array();
        foreach ($catTree as $item) {
            $res[$item['id']] = '' . str_pad('', $level * 2, '-') . ' ' . $item['label'];
            if (isset($item['items'])) {
                $res_iter = self::visualTree($item['items'], $level + 1);
                foreach ($res_iter as $key => $val) {
                    $res[$key] = $val;
                }
            }
        }
        return $res;
    }
	*/
	
	
	
	
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Category'])) {
			$model->attributes=$_GET['Category'];
		}
		if ($this->isExportRequest()) { 
            $this->exportCSV($model->search(), array( 'name',
		'descr',
		'pid',
		'getparent.name',
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
	 * @return Category the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
		
		$model = Category::model()->findByPk(1);
		$items[] = $model->getListed(); // note that the [] is important, otherwise CMenu will crash.
 
		$this->widget('application.extensions.CDropDownMenu',array('items'=>$items,));
		
		
	}

	/**
	 * Performs the AJAX validation.
	 * @param Category $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='category-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionGeneratePdf(){
		
		$this->layout = 'pdf';
		$model=new Category('search');
		if(isset($_GET['Category']))
		$model->attributes=$_GET['Category']; // to execute the filters (if is the case) 
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