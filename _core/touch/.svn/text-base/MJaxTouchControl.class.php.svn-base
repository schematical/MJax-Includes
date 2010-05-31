<?php
/* 
 * This is a simple ul that is commonly used in the Touch Apps
 */
class MJaxTouchControl extends MJaxTouchControlBase{


    public function AddChildControl($objControl) {
        if(!($objControl instanceof MJaxTouchListItem)){
            parent::AddChildControl($objControl);
        }
    }

    public function Render($blnPrint = true){
        $strRendered = parent::Render();
        $strRendered .= sprintf("<ul id='%s' name='%s' %s>\n", $this->strControlId, $this->strControlId, $this->GetAttrString());
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
        $strRendered .= "</ul>";
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }

}
?>
