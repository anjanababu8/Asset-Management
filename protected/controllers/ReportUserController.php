<?php

class ReportUserController extends Controller
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
				'actions'=>array('create','update','pdf','print'),
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
            $model=new ReportUser;
            if (isset($_POST['ReportUser'])) {
                $model->attributes = $_POST['ReportUser'];
                $report_name = $model->name;
                $description = $model->description;

                //txt_field_commodity : selected column field names
                //field_commodity : selected row ids;
                //commodity : item_ids
                
                $attributeArray = [];
                $fromTables = [];
                $whereClauses = [];
				
				/*************USER*****************/
                
                if(isset($_POST['txt_field_user'])){
                    $table = 'user';
                    $fromTables[] = '`user`';
                    $attributes = $_POST['txt_field_user'];
                    foreach($attributes as $attr){
                        $attributeArray[] = $table.'.'.$attr;
                    }

                    $rows = isset($_POST['user'])?$_POST['user']:[];
                    $whereArray1 = [];
                    foreach($rows as $item){
                        $whereArray1[] = $item;
                    }
                    $whereText1 = implode(',',$whereArray1);
					if($whereText1!='all')
                    $whereClauses[] = "user.id IN ($whereText1)";
                }
                /*************COMMODITY*****************/
                
                if(isset($_POST['txt_field_commodity'])){
                    $table = 'commodity';
                    $fromTables[] = '`commodity`';
                    $attributes = $_POST['txt_field_commodity'];
                    foreach($attributes as $attr){
                        $attributeArray[] = $table.'.'.$attr;
                    }

                    $rows = isset($_POST['commodity'])?$_POST['commodity']:[];
                    $whereArray1 = [];
                    foreach($rows as $item){
                        $whereArray1[] = $item;
                    }
                    $whereText1 = implode(',',$whereArray1);
					if($whereText1!='all')
                    $whereClauses[] = "commodity.id IN ($whereText1)";
                }
                /*******COMMODITY CATEGORY********/
                if(isset($_POST['txt_field_category'])){
                    $table = 'commodity_category';
                    $fromTables[] = '`commodity_category`';
                    $attributes = $_POST['txt_field_category'];
                    foreach ($attributes as $attribute){
                        $attributeArray[] = $table.'.'.$attribute;
                    }

                    $rows = isset($_POST['category'])?$_POST['category']:[];
                    $whereArray2 = [];
                    foreach($rows as $item){
                        $whereArray2[] = $item;
                    }
                    $whereText2 = implode(',',$whereArray2);
                    $whereClauses[] = "commodity.id = commodity_category.commodity_id";
					if($whereText2!='all')
                    $whereClauses[] = "commodity_category.id IN ($whereText2)";
                }
                
                /*******ITEMS********/
                if(isset($_POST['txt_field_consumable'])){
                    $table = 'consumable';
                    $fromTables[] = '`consumable`';
                    $attributes = $_POST['txt_field_consumable'];
                    foreach ($attributes as $attribute){
                        $attributeArray[] = $table.'.'.$attribute;
                    }
                    
                    $rows = isset($_POST['consumable'])?$_POST['consumable']:[];
                    $whereArray3 = [];
                    foreach($rows as $item){
                        $whereArray3[] = $item;
                    }
                    $whereText3 = implode(',', $whereArray3);
                    $whereClauses[] = "commodity.id = consumable.commodity_id AND commodity_category.path = consumable.category_id";
                    if($whereText3!='all')
					$whereClauses[] = "consumable.id IN ($whereText3)";
                }
				
				//on loan
					if(isset($_POST['new_stock']))
							$whereClauses[] = "consumable.available_on_loan = 'Yes'";
				
                $attributeText = implode(',', $attributeArray);
                $fromTableText = implode(',', $fromTables);
                $whereClauseText = implode(' AND ',$whereClauses);
				if($whereClauses==NULL)
					$whereClauseText=1;
                $model->query = "SELECT $attributeText FROM $fromTableText WHERE $whereClauseText";
                //echo $model->query;die;
            
                if($model->save())
                    $this->redirect(array('view','id'=>$model->rid));
        }
        $this->render('create', array(
            'model' => $model,
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

		if (isset($_POST['ReportUser'])) {
			$model->attributes=$_POST['ReportUser'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->rid));
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
		$dataProvider=new CActiveDataProvider('ReportUser');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ReportUser('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['ReportUser'])) {
			$model->attributes=$_GET['ReportUser'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Report the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ReportUser::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Report $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='reportuser-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionPrint() {


        $this->render('print');
    }

    public function actionPdf() {



        //$model = new Report;
        //$this->render('pdf');
        # mPDF



        if (isset($_POST['page_size'])) {
            $page_size = $_POST['page_size'];
        } else {
            $page_size = "A4";
        }

        if (isset($_POST['page_orient'])) {
            if ($_POST['page_orient'] == "L") {
                $pagesize_orient = $page_size . "-" . $_POST['page_orient'];
            } else {
                $pagesize_orient = $page_size;
            }
        } else {
            $pagesize_orient = $page_size;
        }



        //if(isset($page_size))
        //die();

        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', $pagesize_orient, '0', '', '15', '15', '15', '15', '', '', 'P');

        //$mPDF1->SetHeader('Header');
        // $mPDF1->setFooter('footer');


        $mpdf = new mPDF('c', 'A4-L');

        # render (full page)
        //$mPDF1->WriteHTML($this->render('test', array(''=>'',), true));
        # Load a stylesheet
        // $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        // $mPDF1->WriteHTML($stylesheet, 1);
        # renderPartial (only 'view' of current controller)
        $mPDF1->WriteHTML($this->renderPartial('pdf', array('' => ''), true));

        # Renders image
        // $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
        # Outputs ready PDF
        $mPDF1->Output();
    }

	public function actionDatepick() {

        $model = new Date;
        $this->renderPartial('_newDate', array(
            'model' => $model,
                ), false, true);
    }

    public function actionDatepickto() {

        $model = new Date;
        $this->renderPartial('_newDateto', array(
            'model' => $model,
                ), false, true);
    }

    public function actionBackbtn() {
        $qry = $_POST['qry'];
        $column = $_POST['hdn_columns'];
        $report_name = $_POST['reportuser_name'];
        $model = new ReportUser;
        $this->render('test', array(
            'model' => $model,));
    }

    public function actionBackbtnview() {
        //$qry=$_POST['qry'];
        //$column=$_POST['hdn_columns'];
        $id = $_POST['id'];
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
}