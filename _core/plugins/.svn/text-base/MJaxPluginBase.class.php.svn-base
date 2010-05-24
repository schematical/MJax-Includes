<?php
/* 
 * This will be the junction between the plugin and the framework
 */
class MJaxPluginBase extends QBaseClass{
    protected $strSelector = null;
    protected $objForm = null;
    protected $blnModified = false;
    
    public function  __construct($objForm) {
        $this->objForm = $objForm;
        $this->blnModified = true;        
    }
    public function SetTargetControl($objControl){
        if(!is_null($this->strSelector)){
            throw new QCallerException("A selector has already been set for this object");
        }
        $this->strSelector = '#' . $objControl->ControlId;
    }
    public function SetTargetClass($objClass){
        if(!is_null($this->strSelector)){
            throw new QCallerException("A selector has already been set for this object");
        }
        if($objClass instanceof MJaxCssClass){
            $this->strSelector = '.' . $objClass->ClassName;
        }elseif(is_string($objClass)){
            $this->strSelector = '.' . $strClass;
        }else{
            throw new QCallerException("SetTargetClass must have either a string or a MJaxCssClass passed in as the first argument");
        }
    }
    public function SetTargetSelector($strSelector){
        if(!is_null($this->strSelector)){
            throw new QCallerException("A selector has already been set for this object");
        }
        $this->strSelector = $strSelector;
    }
    
}
?>
