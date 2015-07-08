<html>
    <style>
        .circle { 
   width: 140px;
   height: 140px;
   background: red; 
   -moz-border-radius: 70px; 
   -webkit-border-radius: 70px; 
   border-radius: 70px;
}
    </style>
</html>

<?php

/**
 * @author Serg.Kosiy <serg.kosiy@gmail.com>
 */
class DashController extends UIDashboardController
{
    // uncomment the following to apply new layout for the controller view.
    //public $layout = '//layouts/column2';

    public function init()
    {
        parent::init();

        // Create new field in your users table for store dashboard preference
        // Set table name, user ID field name, user preference field name
        $this->setTableParams('dashboard_page', 'user_id', 'title');

        // set array of portlets
        $this->setPortlets(
                array(
                    array('id' => 1, 'title' => 'COMMODITIES ', 'content' => $this->getNum(1) ),
                    array('id' => 2, 'title' => 'CATEGORIES ', 'content' => $this->getNum(2)),
                    array('id' => 3, 'title' => 'SUPPLIERS ', 'content' => $this->getNum(3)),
                    array('id' => 4, 'title' => 'USERS ', 'content' => $this->getNum(4)),
                    array('id' => 5, 'title' => 'ASSETS ', 'content' => $this->getNum(5)),
                    array('id' => 6, 'title' => 'Info ', 'content' => $this->getInfo()),
                )
        );

        //set content AFTER dashboard
        
        //set content BEFORE dashboard
        $this->setContentBefore('<div align="center" style="font-size:20px;"><b>ASSET MANAGEMENT</b></div><br/>');

        // uncomment the following to apply jQuery UI theme
        // from protected/components/assets/themes folder
        
        $this->applyTheme('sunny');

        // uncomment the following to change columns count
        $this->setColumns(5);

        // uncomment the following to enable autosave
        $this->setAutosave(true);

        // uncomment the following to disable dashboard header
        //$this->setShowHeaders(false);

        // uncomment the following to enable context menu and add needed items
        /*
        $this->menu = array(
            array('label' => 'Index', 'url' => array('index')),
        );*/
        
    }
    public function getNum($code){
        switch($code){
            case 1: $rows = Commodity::model()->findAll();
                    $heading = 'commodity';
                    $count = count($rows);break;
            case 2: $rows = Category::model()->findAll();
                    $heading = 'category';
                    $count = count($rows);break;
            case 3: $rows = Supplier::model()->findAll();
                    $heading = 'supplier';
                    $count = count($rows);break;
            case 4: $rows = User::model()->findAll();
                    $heading = 'user';
                    $count = count($rows);break;
            case 5: $rows = Allocate::model()->findAll();
                    $heading = 'allocate';
                    $count = count($rows);break;
        }
        $content = '<b style="class:circle">'.$count.'</b><br/>';
        $i = 2;
        if($code != 5){
            foreach($rows as $r){
                $content .= $r['name'].'<br/>';
                --$i; if($i<=0) break;
            }
            while($i!=0){
                $content .= '<br/>'; --$i;
            }
            $content .= '<p style="display:inline;text-align:right"><i><a href="http://localhost/asset_management/index.php/'.$heading.'/admin">View All</a></i></p><br/>';
        }
        
        return $content;
    }
    public function getInfo(){
        
        
        
        /* Items allocated*/

        $commodity['consumable'] = Consumable::model()->findAll();
        $commodity['monitor'] = Monitor::model()->findAll();
        $commodity['printers'] = Printers::model()->findAll();
        $commodity['devices'] = Devices::model()->findAll();
        $dup = $commodity;
        /* Items available on Loan*/
        $availableOnLoan = 0;$thresholdItems = 0;$content ='';
        foreach($commodity as $key=>$commo){
            foreach ($commo as $item){
                if($item['available_on_loan'] == 1 || $item['available_on_loan'] == 'Yes')
                    ++$availableOnLoan;
                if($key == 'consumable'){
                $commodity = Commodity::model()->findByAttributes(array('name'=>$key));
                $allocates = Allocate::model()->findAllByAttributes(array('commodity_id'=>$commodity['id'],'cons_id'=>$item['id']));
                if(count($allocates)<$item['threshold'])
                    ++$thresholdItems;
                }
            }
        }     
        /** Allocated and unallocated **/
        $countAllocated = 0;
        $countUnAllocated = 0;
        $commodity = $dup;
                $unAllocated = Allocate::model()->findAllByAttributes(array('date_out'=>NULL));
                $allocated = Allocate::model()->findAll('date_out IS NOT NULL');
                
                $countAllocated += count($allocated);
                $countUnAllocated += count($unAllocated);
           
        $content .= '<b style="color:red">'.$availableOnLoan.'</b> item available on loan<br/>';
        $content .= '<b style="color:red">'.$thresholdItems.'</b> item below threshold<br/>';
        $content .= '<b style="color:red">'.$countAllocated.'</b> item allocated<br/>';
        $content .= '<b style="color:red">'.$countUnAllocated.'</b> item unallocated<br/>';
        /* Items below threshold*/
        return $content;
    }
}