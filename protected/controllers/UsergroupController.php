<?php

class UsergroupController extends Controller
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
				'actions'=>array('create','update','admin','delete','listbuilder','moveusers','generatePdf'),
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

	public function actionListbuilder(){
		$model=new Usergroup;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Usergroup'])) {
			$model->attributes=$_POST['Usergroup'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('listbuilder',array(
			'model'=>$model,
		));

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
		$model=new Usergroup;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Usergroup'])) {
			$model->attributes=$_POST['Usergroup'];
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

		if (isset($_POST['Usergroup'])) {
			$model->attributes=$_POST['Usergroup'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}else{ /*load groups*/
                    
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
		$dataProvider=new CActiveDataProvider('Usergroup');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usergroup('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Usergroup'])) {
			$model->attributes=$_GET['Usergroup'];
		}

			if ($this->isExportRequest()) { 
            $this->exportCSV($model->search(), array( 
			              'user.name',
							'group.name',
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
	 * @return Usergroup the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usergroup::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Usergroup $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='usergroup-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        /**
	 * Move users between Australia and New Zealand.
	 * This method is used by XMultiSelects widget.
	 */
	public function actionMoveUsers()
	{
            // 1. Delete the users which were already present but not present now
            // 2. Add new users
            // 3. Maintain the current user
            if(isset($_POST['Usergroup']['groupusers'])) 
            {
                $presentGroupUsers = $_POST['Usergroup']['groupusers'];//contains uids
                
                foreach($presentGroupUsers as $user){
                    //1. Check already a group member?
                    $allreadyMember = Usergroup::model()->find('uid =:uid AND gid =:gid',array(':uid'=>$user,':gid'=>$_GET['groupId']));
                    if(!isset($allreadyMember['id']))
                        Usergroup::model()->updateUserGroup($user, $_GET['groupId'],1); //Add
                }
                
                
                //3. User Removed?
                        $pgu = implode(',',$presentGroupUsers);
                        $removedUsers = User::model()->findAll(array(
                            'select'=>'id',
                            'condition'=>"id NOT IN($pgu)",
                            ));
                if(count($removedUsers) == 0);
                else{
                    foreach($removedUsers as $user){// remove
                        $a = $user['id'];
                        Usergroup::model()->updateUserGroup($a,$_GET['groupId'],0);
                    }
                }
            }
            //Yii::app()->user->setFlash('saved',Yii::t('ui','Data successfully saved!'));
            $this->redirect(array('usergroup/admin'));
	}

	public function actionGeneratePdf(){
		
		$this->layout = 'pdf';
		$model=new Usergroup('search');
		if(isset($_GET['Usergroup']))
		$model->attributes=$_GET['Usergroup']; // to execute the filters (if is the case) 
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