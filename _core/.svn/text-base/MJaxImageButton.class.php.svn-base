<?php
/*
 * This is an image buttonforuse with the MJax Framework
 */
class MJaxImageButton extends MJaxControl{
    protected $strSrc = null;
    public function  __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->objStyle->Cursor = 'pointer';
    }
    public function Render($blnPrint = true){
        //Render Actions first if applicable
        $strRendered = parent::Render();

        $strRendered .= sprintf("<img id='%s' name='%s' src='%s' style='%s'></img>", $this->strControlId, $this->strControlId, $this->strSrc, $this->objStyle->__toAttr());
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
            case "Src": return $this->strSrc;
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
            case "Src":
                try {
                    return ($this->strSrc = QType::Cast($mixValue, QType::String));
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
