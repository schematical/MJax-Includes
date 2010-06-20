<?php
/* 
 * This control will have be the base for all MJax controls
 */
class MJaxControlBase extends QBaseClass{
    protected $strControlId = null;
    protected $arrEvents = array();
    protected $objForm = null;
    protected $objParentControl = null;
    protected $strActionParameter = null;
    protected $strText = '';
    protected $blnAutoRenderChildren = false;
    protected $arrChildControls = array();
    protected $arrPlugins = array();
    protected $objStyle = null;
    protected $arrCssClasses = array();
    protected $strTemplate = null;
    protected $arrAttr = array();
    protected $blnModified = false;
    public function  __construct($objParentControl, $strControlId = null) {
        $this->blnModified = true;
        if($objParentControl instanceof MJaxForm){
            $this->objForm = $objParentControl;            
        }else{
            $this->objParentControl = $objParentControl;
            $this->objForm = $this->objParentControl->Form;
            $this->objParentControl->AddChildControl($this);
        }
        if(!is_null($strControlId)){
            $this->strControlId = $strControlId;
        }else{
            $this->strControlId = $this->objForm->GenerateControlId();
        }
        $this->objForm->RegisterControl($this);
        $this->objStyle = new MJaxControlStyle();
    }

    public function SetForm($objForm) {
        $this->objForm = $objForm;
    }
    public function AddAction($objEvent, $objAction){
        $objEvent->Init($this, $objAction);
        if(!key_exists($objEvent->EventName, $this->arrEvents)){
            $this->arrEvents[$objEvent->EventName] = array();
        }
        $this->arrEvents[$objEvent->EventName][] = $objEvent;
    }
    public function RemoveAllActions($mixEvent){
        if($mixEvent instanceof MJaxEventBase){
            $strEvent= $mixEvent->EventName;
        }elseif(is_string($mixEvent)){
            $strEvent = $mixEvent;
        }else{
            throw new QCallerException("RemoveAllActions method must take either a string or a MJaxEvent for the 1st parameter");
        }
        $this->blnModified = true;
        $this->arrEvents[$strEvent] = array();
    }
    public function TriggerEvent($strEvent){
        foreach($this->arrEvents as $arrSubEvents){
            foreach($arrSubEvents as $objEvent){
                if($objEvent->GetEventName() == $strEvent){
                    $objEvent->Exicute();
                }
            }
        }
    }
    public function AddChildControl($objControl){
        $this->arrChildControls[] = $objControl;
    }
    public function ApplyPlugin($objPlugin){
        $objPlugin->SetTargetControl($this);
        $this->arrPlugins[] = $objPlugin;
    }
    public function Animate($mixProperties){
        $this->ApplyPlugin(new MJaxAnimatePlugin($this->objForm, $mixProperties));
    }
    public function Render(){
       $this->blnModified = false;
        if($this->objForm->CallType == QCallType::None){
            return $this->RenderJSCalls();
        }else{
            return '';
        }
    }
    public function RenderJSCalls($blnAjaxFormating = false){
        $strDocumentReady = '';
        
        foreach($this->arrEvents as $arrSubEvents){
            error_log($this->strControlId . " Count: " . count($arrSubEvents));
            foreach($arrSubEvents as $objEvent){
                $strDocumentReady .= $objEvent->Render();
            }
        }
        foreach($this->arrPlugins as $objPlugin){
            $strDocumentReady .= $objPlugin->Render(false);
        }
        $strRendered = '';
        if(strlen($strDocumentReady) > 0){
            $strDocumentReady = sprintf("$('#%s').die(); ", $this->strControlId) . $strDocumentReady;
            if(!$blnAjaxFormating){
                $strRendered .= "<script language='javascript'>";
            }
            $strRendered .= sprintf("$(document).ready(function(){%s});\n", $strDocumentReady);
            if(!$blnAjaxFormating){
                $strRendered .= "</script>";
            }
        }
        return $strRendered;

    }
    public function ParsePostData(){ }
    /*-----Events -----*/
    public function Create_Controls(){ }
    /*-----Events End------*/
    public function AddCssClass($mixCssClass){
        if($mixCssClass instanceof MJaxCssClass){
            $this->blnModified = true;
            $this->arrCssClasses[$mixCssClass->ClassName] = $mixCssClass;
        }elseif(is_string($mixCssClass)){
            $this->blnModified = true;
            $this->arrCssClasses[$mixCssClass] = MJaxApplication::CssClass($mixCssClass);
        }else{
            throw new QCallerException("AddCssClass must have either a string or a MJaxCssClass passed in as the first argument");
        }
    }
    public function RemoveCssClass($mixCssClass){
        if($mixCssClass instanceof MJaxCssClass){
            $strCssClassName = $mixCssClass->ClassName;
        }elseif(is_string($mixCssClass)){
            $strCssClassName = $mixCssClass;
        }else{
            throw new QCallerException("RemoveCssClass must have either a string or a MJaxCssClass passed in as the first argument");
        }
        if(key_exists($strCssClassName, $this->arrCssClasses)){
            unset($this->arrCssClasses[$strCssClassName]);
            $this->blnModified = true;
            return true;
        }else{
            return false;
        }
    }

    public function Attr($strName, $strValue = null){
        if(is_null($strValue)){
            if(key_exists($strName, $this->arrAttr)){
                return $this->arrAttr[$strName];
            }else{
                return null;
            }
        }else{
            $this->arrAttr[$strName] = $strValue;
            $this->blnModified = true;
            return true;
        }
    }
    protected function GetAttrString(){
        $strAttr = '';
        $strAttr .= $this->objStyle->__toAttr();
        $strAttr .= ' ';
        foreach($this->arrAttr as $strName=>$strValue){
            $strAttr .= sprintf("%s='%s' ", $strName, $strValue);
        }
        if(count($this->arrCssClasses) > 0){
            $strAttr .= "class='";
            foreach($this->arrCssClasses as $cssClass){
                $strAttr .= $cssClass->ClassName . " ";
            }
            $strAttr .= "' ";
        }
        return $strAttr;
    }
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "ControlId": return $this->strControlId;
            case "Form": return $this->objForm;
            case "ActionParameter": return $this->strActionParameter;
            case "Text": return $this->strText;
            case "AutoRenderChildren": return $this->blnAutoRenderChildren;
            case "Style": return $this->objStyle;
            case "Template": return $this->strTemplate;
            case "Modified": return $this->blnModified;
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
        $this->blnModified = true;
        switch ($strName) {
            case "ControlId":
                try {
                    return ($this->strControlId = QType::Cast($mixValue, QType::String));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "ActionParameter":
                try {
                    return ($this->strActionParameter = QType::Cast($mixValue, QType::String));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "Text":
                try {
                    return ($this->strText = QType::Cast($mixValue, QType::String));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "AutoRenderChildren":
                try {
                    return ($this->blnAutoRenderChildren = QType::Cast($mixValue, QType::Boolean));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "Style":
                try {
                    return ($this->objStyle = QType::Cast($mixValue, 'MJaxControlStyle'));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "Template":
                try {
                    return ($this->strTemplate = QType::Cast($mixValue, QType::String));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "Modified":
                try {
                    return ($this->blnModified = QType::Cast($mixValue, QType::Boolean));
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
