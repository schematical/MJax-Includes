<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MJaxSelectSceenAction extends MJaxJavascriptAction{
    protected $strSelector = null;
    public function __construct($scnScreen, $blnForceLoad = false){
        if($scnScreen instanceof MJaxTouchScreen){
         $this->strSelector = $scnScreen->ControlId;
        }elseif(is_string($scnScreen)){
            $this->strSelector = $scnScreen;
        }else{
            throw new QCallerException("MJaxSelectSceenAction contstruct prameter must be either an instance of MJaxTouchScreen or a string. '" . get_class($scnScreen) . "' given.");
        }
        
        $strRendered = sprintf("MJaxTouch.LoadScreen('%s');objEvent.preventDefault();", $this->strSelector);
        

        $strCommand = sprintf("function(objEvent){%s}", $strRendered);
        parent::__construct($strCommand);
    }
    public function SetEvent($objEvent) {
        parent::SetEvent($objEvent);
        $this->objEvent->Control->Attr('href', '#' . $this->strSelector);
        //$this->objEvent->Control->AddCssClass(MJaxApplication::CssClass(MJaxTouchCssClass::SUBMIT));
    }
}
class MJaxTouchServerControlAction extends MJaxBaseAction{
    protected $objTargetControl = null;
    protected $strFunction = null;

    public function __construct($objTargetControl, $strFunction){
        $this->objTargetControl = $objTargetControl;
        $this->strFunction = $strFunction;
    }
    public function Render(){
        $strRendered = 'function(objEvent){';
        $strRendered .= sprintf("MJaxTouch.TriggerControlEvent(objEvent, '%s', '%s');objEvent.preventDefault();", $this->objEvent->Selector, $this->objEvent->EventName);
        //The following wont render anything unless blnOnce is set to true
        $strRendered .= $this->objEvent->RenderUnbind();
        $strRendered .= '}';
        return $strRendered;
    }
    public function Exicute($strFormId, $strControlId, $strParameter){
        $strFunction = $this->strFunction;
        $this->objTargetControl->$strFunction($strFormId, $strControlId, $strParameter);
    }

}
?>
