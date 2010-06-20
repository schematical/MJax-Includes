<?php
/* 
 * This class is a basic screen used to display information to a touch screen device
 */
class MJaxTouchScreen extends MJaxTouchControl{
    protected $blnRenderOnLoad = false;
    protected $blnControlsCreated = false;
    protected $strTransition = null;

    public function __construct(MJaxTouchPage $objParentControl,$strControlId = null) {
        parent::__construct($objParentControl,$strControlId);
        $this->objForm->RegisterScreen($this);
        $this->AddCssClass(MJaxApplication::CssClass(MJaxTouchCssClass::MJaxTouchForm));
        $this->Attr('action', $_SERVER[MLCServer::REQUEST_URI]);
        $this->strTransition = $this->objForm->DefaultTransition;
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
            if(is_null($this->objForm)){
                throw new Exception(get_class($this) . " Form is null");
            }
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
        $this->Attr('goBack', 'false');
        $this->Attr('transition',' ');
        //Only render this on the active form
        if($this->IsActive()){
            $strRendered .= "<script language='javascript'>";
            $strRendered .= $this->objForm->RenderControlJSCalls(false);
            $strRendered .= $this->objForm->RenderClassJSCalls(false);
            $strRendered .= $this->objForm->RenderControlRegisterJS(false);
            $strRendered .= $this->objForm->RenderJSAppCalls(false);
            $strRendered .= "</script>";
            /*_______ALWAYS RENDER THIS LAST________*/
            if($this->IsActive()){
                $strRendered .= $this->objForm->RenderFormState(false);
            }

        }
        $strRendered .= "</form>";
 
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    public function IsActive(){
        return ($this->objForm->ActiveScreen->ControlId == $this->strControlId);
    }
    public function Create_Controls(){
        $this->blnControlsCreated = true;    
    }
    public function Screen_Activate(){
        if(!$this->blnControlsCreated){
            $this->Create_Controls();
        }
        $this->Attr('transition', $this->strTransition);
    }
    public function Screen_Deactivate(){}
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "RenderOnLoad": return $this->blnRenderOnLoad;
            case "Transition": return $this->strTransition;
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
            case "Transition":
                try {
                    return ($this->strTransition = QType::Cast($mixValue, QType::String));
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
