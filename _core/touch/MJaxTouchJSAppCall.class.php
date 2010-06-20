<?php
/* 
 * This class makes Misc calls to the MJaxTouch javascript object in the browser
 */
class MJaxTouchJSAppCall extends QBaseClass{
    protected $strFunction = null;
    protected $arrParameters = null;
    public function  __construct($strFunction, $arrParameters = array()) {
        $this->strFunction = $strFunction;
        $this->arrParameters = $arrParameters;
    }
    public function Render($blnPrint = true){
        $strParameters = implode(",", $this->arrParameters);
        $strRendered = sprintf("MJaxTouch.%s(%s);\n", $this->strFunction, $strParameters);
        if($blnPrint){
            _p($strRendered);
        }else{
            return $strRendered;
        }
    }
}
?>
