<?php
/* 
 *This class will apply the qtip plugin to an Dom Element
 */
class MJaxAutoCompletePlugin extends MJaxPluginBase{
    protected $arrData = array();
    public function  __construct($objForm, $arrData = array()) {
        parent::__construct($objForm);
        $this->objForm->AddHeaderAsset(new MJaxCssHeaderAsset(__VIRTUAL_DIRECTORY__ . __CSS_ASSETS__ . '/jquery.autocomplete.css'));
        $this->objForm->AddHeaderAsset(new MJaxCssHeaderAsset(__VIRTUAL_DIRECTORY__ . __CSS_ASSETS__ . '/thickbox.css'));
        $this->objForm->AddHeaderAsset(new MJaxJSHeaderAsset(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__ . '/jquery.autocomplete.js'));
        $this->objForm->AddHeaderAsset(new MJaxJSHeaderAsset(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__ . '/jquery.bgiframe.min.js'));
        $this->objForm->AddHeaderAsset(new MJaxJSHeaderAsset(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__ . '/jquery.ajaxQueue.js'));
        $this->objForm->AddHeaderAsset(new MJaxJSHeaderAsset(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__ . '/thickbox-compressed.js'));
        $this->arrData = $arrData;
    }
    public function Render($blnPrint = true){
        if(!$this->blnModified){
            return;
        }
        if(count($this->arrData)){
            $strDataArray = 'new Array(';

            foreach($this->arrData as $strData){
                $strDataArray .= sprintf("'%s', ", $strData);
            }
            $strDataArray = substr($strDataArray, 0, strlen($strDataArray) - 2);
            $strDataArray .= ')';
        }else{
            $strDataArray = '';
        }
        
        $strRendered = '';
        $strRendered .= sprintf("$('%s').flushCache();", $this->strSelector);
        $strRendered .= sprintf("$('%s').autocomplete(%s);", $this->strSelector, $strDataArray);
        $this->blnModified = false;
        error_log("_______END RENDERING JS: " . (($this->blnModified)?'true':'false'));
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    
}
?>
