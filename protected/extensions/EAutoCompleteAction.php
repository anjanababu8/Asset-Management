<?php
class EAutoCompleteAction extends CAction
{
    public $model;
    public $attribute;
    private $results = array();
 
    public function run()
    {
        if(isset($this->model) && isset($this->attribute)) {
            $criteria = new CDbCriteria();
            $criteria->compare($this->attribute, $_GET['term'], true);
            $model = new $this->model;
            foreach($model->findAll($criteria) as $m)
            {
                $this->results[] = $m->{$this->attribute};
            }
 
        }
        echo CJSON::encode($this->results);
    }
}
?>