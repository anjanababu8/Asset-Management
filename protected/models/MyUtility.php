<?php 
class MyUtility {
    public static function UpdateStatusOfConsumables($userId){
        /*Get the user's group*/
        $ugRows = Usergroup::model()->findAll('uid=:uid',array(':uid'=>$userId));
        $grps = [];
        foreach($ugRows as $ug){
            $grps[] = $ug['gid'];
        }

        /*Get Blocked Item Table Ids*/
        $getRows = BlockeditemUser::model()->findAllByAttributes(array('uid'=>$userId));
        $biU = [];
        foreach($getRows as $row){
            $biU[] = $row['blockitem_id'];
        }
        $getRows = BlockeditemGroup::model()->findAllByAttributes(array('gid'=>$grps));
        $biG = [];
        foreach($getRows as $row){
            $biG[] = $row['blockitem_id'];
        }
        ////////////Blocked For All
        $getRows = Blockeditem::model()->findAllByAttributes(array('flag'=>0));
        $biA = [];
        foreach($getRows as $row){
            $biA[] = $row['id'];
        }
        $blockeditemtableIds =  array_merge($biU, $biG);
        $blockeditemtableIds =  array_unique(array_merge($blockeditemtableIds, $biA));
        
        $consumableItemIds = Blockeditem::model()->findAllByAttributes(array('id'=>$blockeditemtableIds));
        $consIds = [];
        foreach($consumableItemIds as $row){
            $consIds[] = $row['item_id'];
        }

        $getConsumables = Consumable::model()->findAll();
        
        foreach($getConsumables as $cons){
            $model = Consumable::model()->findByPk($cons['id']);
            if(in_array($cons['id'],$consIds)){
                $model->isBlockedForMe = 1;
            }else{
                $model->isBlockedForMe = 0;
            }
            $model->update();
        }
}
    public static function getNotDeleted($code){
        switch($code){
            case 'commodity':
                $rows = Commodity::model()->findAllByAttributes(array('is_deleted'=>0));               
                break;
            case 'consumable':
                $commodity = Commodity::model()->findByPk($_GET['commodityId']);
                $rows = $commodity['name']::model()->findAllByAttributes(array('is_deleted'=>0));               
                break;
            case 'category':
                $rows = Category::model()->findAllByAttributes(array('is_deleted'=>0));               
                break;  
        }   
        $items = [];
        foreach($rows as $r){
            $items[] = $r['id'];
        }
        return $items;   
    }
}
?>