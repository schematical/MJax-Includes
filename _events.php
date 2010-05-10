<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MJaxEventBase extends QBaseClass{
    protected $objControl = null;
    protected $objAction = null;
    public function Init($objControl, $objAction){
        $this->objControl = $objControl;
        $this->objAction = $objAction;
        $this->objAction->SetEvent($this);
    }
    public function Exicute(){
        $this->objAction->Exicute($this->objControl->ControlId, $this->objControl->Form->FormId, $this->objControl->ActionParameter);
    }
    public function GetEventName(){
        return $this->strEventName;
    }
    public function __get($strName) {
        switch ($strName) {
            case "ControlId": return $this->objControl->ControlId;
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
        switch ($strName) {/*
            case "ControlId":
                try {
                    return ($this->strId = QType::Cast($mixValue, QType::String));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
           */
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

class MJaxClickEvent extends MJaxEventBase{
    protected $strEventName = 'click';
    public function Render(){
        $strRendered = sprintf("$('#%s').live('click', %s);", $this->objControl->ControlId, $this->objAction->Render());
        return $strRendered;
    }

}
?>
