<?php
/* 
 * This class defines certain attributes of a css class for use with jQuery and the DOM
 */
class MJaxCssClass extends QBaseClass{
    protected $strClassName = null;
    protected $objStyle = null;
    protected $arrPlugins = array();
    protected $arrEvents = array();
    public function  __construct($strClassName) {
        $this->strClassName = $strClassName;
        $this->objStyle = new MJaxControlStyle();
        //Automatically register with MJaxApplication
        MJaxApplication::RegisterCssClass($this);
    }
    public function AddAction($objEvent, $objAction){
        $objEvent->Init($this, $objAction);
        $this->arrEvents[] = $objEvent;
    }
    public function Animate($arrProperties){
        $this->ApplyPlugin(new MJaxAnimatePlugin($this->objForm, $arrProperties));
    }
    public function ApplyPlugin($objPlugin){
        $objPlugin->SetTargetClass($this);
        $this->arrPlugins[] = $objPlugin;
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
    public function RenderCss($blnPrint = true){
        $strRendered = "." . $this->strClassName . "{\n";
        $strRendered .= $this->objStyle->__toCss(true);
        $strRendered .= "}\n";
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
            case "ClassName": return $this->strClassName;
            case "Style": return $this->objStyle;
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
            case "ClassName":
                try {
                    return ($this->strClassName = QType::Cast($mixValue, QType::String));
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
