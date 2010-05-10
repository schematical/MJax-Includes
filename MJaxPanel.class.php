<?php
/* 
 * This is a basic dif for use with the MJax Framework
 */
class MJaxPanel extends MJaxControlBase{
    protected $arrListItems = array();
    protected $strTplFileLoc = null;
    public function Render($blnPrint = true){
        $strRendered = parent::Render();
        $strRendered .= sprintf("<div id='%s' name='%s'>\n", $this->strControlId, $this->strControlId);
        //Render Text
        $strRendered .= $this->strText;
        //Check/Do autorender children
        if($this->blnAutoRenderChildren){
            foreach($this->arrChildControls as $objChildControl){
                $strRendered .= $objChildControl->Render(false);
            }
        }
        $strRendered .= "</div>";
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
}
?>