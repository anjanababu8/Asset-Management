<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
	<?php Yii::app()->bootstrap->register(); 
        $jqueryslidemenupath = Yii::app()->assetManager->publish(Yii::app()->basePath.'/scripts/jqueryslidemenu/');
	
	//Register jQuery, JS and CSS files
	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerCssFile($jqueryslidemenupath.'/jqueryslidemenu.css');	
	Yii::app()->clientScript->registerScriptFile($jqueryslidemenupath.'/jqueryslidemenu.js');?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
		<div class="container">
		<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="brand" href="<?php echo Yii::app()->homeUrl;?>">
                    <?php echo "AM ".Yii::app()->user->getState("org_name"); ?>
		</a>
                <?php $allCommodities = Commodity::model()->findAllByAttributes(array('is_deleted'=>0));
                      foreach($allCommodities as $commodity){
                          
                          $commodityName = lcfirst($commodity['name']);
                          $notDeletedCategories = MyUtility::getNotDeleted('category');
                          
                          $categories = CommodityCategory::model()->findAllByAttributes(array('commodity_id'=>$commodity['id'],'category_id'=>$notDeletedCategories));
                          foreach($categories as $cat){
                                //$categoryRow = Category::model()->findByAttributes(array('id'=>$cat['category_id']));
                                $categoryList[] = array(
                               'label'         => '<i class="icon-info-sign"></i> '.$cat['path'],
                               'url'           => array("/$commodityName/admin",'category_id'=>$cat['path']));
                          }
                           $categoryList[] = array(
                               'label'         => '<i class="icon-info-sign"></i> Show All',
                               'url'           => array('/'.$commodity['name'].'/admin'));
                          $items[] = array(
                               'url'=> array('/'.$commodity['name'].'/admin'),
                               'label'         => ' <i class="icon-info-sign"></i> '.$commodity['name'],
                                'items' => $categoryList); $categoryList = array();
                      }
                      $items[]=array('label'         => '<i class="icon-info-sign"></i> files',
                               'url'           => array("/fm/entry/index/form/16",'category_id'=>$cat['path']));
                      
                ?>    
		<!--div class="nav-collapse collapse"-->
                    <div id="myslidemenu" class="jqueryslidemenu">
		<?php $this->widget('zii.widgets.CMenu', array(
                'items' => array(
                	array('label'=>'<i class="icon-home"></i> Home', 'url'=>array('/dash')),
                        //array('label'=>'<i class="icon-dashboard"></i> Dashboard', 'url'=>array('/dash')),    
                        array('label'=>'<b class="icon-inbox"></b> Commodities',
                            'url' => '#',
                            'linkOptions'=> array(
                                         'class' => 'dropdown-toggle',
                                     'data-toggle' => 'dropdown',
                                     ),
                            'itemOptions' => array('class'=>'dropdown'),
                            'items' => $items
                         ),
                    
                    array('label'=>'<b class="icon-inbox"></b> Administration ',
                           'url' => array('/user/viewpage'),
                           'items' => array(
                           		array('label' => '<i class="icon-map-marker"></i> Location',
	                                  'url' => array('/location/tree')),
                                        array('label' => '<i class="icon-user"></i> Suppliers',
	                                  'url' => array('/supplier/admin')),
                                        array('label' => '<i class="icon-user"></i> Manufacturers',
		                              'url' => array('/manufacturer/admin')),
                                        array('label' => '<i class="icon-folder-close"></i> Commodities',
		                              'url' => array('/commodity/admin')),
                                        array('label' => '<i class="icon-folder-close"></i> Categories',
		                              'url' => array('/category/admin')),
                           		array('label' => '<i class="icon-user"></i> Users',
	                                      'url' => array('/user/admin')),
                                        array('label' => '<i class="icon-users"></i> Groups',
	                                      'url' => array('/group/admin')),
                                        array('label' => '<i class="icon-user"></i> Departments',
	                                      'url' => array('/dept/admin')),
                                        array('label' => '<i class="icon-user"></i> Organisations',
	                                      'url' => array('/organisation/admin')),
                                        array('label' => '<i class="icon-tasks"></i> Status',
                                              'url' => array('/status/admin')),
                                              
                                              
	                        )
                    	),
				
                        array('label'=>'<i class="icon-cog"></i> Settings',
                           'url' => '#',
                           'linkOptions'=> array(
	                        'class' => 'dropdown-toggle',
	                        'data-toggle' => 'dropdown',),
                           'itemOptions' => array('class'=>'dropdown'),
                           'items' => array(
                                        array('label' => '<i class="icon-print"></i> Paper Type',
	                                  'url' => array('/papertype/admin')),
                                        array('label' => '<i class="icon-print"></i> Print Label',
	                                  'url' => array('/label/printallform')),
                           		array('label' => '<i class="icon-tasks"></i> Set Stock Name',
	                                  'url' => array('/stockname/create')),
                                        array('label' => '<i class="icon-barcode"></i> Set Barcode',
	                                  'url' => array('/barcodedetail/create')),
                                        array('label' => '<i class="icon-tasks"></i> Link Commodity',
	                                  'url' => array('/link/admin')),
                                        array('label' => '<i class="icon-inr"></i> Currencies',
                                              'url' => array('/currency/admin')),
                                          
                                          
	                        )
                    	),
                    array('label' => '<i class="icon-folder-close"></i> Report',
		                              'url' => array('/report/admin'),
                                              'items'=> array(
                                                  array('label' => '<i class="icon-folder-close"></i> Full Report',
                                                  'url' => array('/report/admin')),
                                                  array('label' => '<i class="icon-folder-close"></i> User Report',
                                                  'url' => array('/reportuser/admin')),
                                                  array('label' => '<i class="icon-folder-close"></i> Location Report',
                                                  'url' => array('/reportloc/admin')),
                                                  )  
                                            ),
                    array('label' => '<i class="icon-folder-close"></i> Files',
		                              'url' => array(''),
                                              'items'=> array(
                                                  array('label' => '<i class="icon-tasks"></i> File Open',
	                                  'url' => array('/fm/entry/index/form/16')),
                                                  array('label' => '<i class="icon-tasks"></i> File Type',
	                                  'url' => array('/filetype/admin')),
                                        array('label' => '<i class="icon-tasks"></i> File Status',
	                                  'url' => array('/filestatus/admin')),
                                        array('label' => '<i class="icon-tasks"></i> File Schedule',
	                                  'url' => array('/filemaintenanceschedule/admin')), 
                                         
                                                  )  
                                            ),
                    /*array('label' => '<i class="icon-folder-close"></i> Files',
                                          'items'=> array('label' => '<i class="icon-tasks"></i> File Open',
	                                  'url' => array('/fm/entry/index/form/16')),
                                        ,*/
                    
                        array('label'=>'<i class="icon-user"></i> Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'<i class="icon-arrow-right"></i> Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                	),
                'encodeLabel' => false,
                'htmlOptions' => array('class'=>'nav pull-left'),
                'submenuHtmlOptions' => array('class' => 'dropdown-menu')
            ));?>
		</div>
		</div>
		</div>
	</div><!-- mainmenu -->

	<div class="container">
		<div class="page-header">
		<br/><br/>
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>
		</div>
		<?php echo $content; ?>

		<!--div class="clear"></div-->

		<!--div class="footer text-center">
			Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
			All Rights Reserved.<br/>
			<?php echo Yii::powered(); ?>
		</div--><!-- footer -->
	</div>

</div><!-- page -->

</body>
</html>
