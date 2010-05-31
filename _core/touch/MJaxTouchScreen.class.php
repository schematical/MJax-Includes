<?php
/* 
 * This class is a basic screen used to display information to a touch screen device
 */
class MJaxTouchScreen extends MJaxPanel{
    protected $blnRenderOnLoad = false;

    public function __construct($objParentControl,$strControlId = null) {
        parent::__construct($objParentControl,$strControlId);
        $this->AddCssClass(MJaxApplication::CssClass(MJaxTouchCssClass::FORM));
        
    }

    public function Render($blnPrint = true){
        $strRendered = parent::Render();
        $strRendered .= sprintf("<form id='%s' name='%s' method='POST' %s>\n", $this->strControlId, $this->strControlId, $this->GetAttrString());
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
                //TODO: Add render check for controls that have already been rendererd
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
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "RenderOnLoad": return $this->blnRenderOnLoad;
            default:
                try {
                    return parent::__get($strName);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue) {
        switch ($strName) {
            case "RenderOnLoad":
                try {
                    return ($this->blnRenderOnLoad = QType::Cast($mixValue, QType::String));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            default:
                try {
                    return parent::__set($strName, $mixValue);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }

}
?>
