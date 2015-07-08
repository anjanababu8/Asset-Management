<?php

class UserController extends Controller
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
				'actions'=>array('create','update','admin','delete','addnew','dynamicrows','generatePdf','viewpage'),
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
        public function actionViewPage()
        {
           $this->render('viewpage',array(
			'code'=>'Administration',
		)); 
            
            
            
        }
        public function actionDynamicRows()
        {
            $selectionid = $_POST['selection'];
            
            $depts = Dept::model()->findAllByAttributes(array('orgid'=>$selectionid));
            
            foreach ($depts as $row) {
                $dataOptions[$row->id] = $row->name;
            }

            foreach($dataOptions as $value=>$name) {
            $opt = array();
            $opt['value'] = $value;
            echo CHtml::tag('option', $opt , CHtml::encode($name),true);
            }
            die;
        }
        public function actionAddnew() {
            $model=new User;
            // Ajax Validation enabled
            $this->performAjaxValidation($model);
            // Flag to know if we will render the form or try to add 
            // new jon.
            $flag=true;
            if(isset($_POST['User']))
            {       $flag=false;
                $model->attributes=$_POST['User'];

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
		$model=new User;
		$model1=new Usergroup;
		if(isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
                        $model->pw_md5 = md5($_POST['User']['password']);
			if($model->validate()){
                            $model->save();

                            /* ADD TO USERGROUP TABLE*/ 
                            if(isset($_POST['User']['g_id'])){
                                $grps=$_POST['User']['g_id'];
                                foreach ($grps as $grp){
                                    $model1=new Usergroup();
                                    $model1->uid=$model->id;
                                    $model1->gid=$grp;
                                    $model1->save();
                                }
                            }
                            /* ADD TO USERDEPT TABLE*/ 
                            if(isset($_POST['User']['dept_id'])){
                                $depts=$_POST['User']['dept_id'];
                                foreach ($depts as $d){
                                    $model1=new Userdept();
                                    $model1->uid=$model->id;
                                    $model1->dept_id=$d;
                                    $model1->save();
                                }
                            }

                            if($model->save()) {
                                $this->redirect(array('view','id'=>$model->id));
                            }
                        }
                }   
                
		$this->render('create',array(
			'model'=>$model,
			'model1'=>$model1
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

		if (isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
                        $model->pw_md5 = md5($_POST['User']['password']);
			if ($model->save()) {
                            /* REMOVE PAST GRPS*/
                            $pastGrps = Usergroup::model()->findAllByAttributes(array('uid'=>$id));
                            foreach($pastGrps as $ug){
                                $m = Usergroup::model()->findByPk($ug['id']);
                                $m->delete();
                            }
                            
                            /* ADD NEW GRPS */
                            if(isset($_POST['User']['g_id'])){
                                $grps=$_POST['User']['g_id'];
                                foreach ($grps as $grp){
                                    $model1=new Usergroup();
                                    $model1->uid=$model->id;
                                    $model1->gid=$grp;
                                    $model1->save();
                                }
                            }    
                            
                            /* REMOVE PAST DEPTS*/
                            $pastDepts = Userdept::model()->findAllByAttributes(array('uid'=>$id));
                            foreach($pastDepts as $ud){
                                $m = Userdept::model()->findByPk($ud['id']);
                                $m->delete();
                            }
                            
                            /* ADD NEW DEPTS */
                            if(isset($_POST['User']['dept_id'])){
                                $depts=$_POST['User']['dept_id'];
                                foreach ($depts as $d){
                                    $model1=new Userdept();
                                    $model1->uid=$model->id;
                                    $model1->dept_id=$d;
                                    $model1->save();
                                }
                            }
                            
                            $this->redirect(array('view','id'=>$model->id));
			}
		}else{
                    $grpsRow = Usergroup::model()->findAllByAttributes(array('uid'=>$id));
                    $grps = [];
                    foreach($grpsRow as $row){
                        $grps[] = $row['gid'];
                    }
                    $model->g_id = $grps;
                    
                    $deptsRow = Userdept::model()->findAllByAttributes(array('uid'=>$id));
                    $depts = [];
                    foreach($deptsRow as $row){
                        $depts[] = $row['dept_id'];
                    }
                    $model->dept_id = $depts;
                    
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
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['User'])) {
			$model->attributes=$_GET['User'];
		}

			if ($this->isExportRequest()) { 
            $this->exportCSV($model->search(), array( 
		'name',
        'fn',
		'ln',
		'password',
		'pw_md5',
        'organisation_id',
		'email',
		'phone',
		'phones',
		'mobile',
		
		'active',
		'id_auth',
		'auth_method',
		'last_login',
		'date_mod',
		'designation',
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
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='user-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
		public function actionGeneratePdf(){
		
		$this->layout = 'pdf';
		$model=new User('search');
		if(isset($_GET['User']))
		$model->attributes=$_GET['User']; // to execute the filters (if is the case) 
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