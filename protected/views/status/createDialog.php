<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'divDialog2',
                'options'=>array(
                    'title'=>Yii::t('status','Create New Status'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
echo $this->renderPartial('_formDialog', array('model'=>$model)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>