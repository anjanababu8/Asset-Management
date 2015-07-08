<?php

class FWfile {
    
    /**
     * @var array
     * @name widget parametrs
     */
    public $params = array('path'=>'assets');
    
    private $_file_instance = NULL;
    private $_old_file_path = '';
    private $_new_file_path = '';
    
    /**
     * Widget initialization
     * @return array
     */
    public function init() {
        return array(
            'name'=>__CLASS__,
            'label'=>'File field',
            'fieldType'=>array('VARCHAR'),
            'params'=>$this->params,
            'paramsLabels' => array(
                'path'=>'Upload path',
            ),
            'other_validator'=>array(
                'file'=>array(
                    'allowEmpty'=>array('','false','true'),
                    'maxFiles'=>'',
                    'maxSize'=>'',
                    'minSize'=>'',
                    'tooLarge'=>'',
                    'tooMany'=>'',
                    'tooSmall'=>'',
                    'types'=>'',
                    'wrongType'=>'',
                    'safe'=>array('true','false'),
                ),
            ),
        );
    }
    
    /**
     * @param $value
     * @param $model
     * @param $field_varname
     * @return string
     */
    public function setAttributes($value,$model,$field_varname) {
        $this->_new_file_path = $this->_old_file_path = $model->getAttribute($field_varname);
        
        if ($this->_file_instance = CUploadedFile::getInstance($model,$field_varname)){
            
            $model->getEventHandlers('onAfterSave')->insertAt(0,array($this, 'processFile'));
            $file_name = str_replace(' ', '-', $this->_file_instance->name);
            $this->_new_file_path = $this->params['path'].'/';
            
            if ($this->_old_file_path){
                $this->_new_file_path = pathinfo($this->_old_file_path, PATHINFO_DIRNAME).'/';
            } else {
                $this->_new_file_path .= $this->unique_dir($this->_new_file_path).'/';
            }
            
            $this->_new_file_path .= $file_name;
            
        } else {
            if (isset($_POST[get_class($model)]['fwfdel'][$field_varname])&&$_POST[get_class($model)]['fwfdel'][$field_varname]){
                $model->onAfterSave = array($this, 'processFile');
                $path = '';
            }
        }
        
        return $this->_new_file_path;
    }
        
    /**
     * @param $value
     * @return string
     */
    public function viewAttribute($model,$field) {
        $file = $model->getAttribute($field->VARNAME);
        if ($file) {
            $file = Yii::app()->baseUrl.'/'.$file;
            return CHtml::link(pathinfo($file, PATHINFO_FILENAME),$file);
        } else
            return '';
    }
        
    /**
     * @param $value
     * @return string
     */
    public function editAttribute($model,$field,$params=array()) {
        if (!isset($params['options'])) $params['options'] = array();
        $options = $params['options'];
        unset($params['options']);
        
        return CHtml::activeFileField($model,$field->VARNAME,$params)
        .(($model->getAttribute($field->VARNAME))?'<br/>'.CHtml::activeCheckBox($model,'[fwfdel]'.$field->VARNAME,$params)
        .' '.CHtml::activeLabelEx($model,'[fwfdel]'.$field->VARNAME,array('label'=>'Delete file','style'=>'display:inline;')):'')
        ;
    }
    
    public function processFile($event){
            
        $model = $event->sender;
        
        if ($this->_old_file_path && file_exists($this->_old_file_path)){
            unlink($this->_old_file_path);
            $files = scandir(pathinfo($this->_old_file_path, PATHINFO_DIRNAME));
            if (empty($files[2])){
                //No files in directory left
                rmdir(pathinfo($this->_old_file_path, PATHINFO_DIRNAME));
            }
            
        }
        if ($this->_file_instance){
            if (!is_dir(pathinfo($this->_new_file_path, PATHINFO_DIRNAME))){
                mkdir(pathinfo($this->_new_file_path, PATHINFO_DIRNAME), 0777, TRUE);
            }
            $this->_file_instance->saveAs($this->_new_file_path);
        }
    }
    
    private function unique_dir($base_path='')
    {
        $unique_dir = $this->random_string();
        
        while (is_dir($base_path . $unique_dir)) {
            $unique_dir = $this->random_string();
        }
        
        return $unique_dir;
    }
    
    private function random_string($max = 20){
        $string = '';
        $chars = "abcdefghijklmnopqrstuvwxwz0123456789_-ABCDEGFHIJKLMNOPQRSTUVW";
        for($i = 0; $i < $max; $i++){
            $rand_key = mt_rand(0, strlen($chars));
            $string  .= substr($chars, $rand_key, 1);
        }
        return str_shuffle($string);
    }
    
}