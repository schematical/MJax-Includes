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
    public function  __construct($objForm, $mixTarget, $mixProperties= array(), $intDuration = 500) {
        parent::__construct($objForm);
        $this->objForm->AddHeaderAsset(new MJaxJSHeaderAsset(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__ . '/jquery.scrollTo-min.js'));
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
        $strRendered = sprintf("$('%s').scrollTo('%s', %s, %s);", 
            $this->strSelector,
            $this->strTargetSelector,
            $this->intDuration,
            $strProperties);
        $this->blnModified = false;
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    
}
?>