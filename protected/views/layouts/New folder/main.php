<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
	<?php Yii::app()->bootstrap->register(); ?>

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
                    <?php echo CHtml::encode(Yii::app()->name.' '.Yii::app()->user->getState("org_name")); ?>
		</a>
                <?php $allCommodities = Commodity::model()->findAll();
                      foreach($allCommodities as $commodity){
                            $items[] = array(
                               'label'         => '<i class="icon-info-sign"></i> '.$commodity['name'],
                               'url'           => array('/'.$commodity['name'].'/admin'));
                      }
                ?>    
		<div class="nav-collapse collapse">
		<?php $this->widget('zii.widgets.CMenu', array(
                'items' => array(
                	array('label'=>'<i class="icon-home"></i> Home', 'url'=>array('/site/index')),
					array('label'=>'<i class="icon-info-sign"></i> About', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'<i class="icon-envelope"></i> Contact', 'url'=>array('/site/contact')),
                                        array('label'=>'<b class="icon-inbox"></b> Commodities <b class="caret"></b>',
                                            'url' => '#',
                                            'linkOptions'=> array(
                                                         'class' => 'dropdown-toggle',
                                                     'data-toggle' => 'dropdown',
                                                     ),
                                            'itemOptions' => array('class'=>'dropdown'),
                                            'items' => $items
                                         ),
                    array('label'=>'<b class="icon-inbox"></b> Administration <b class="caret"></b>',
                           'url' => '#',
                           'linkOptions'=> array(
	                           	'class' => 'dropdown-toggle',
	                            'data-toggle' => 'dropdown',
	                            ),
                           'itemOptions' => array('class'=>'dropdown'),
                           'items' => array(
                           		array('label' => '<i class="icon-map-marker"></i> Location',
	                                  'url' => array('/location/tree')),
                                        array('label' => '<i class="icon-user"></i> Suppliers',
	                                  'url' => array('/supplier/admin')),
                                        array('label' => '<i class="icon-user"></i> Manufacturers',
		                              'url' => array('/manufacturer/admin')),
                                        array('label' => '<i class="icon-folder-close"></i> Consumables',
		                              'url' => array('/consumable/admin')),
                                        array('label' => '<i class="icon-folder-close"></i> Commodities',
		                              'url' => array('/commodity/admin')),
                                        array('label' => '<i class="icon-folder-close"></i> Categories',
		                              'url' => array('/category/admin')),
	                        )
                    	),
					array('label'=>'<i class="icon-folder-close"></i> Manage <b class="caret"></b>',
                           'url' => '#',
                           'linkOptions'=> array(
	                           	'class' => 'dropdown-toggle',
	                            'data-toggle' => 'dropdown',
	                            ),
                           'itemOptions' => array('class'=>'dropdown'),
                           'items' => array(
                           		array('label' => '<i class="icon-user"></i> Users',
	                                      'url' => array('/user/admin')),
                                        array('label' => '<i class="icon-user"></i> Groups',
	                                      'url' => array('/group/admin')),
                                        array('label' => '<i class="icon-user"></i> Usergroups',
	                                      'url' => array('/usergroup/admin')),
                                        array('label' => '<i class="icon-tasks"></i> Blocked Items',
                                              'url' => array('/blockeditem/admin')),
                           		array('label' => '<i class="icon-tasks"></i> Statuses',
                                              'url' => array('/status/admin')),
                                        array('label' => '<i class="icon-tasks"></i> Currencies',
                                              'url' => array('/currency/admin')),
                                        array('label' => '<i class="icon-folder-close"></i> Consumable Types',
                                              'url' => array('/consumabletype/admin')),
                                        array('label' => '<i class="icon-folder-close"></i> Supplier Types',
                                              'url' => array('/suppliertype/admin')), 
                                        array('label' => '<i class="icon-folder-close"></i> Management Types',
                                              'url' => array('/managementtype/admin')),
	                            
	                        )
                    	),
					array('label'=>'<i class="icon-user"></i> Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'<i class="icon-user"></i> Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
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
