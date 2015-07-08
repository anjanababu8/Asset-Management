<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'divDialog4',
                'options'=>array(
                    'title'=>Yii::t('manufacturer','Create New Manufacturer'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
echo $this->renderPartial('_formDialog', array('model'=>$model)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>