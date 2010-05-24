<?php
/* 
 * This class allows you to dynamically query the db and populate a text box below the text area with
 */
class MJaxAutoCompleteTextBox extends MJaxTextBox{
    protected $objTarget = null;
    protected $strFunction = null;
    protected $blnUseAjax = false;
    public function  __construct($objParentControl, $strControlId = null, $arrData = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->ApplyPlugin(new MJaxAutoCompletePlugin($this->objForm, $arrData));
    }
    public function txtAutoComplete_change(){
        $intKeyCode = $this->objForm->ActiveEvent->KeyCode;
        error_log("_________KeyCode: " . $intKeyCode . ":____");
        if((!is_null($intKeyCode)) &&
           ($intKeyCode != 37) &&
           ($intKeyCode != 38) &&
           ($intKeyCode != 39) &&
           ($intKeyCode != 40)){
            $strFunction = $this->strFunction;
            if(is_null($this->objTarget)){
                $arrData = $strFunction($this->strText);
            }else{
                $arrData = $this->objTarget->$strFunction($this->strText);
            }
            //TODO: add targeted remove plugin
            $this->arrPlugins = array();
            $this->ApplyPlugin(new MJaxAutoCompletePlugin($this->objForm, $arrData));
        }
    }

    public function __get($strName) {
        switch ($strName) {
            case "Target": return $this->objTarget;
            case "Function": return $this->strFunction;
            case "UseAjax": return $this->blnUseAjax;
            case "Data": return $this->arrData;
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
            case "Target":
                try {
                    return ($this->objTarget = $mixValue);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
             case "Function":
                try {
                    return ($this->strFunction = QType::Cast($mixValue, QType::String));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "UseAjax":
                try {
                    ($this->blnUseAjax = QType::Cast($mixValue, QType::Boolean));
                    if($this->blnUseAjax){
                        $this->AddAction(new MJaxKeyUpEvent(), new MJaxServerControlAction($this, "txtAutoComplete_change"));
                    }else{
                        $this->RemoveAllActions('keyup');
                    }
                    return ;
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "Data":
                try {
                    if(!$this->blnUseAjax){
                        $this->ApplyPlugin(new MJaxAutoCompletePlugin($this->objForm, $mixValue));
                    }
                    return ;
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
