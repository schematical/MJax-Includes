<?php
/* 
 * This acts as an entry for a list box
 */
class MJaxListItem extends QBaseClass{
    protected $strText = null;
    protected $strValue = null;
    protected $blnSelected = false;
    
    public function  __construct($strText, $strValue, $blnSelected = false) {
        $this->strText = $strText;
        $this->strValue = $strValue;
        $this->blnSelected = $blnSelected;
    }

    public function __toString(){
        if($this->blnSelected){
            $strAttributes = " selected='true'";
        }else{
            $strAttributes = "";
        }
        
        $strReturn = sprintf("<option value='%s'%s>%s</option>\n", $this->strValue, $strAttributes, $this->strText);
        return $strReturn;
    }
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "Value": return $this->strValue;
            case "Selected": return $this->blnSelected;
            case "Text": return $this->strText;
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
            case "Value":
                try {
                    return ($this->strValue = QType::Cast($mixValue, QType::String));
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
            case "Selected":
                try {
                    return ($this->blnSelected = QType::Cast($mixValue, QType::Boolean));
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
