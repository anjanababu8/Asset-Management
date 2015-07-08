<?php 
$cs = Yii::app()->clientScript;
$cs->coreScriptPosition = CClientScript::POS_HEAD;
$cs->scriptMap = array();
$baseUrl = Yii::app()->getModule('gii')->assetsUrl; //the assets of existing module 
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerScriptFile($baseUrl . '/js_plugins/fancybox2/jquery.fancybox.pack.js'); 
$cs->registerCssFile($baseUrl . '/js_plugins/fancybox2/jquery.fancybox.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/popup.js');
echo "<div id='your-form-block-id'>";
echo CHtml::beginForm();
echo CHtml::link('an ajax test', array('consumable/texta'), array('class' => 'class-link'));
echo CHtml::endForm();
echo "</div>";
?>