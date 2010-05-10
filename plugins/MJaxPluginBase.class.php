<?php
/* 
 * This will be the junction between the plugin and the framework
 */
class MJaxPluginBase extends QBaseClass{
    protected $strSelector = null;
    protected $objForm = null;
    public function  __construct($objForm) {
        $this->objForm = $objForm;
    }
    public function SetTargetControl($objControl){
        if(!is_null($this->strSelector)){
            throw new QCallerException("A selector has already been set for this object");
        }
        $this->strSelector = '#' . $objControl->ControlId;
    }
    public function SetTargetClass($strClass){
        if(!is_null($this->strSelector)){
            throw new QCallerException("A selector has already been set for this object");
        }
        $this->strSelector = '.' . $strClass;
    }
    public function SetTargetSelector($strSelector){
        if(!is_null($this->strSelector)){
            throw new QCallerException("A selector has already been set for this object");
        }
        $this->strSelector = $strSelector;
    }
}
?>
