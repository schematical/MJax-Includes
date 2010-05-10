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
    public function  __construct($objParentControl, $strControlId = null) {
        
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
    }

    public function SetForm($objForm) {
        $this->objForm = $objForm;
    }
    public function AddAction($objEvent, $objAction){
        $objEvent->Init($this, $objAction);
        $this->arrEvents[] = $objEvent;
    }
    public function TriggerEvent($strEvent){
        foreach($this->arrEvents as $objEvent){
            if($objEvent->GetEventName() == $strEvent){
                $strControlId = (!is_null($this->objParentControl))?$this->objParentControl->ControlId:null;
                $strActionParameter = (!is_null($this->objParentControl))?$this->objParentControl->ActionParameter:null;
                
                $objEvent->Exicute($this->objForm->FormId, $strControlId, $strActionParameter);
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
    public function Animate($arrProperties){
        $this->ApplyPlugin(new MJaxAnimatePlugin($this->objForm, $arrProperties));
    }
    public function Render(){
        if($this->objForm->CallType == QCallType::None){
            return $this->RenderJSCalls();
        }else{
            return '';
        }
    }
    public function RenderJSCalls($blnAjaxFormating = false){
        $strDocumentReady = '';
        foreach($this->arrEvents as $objEvent){
            $strDocumentReady .= $objEvent->Render();
        }
        foreach($this->arrPlugins as $objPlugin){
            $strDocumentReady .= $objPlugin->Render(false);
        }
        $strRendered = '';
        if(strlen($strDocumentReady) > 0){
            error_log("_________" . get_class($this));
            if(!$blnAjaxFormating){
                $strRendered .= "<script language='javascript'>";
            }
            $strRendered .= sprintf("$('docuent').ready(function(){%s});\n", $strDocumentReady);
            if(!$blnAjaxFormating){
                $strRendered .= "</script>";
            }
        }
        return $strRendered;

    }
    public function ParsePostData(){ }
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
