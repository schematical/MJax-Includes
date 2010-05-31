<?php
/* 
 * This basically will be used to create the jason to string configeration object
 */
class MJaxTouchConfig extends QBaseClass{
    const preloadImages = 'preloadImages';
    const icon = 'icon';
    const addGlossToIcon = 'addGlossToIcon';
    const startupScreen = 'startupScreen';
    const statusBar = 'statusBar';



    protected $arrConfig = array();
    
    public function Render($blnPrint = true){
        $strRendered = 'var jQT = new $.jQTouch(\n';
        $strRendered .= MJaxApplication::ConvertArrayToJason($this->arrConfig);
        $strRendered .= ');\n';
        if($blnPrint){
            _p($strRendered);
        }else{
            return $strRendered;
        }
    }

    public function SetProperty($strName, $strValue){
        $this->arrConfig[$strName] = $strValue;
    }
    public function  __get($strName) {
        if(key_exists($strName, $this->arrConfig)){
            return $this->arrConfig[$strName];
        }else{
            return null;
        }
    }
    public function  __set($strName, $strValue) {
        $this->SetProperty($strName, $strValue);
    }





/*-----specific functions------*/

    public function AddPreLoadedImage($strLoc){
        if(!key_exists(MJaxTouchConfig::preloadImages, $this->arrConfig)){
            $this->arrConfig[MJaxTouchConfig::preloadImages] = array();
        }
        $this->arrConfig[MJaxTouchConfig::preloadImages][] = $strLoc;
    }



}
?>
