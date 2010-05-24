<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MJaxBaseAction extends QBaseClass{
    protected $objEvent = null;
    
    public function SetEvent($objEvent){
        $this->objEvent = $objEvent;
    }

}

class MJaxServerControlAction extends MJaxBaseAction{
    protected $objTargetControl = null;
    protected $strFunction = null;

    public function __construct($objTargetControl, $strFunction){
        $this->objTargetControl = $objTargetControl;
        $this->strFunction = $strFunction;
    }
    public function Render(){
        $strRendered = 'function(objEvent){';
        $strRendered .= sprintf("MJax.TriggerControlEvent(objEvent, '%s', '%s');", $this->objEvent->Selector, $this->objEvent->EventName);
        //The following wont render anything unless blnOnce is set to true
        $strRendered .= $this->objEvent->RenderUnbind();
        $strRendered .= '}';
        return $strRendered;
    }
    public function Exicute($strFormId, $strControlId, $strParameter){
        $strFunction = $this->strFunction;
        $this->objTargetControl->$strFunction($strFormId, $strControlId, $strParameter);
    }
       public function __get($strName) {
        switch ($strName) {
            //case "KeyCode": return $this->strKeyCode;
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
           /* case "KeyCode":
                try {
                    return ($this->strKeyCode = $mixValue);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }*/
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
class MJaxJavascriptAction extends MJaxBaseAction{
    protected $strCode = null;
    public function __construct($strCode){
        $this->strCode = $strCode;
    }
    public function Render(){
        $strRendered = '';
        $strRendered .= $this->strCode;
        //The following wont render anything unless blnOnce is set to true
        $strRendered .= $this->objEvent->RenderUnbind();
        $strRendered .= '';
        return $strRendered;
    }
}
class MJaxPluginAction extends MJaxJavascriptAction{
    
    public function __construct($objPlugin){
        $strRendered = $objPlugin->Render(false);
        //$strCommand = substr($strRendered, 0, strlen($strRendered) - 1);
        $strCommand = sprintf("function(){%s}", $strRendered);
        parent::__construct($strCommand);
    }
}
?>
