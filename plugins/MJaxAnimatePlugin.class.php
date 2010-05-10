<?php
/* 
 *This class will exicute a jQuery animate command
 */
class MJaxAnimatePlugin extends MJaxPluginBase{
    protected $arrProperties = array();
    protected $intDuration = null;
    public function  __construct($objForm, $arrProperties, $intDuration = 500) {
        parent::__construct($objForm);
        $this->arrProperties = $arrProperties;
        $this->intDuration = $intDuration;
    }
    public function Render($blnPrint = true){
        $strProperties = MJaxApplication::ConvertArrayToJason($this->arrProperties);
        $strRendered = sprintf("$('%s').animate(%s, %s);", $this->strSelector, $strProperties, $this->intDuration);
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    
}
?>
