<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'divDialog6',
                'options'=>array(
                    'title'=>Yii::t('location','Create New Location'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
echo $this->renderPartial('_formDialog', array('model'=>$model)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>