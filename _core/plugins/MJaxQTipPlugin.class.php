<?php
/* 
 *This class will apply the qtip plugin to an Dom Element
 */
class MJaxQTipPlugin extends MJaxPluginBase{
    protected $arrProperties = array();
    protected $intDuration = null;
    public function  __construct($objForm, $arrProperties) {
        parent::__construct($objForm);
        $this->objForm->AddHeaderAsset(new MJaxJSHeaderAsset(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__ . '/qtip/jquery.qtip-1.0.0-rc3.js'));
        $this->arrProperties = $arrProperties;
    }
    public function Render($blnPrint = true){
        if(!$this->blnModified){
            return;
        }
        $strProperties = MJaxApplication::ConvertArrayToJason($this->arrProperties);
        $strRendered = sprintf("$('%s').qtip(%s);", $this->strSelector, $strProperties);         
        $this->blnModified = false;
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    
}
?>
