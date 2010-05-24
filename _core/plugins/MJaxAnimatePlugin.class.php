<?php
/* 
 *This class will exicute a jQuery animate command
 */
class MJaxAnimatePlugin extends MJaxPluginBase{
    protected $mixProperties = array();
    protected $intDuration = null;
    public function  __construct($objForm, $mixProperties, $intDuration = 500) {
        parent::__construct($objForm);
        $this->mixProperties = $mixProperties;
        $this->intDuration = $intDuration;
    }
    public function Render($blnPrint = true){
        if(!$this->blnModified){
            return;
        }
        if(is_array($this->mixProperties)){
            $strProperties = MJaxApplication::ConvertArrayToJason($this->mixProperties);
        }elseif(is_string($this->mixProperties)){
            $strProperties = $this->mixProperties;
        }elseif($this->mixProperties instanceof MJaxControlStyle){
            $strProperties = $this->mixProperties->__toJason();
        }else{
            throw new QCallerException("mixProperties needs to be either an array, a string or a MJaxControlStyle");
        }
        $strRendered = sprintf("$('%s').animate(%s, %s);", $this->strSelector, $strProperties, $this->intDuration);
        $this->blnModified = false;
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    
}
?>
