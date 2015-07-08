<?php
class Common{
    /* bracode */
    public static function getItemBarcode($valueArray) {
        
        $barcodeDetailsRow = Barcodedetail::model()->find('organisation_id=:organisation_id',array('organisation_id'=>Yii::app()->user->getState("org_id")));
        if(isset($valueArray['commodity_id'])){
            $stockname = Stockname::model()->findByAttributes(array('commodity_id'=>$valueArray['commodity_id']));
            $prefix = $stockname['prefix'];  
        }else{
            $prefix = '';
        }
        
        $optionsArray = array(
            'elementId'=>$valueArray['itemId'] . "_bcode", /*the div element id*/
            'value'=>$prefix.'/'.$valueArray['barcode'],
            'type' => $barcodeDetailsRow['type'],
            'settings'=>array(
                    'output'=>$barcodeDetailsRow['format'], 
                    'barWidth' => $barcodeDetailsRow['bar_width'],
                    'barHeight' => $barcodeDetailsRow['bar_height'],),
            );
        self::getBarcode($optionsArray);         
        return CHtml::tag('div', array('id' => $valueArray['itemId'] . "_bcode"));
    }
 
    /**
     * This function returns the item barcode
     */
    public static function getBarcode($optionsArray) {
        Yii::app()->getController()->widget('ext.barcode.Barcode', $optionsArray);
    }
}
 ?>