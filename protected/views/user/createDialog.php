<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'divDialog3',
                'options'=>array(
                    'title'=>Yii::t('user','Create New User'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
echo $this->renderPartial('_formDialog', array('model'=>$model)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>