<?php
class MJaxHeaderAsset{
    protected $strSrc = null;
    protected $blnAlreadyRendered = false;
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "AlreadyRendered": return $this->blnAlreadyRendered;
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
            case "AlreadyRendered":
                try {
                    return ($this->blnAlreadyRendered = QType::Cast($mixValue, QType::Boolean));
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
