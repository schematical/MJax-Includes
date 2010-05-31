<?php
/* 
 *This class will exicute a jQuery scroll to plugin
 */
/**
 * jQuery.ScrollTo - Easy element scrolling using jQuery.
 * Copyright (c) 2007-2009 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * Date: 5/25/2009
 * @author Ariel Flesler
 * @version 1.4.2
 *
 * http://flesler.blogspot.com/2007/10/jqueryscrollto.html
 */
class MJaxScrollToPlugin extends MJaxPluginBase{
    protected $mixProperties = array();
    protected $intDuration = null;
    protected $ctlTarget = null;
    protected $cssTarget = null;
    protected $strTargetSelector = null;
    protected $blnUseFirstChild = false;
    public function  __construct($objForm, $mixTarget, $mixProperties= array(), $intDuration = 500, $blnUseFirstChild = false) {
        parent::__construct($objForm);
       // $this->objForm->AddHeaderAsset(new MJaxJSHeaderAsset(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__ . '/jquery.scrollTo-min.js'));
        if($mixTarget instanceof MJaxControl){
            $this->ctlTarget = $mixTarget;
            $this->strTargetSelector = '#' .$mixTarget->ControlId;
        }elseif($mixTarget instanceof MJaxCssClass){
            $this->cssTarget = $mixTarget;
            $this->strTargetSelector = '.' .$mixTarget->ClassName;
        }elseif(is_string($mixTarget)){
            $this->strTargetSelector = $mixTarget;
        }else{
            Throw new QCallerException("Scroll to Plugin Target must be an instance of either a MJaxControl, a MJaxCssClass, or a String");
        }
        $this->mixProperties = $mixProperties;
        $this->intDuration = $intDuration;
        $this->blnUseFirstChild = $blnUseFirstChild;

    }
    /*-----debugging --------
    public function  __wakeup() {
         
    }
    public function __sleep(){
         $vars = (array)$this;
        foreach ($vars as $key => $val)
        {
            if (is_null($val))
            {
                unset($vars[$key]);
            }
        }   
        return array_keys($vars);
    }
     */
    public function Render($blnPrint = true){
        if(!$this->blnModified){   
            return;
        }
        if(is_array($this->mixProperties)){
            $strProperties = MJaxApplication::ConvertArrayToJason($this->mixProperties);
        }elseif(is_string($this->mixProperties)){
            $strProperties = $this->mixProperties;
        }elseif($this->mixProperties instanceof MJaxControlStyle){
            $strProperties = $this->mixProperties->__toJason();
        }else{
            throw new QCallerException("mixProperties needs to be either an array, a string or a MJaxControlStyle");
        }
        $strFirstChild = ($this->blnUseFirstChild?'[0]':'');
        $strRendered = sprintf("$('%s')%s.scrollTo('%s');",//, %s, %s);",
            $this->strSelector,
            $strFirstChild,
            $this->strTargetSelector,
            $strProperties,
            $this->intDuration
        );
        $this->blnModified = false;
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
     /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "UseFirstChild": return $this->blnUseFirstChild;
            default:
                try {
                    return parent::__get($strName);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue) {
        switch ($strName) {
            case "UseFirstChild":
                try {
                    return ($this->blnUseFirstChild = QType::Cast($mixValue, QType::Boolean));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            default:
                try {
                    return parent::__set($strName, $mixValue);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }

    
}
?>