<?php
/* 
 * This will hold the references to different style elements that can be applyed in the dom
 */
class MJaxControlStyle{
    protected $arrAttributes = array();
    public function  __construct() {
        ;
    }
    public function __toAttr($blnLineBreaks = false){
        $strHtml = "style='";
        foreach($this->arrAttributes as $strName=>$strValue){
            $strHtml .= $strName . ":" . $strValue . "; ";
            if($blnLineBreaks){
                $strHtml .= "/n";
            }
        }
        $strHtml .= "'";
        //$strHtml = substr($strHtml, 0, strlen($strHtml) - (($blnLineBreaks)?2:1));
        return $strHtml;
    }
    public function __toCss($blnLineBreaks = false){
        $strHtml = "";
        foreach($this->arrAttributes as $strName=>$strValue){
            $strHtml .= $strName . ":" . $strValue . ";";
            if($blnLineBreaks){
                $strHtml .= "/n";
            }
        }
        //$strHtml = substr($strHtml, 0, strlen($strHtml) - (($blnLineBreaks)?2:1));
        return $strHtml;
    }
    public function __toJason(){
        return MJaxApplication::ConvertArrayToJason($this->arrAttributes);
    }
    public function SetProperty($strName, $strValue){
        $this->arrAttributes[$strName] = $strValue;
    }
    public function  __get($strName) {
        if(key_exists($strName, $this->arrAttributes)){
            return $this->arrAttributes[$strName];
        }else{
            return null;
        }
    }
    public function  __set($strName, $strValue) {
        $this->SetProperty($strName, $strValue);
    }
}
?>
