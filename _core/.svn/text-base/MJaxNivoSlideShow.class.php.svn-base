<?php
/* 
 * This creates a jquery slide show
 */
class MJaxNivoSlideShow extends MJaxPanel{
    protected $arrSlides = array();
    public function  __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->ApplyPlugin(new MJaxNivoSlideShowPlugin($this->objForm));
    }
    public function AddSlide($strSrc, $strAlt = null, $strHref = null){
        $this->arrSlides[] = new MJaxNivoSlide($strSrc, $strAlt, $strHref);
    }
    public function Render($blnPrint = true){
        $this->strText = '';
        foreach($this->arrSlides as $objSlide){
            $this->strText .= $objSlide->Render();
        }
        return parent::Render($blnPrint);
    }
}
class MJaxNivoSlide extends QBaseClass{
    protected $strSrc = null;
    protected $strAlt = null;
    protected $strHref = null;
    public function __construct($strSrc, $strAlt = null, $strHref = null){
        $this->strSrc = $strSrc;
        $this->strAlt = $strAlt;
        $this->strHref = $strHref;
    }

    public function Render(){
        $strRendered = sprintf("<img src='%s' alt='%s' />\n", $this->strSrc, $this->strAlt);
        if(!is_null($this->strHref)){
            $strRendered = sprintf("<a href='%s'>\n\t%s</a>\n", $this->strHref, $strRendered);
        }
        return $strRendered;
    }
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "Src": return $this->strControlId;
            case "Alt": return $this->objForm;
            case "Href": return $this->strActionParameter;
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
            case "Alt":
                try {
                    return ($this->strAlt = QType::Cast($mixValue, QType::String));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "Href":
                try {
                    return ($this->strHref = QType::Cast($mixValue, QType::String));
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
