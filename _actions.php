<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MJaxBaseAction extends QBaseClass{


}

class MJaxServerControlAction extends MJaxBaseAction{
    protected $objEvent = null;
    protected $objTargetControl = null;
    protected $strFunction = null;
    public function __construct($objTargetControl, $strFunction){
        $this->objTargetControl = $objTargetControl;
        $this->strFunction = $strFunction;
    }
    public function SetEvent($objEvent){
        $this->objEvent = $objEvent;
    }
    public function Render(){
        $strRendered = sprintf("function(){ MJax.TriggerControlEvent('%s', '%s');}", $this->objEvent->ControlId, $this->objEvent->GetEventName());
        return $strRendered;
    }
    public function Exicute($strFormId, $strControlId, $strParameter){
        $strFunction = $this->strFunction;
        $this->objTargetControl->$strFunction($strFormId, $strControlId, $strParameter);
    }
}
?>
