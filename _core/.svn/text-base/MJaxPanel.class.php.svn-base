<?php
/* 
 * This is a basic dif for use with the MJax Framework
 */
class MJaxPanel extends MJaxControl{
    //protected $arrListItems = array();
    public function Render($blnPrint = true, $blnRenderAsAjax = false){
        if($blnRenderAsAjax){
            $strElementOverride = 'control';
        }else{
            $strElementOverride = 'div';
        }
        $strRendered = parent::Render();
        $strHeader = sprintf("<%s id='%s' name='%s' %s>\n", $strElementOverride, $this->strControlId, $this->strControlId, $this->GetAttrString());
        //If template is set render template
        if(!is_null($this->strTemplate)){
            if(!file_exists($this->strTemplate)){
                throw new QCallerException("Template file (" . $this->strTemplate .") does not exist");
            }
            global $_CONTROL;
            $_CONTROL = $this;
            $_FORM = $this->objForm;
            $strRendered .= $this->objForm->EvaluateTemplate($this->strTemplate);
        }
        //Render Text
        $strRendered .= $this->strText;
        //Check/Do autorender children
        if($this->blnAutoRenderChildren){
            foreach($this->arrChildControls as $objChildControl){
                $strRendered .= $objChildControl->Render(false);
            }
        }
        $strFooter = sprintf("</%s>", $strElementOverride);
        if(!$blnRenderAsAjax){
            $strRendered = $strHeader . $strRendered . $strFooter;
        }else{
            $strRendered = $strHeader . QString::XmlEscape(trim($strRendered)) . $strFooter;
        }
        $this->blnModified = false;
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
}
?>