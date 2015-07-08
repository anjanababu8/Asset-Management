<?php

class BlockeditemController extends Controller
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
				'actions'=>array('create','update','admin','delete','customdelete','generatePdf'),
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
        public function renderButtonModify($data, $row) {
            $this->widget('bootstrap.widgets.TbButtonGroup', array(
              'size'=>'small',
              'type'=>'warning', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
              'buttons'=>array(
                 array('url'=>'http://localhost/asset_management/index.php/blockeditem/update/'.$data->id,'linkOptions' => array('submit' => array('/blockeditem/update', 'id'=>$data->id,'itemId' => $data->item_id)),
                        'icon'=>'icon-edit',
                        'title'=>'Modify'
                     ),
              ),
            ));
        }
        public function renderButtonUnBlock($data, $row) {
            $this->widget('bootstrap.widgets.TbButtonGroup', array(
              'size'=>'small',
      
              'type'=>'warning', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
              'buttons'=>array(
                 array('url'=>'http://localhost/asset_management/index.php/blockeditem/customdelete?id='.$data->id,'linkOptions' => array('submit' => array('/blockeditem/customdelete', 'id' => $data->id)),
                        'icon'=>'icon-trash',
                        
                     ),
              ),
            ));
        }
        public function actioncustomDelete($id)
	{
                $model = $this->loadModel($_GET['id']);
                $model->unblock_by = Yii::app()->user->getState("user_id");
                $model->unblock_on = date('Y-m-d');
                $model->update();
                
                /* Update the status of consumables*/
                /* Get the blocked items ids*/
                $sameItem = Blockeditem::model()->findAllByAttributes(array('item_id'=>$model->item_id,'unblock_by'=>NULL));
                
                if(count($sameItem) == 0){    
                    $commo = Commodity::model()->findByPk($model->commodity_id);
                    $m = $commo['name']::model()->findByPk($model->item_id);
                    $m->status_id = 1;
                    $m->update();
                }
                
                
                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if (!isset($_GET['ajax'])) {
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('blockeditem/admin?commodityId='.$model->commodity_id));
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
		$model=new Blockeditem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Blockeditem'])) {
                    $model->commodity_id=$_POST['Blockeditem']['commodity_id'];
                    $model->item_id=$_POST['Blockeditem']['item_id'];
                    $model->blocked_by=$_POST['Blockeditem']['blocked_by'];
                    $model->blocked_on=$_POST['Blockeditem']['blocked_on'];
                    $model->blocked_from=$_POST['Blockeditem']['blocked_from'];
                    $model->blocked_to=$_POST['Blockeditem']['blocked_to'];
                    
                    $commo = Commodity::model()->findByPk($model->commodity_id);
                    $item = $commo['name']::model()->findByPk($model->item_id);
                    $model->item_name = $item['name'];
                    
                    
                    
			//$model->attributes=$_POST['Blockeditem'];
			if ($model->validate()) {
                            /** Single Line **/
                            if(isset($_POST['Blockeditem']['block_group'])){
                                $grps=$_POST['Blockeditem']['block_group'];
                                $model->flag = 'G';
                                foreach ($grps as $grp){
                                    $singlemodel=new Blockeditem;
                                    $singlemodel->attributes = $model->attributes;
                                    $singlemodel->blocked_for = $grp;
                                    
                                    $commo = Commodity::model()->findByPk($model->commodity_id);
                                    $item = $commo['name']::model()->findByPk($model->item_id);
                                    $singlemodel->item_name = $item['name'];
                   
                                    $singlemodel->save();
                                }
                            }
                            if(isset($_POST['Blockeditem']['block_user'])){
                                //echo "<script>djsahdja</script>";die;
                                $users=$_POST['Blockeditem']['block_user'];
                                $model->flag = 'U';
                                foreach ($users as $user){
                                    $singlemodel=new Blockeditem;
                                    $singlemodel->attributes = $model->attributes;
                                    $singlemodel->blocked_for= $user;
                                    
                                    $commo = Commodity::model()->findByPk($model->commodity_id);
                                    $item = $commo['name']::model()->findByPk($model->item_id);
                                    $singlemodel->item_name = $item['name'];

                                    $singlemodel->save();
                                }
                            }
                            if(!isset($_POST['Blockeditem']['block_group']) && !isset($_POST['Blockeditem']['block_user'])){
                                $model->flag = 'A';
                                $model->save();
                              }
                            $commo = Commodity::model()->findByPk($model->commodity_id);  
                            $commodityName = $commo['name'];
                            $cons = $commodityName::model()->findByPk($model->item_id);  
                            $cons->status_id = 4;
                            $cons->update();
                         
                            Yii::app()->request->redirect("http://localhost/asset_management/index.php/$commodityName/admin");
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

		if (isset($_POST['Blockeditem'])) {
			$model->attributes=$_POST['Blockeditem'];
			if ($model->save()) {
				Yii::app()->request->redirect('http://localhost/asset_management/index.php/blockeditem/admin');
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
		$dataProvider=new CActiveDataProvider('Blockeditem');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Blockeditem('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Blockeditem'])) {
			$model->attributes=$_GET['Blockeditem'];
		}
		if ($this->isExportRequest()) { 
                    $this->exportCSV($model->search(), array( 'consumable.name','userby.name','blocked_on','blocked_from','blocked_to','unlock_by','unlock_on','flag'));
                }
		$this->render('admin',array(
			'model'=>$model,
		));
	
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Blockeditem the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Blockeditem::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Blockeditem $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='blockeditem-form') {
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
		$model=new Blockeditem('search');
		if(isset($_GET['Blockeditem']))
		$model->attributes=$_GET['Blockeditem']; // to execute the filters (if is the case) 
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