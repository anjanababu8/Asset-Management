<?php


        $this->widget('zii.widgets.jui.CJuiDatePicker', array( 
            'name'=>'Date', 'options'=>array('dateFormat'=>'yy/mm/dd','showAnim' => 'fold', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                'showOn' => 'button', // 'focus', 'button', 'both'
                'buttonText' => Yii::t('ui', 'Select from calendar'),
                'buttonImage' => Yii::app()->request->baseUrl . '/images/calendar.png',
                'buttonImageOnly' => true,),
            'htmlOptions'=>array('style'=>'width:100px;'),
            
        ));
 
?>
