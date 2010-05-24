<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MJaxEventBase extends QBaseClass{
    protected $blnOnce = false;
    protected $objControl = null;
    protected $objCssClass = null;
    protected $strSelector = null;
    protected $objAction = null;


    /*---extra post data----*/
    protected $strKeyCode = null;
    
    public function Init($mixTarget, $objAction){
        if($mixTarget instanceof MJaxControl){
            $this->objControl =  $mixTarget;
            $this->strSelector = "#" . $this->objControl->ControlId;
        }elseif($mixTarget instanceof MJaxCssClass){
            $this->objCssClass =  $mixTarget;
            $this->strSelector = "." . $this->objCssClass->ClassName;
        }elseif(is_string($mixTarget)){
            $this->strSelector = $mixTarget;
        }else{
            throw new QCallerException("Event target must be either a MJaxControl, MJaxCssClass, or string");
        }
        $this->objAction = $objAction;
        $this->objAction->SetEvent($this);
    }
    public function Exicute(){
        if(key_exists(MJaxEventPostData::KEYCODE, $_POST)){
            $this->strKeyCode = $_POST[MJaxEventPostData::KEYCODE];
        }
        $this->objControl->Form->ActiveEvent = $this;
        $this->objAction->Exicute($this->objControl->Form->FormId, $this->objControl->ControlId, $this->objControl->ActionParameter);
    }
    public function GetEventName(){
        return $this->strEventName;
    }
    public function __get($strName) {
        switch ($strName) {
            case "Once": return $this->blnOnce;
            case "Selector": return $this->strSelector;
            case "EventName": return $this->strEventName;
            case "Action": return $this->objAction;
            case "KeyCode": return $this->strKeyCode;
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
            case "Once":
                try {
                    return ($this->blnOnce = QType::Cast($mixValue, QType::Boolean));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "KeyCode":
                try {
                    return ($this->strKeyCode = $mixValue);
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
     public function Render(){
        $strRendered = sprintf("$('%s').live('%s', %s);", $this->strSelector, $this->strEventName, $this->objAction->Render());
        return $strRendered;
    }
    public function RenderUnbind(){
        if($this->blnOnce){
            $strRendered = sprintf("$(this).unbind('%s');", $this->strEventName);
            return $strRendered;
        }else{
            return '';
        }
    }
}

class MJaxClickEvent extends MJaxEventBase{
    protected $strEventName = 'click';
}
class MJaxChangeEvent extends MJaxEventBase{
    protected $strEventName = 'change';
}
class MJaxBlurEvent extends MJaxEventBase{
    protected $strEventName = 'blur';
}
class MJaxDblClickEvent extends MJaxEventBase{
    protected $strEventName = 'dblclick';
}
class MJaxFocusEvent extends MJaxEventBase{
    protected $strEventName = 'focus';
}
class MJaxFocusInEvent extends MJaxEventBase{
    protected $strEventName = 'focusin';
}
class MJaxFocusOutEvent extends MJaxEventBase{
    protected $strEventName = 'focusout';
}
class MJaxHoverEvent extends MJaxEventBase{
    protected $strEventName = 'hover';
}
class MJaxKeyDownEvent extends MJaxEventBase{
    protected $strEventName = 'keydown';
}
class MJaxKeyPressEvent extends MJaxEventBase{
    protected $strEventName = 'keypress';
}
class MJaxKeyUpEvent extends MJaxEventBase{
    protected $strEventName = 'keyup';
}
class MJaxMouseDownEvent extends MJaxEventBase{
    protected $strEventName = 'mousedown';
}
class MJaxMouseEnterEvent extends MJaxEventBase{
    protected $strEventName = 'mouseenter';
}
class MJaxMouseLeaveEvent extends MJaxEventBase{
    protected $strEventName = 'mouseleave';
}
class MJaxMouseMoveEvent extends MJaxEventBase{
    protected $strEventName = 'mousemove';
}
class MJaxMouseOutEvent extends MJaxEventBase{
    protected $strEventName = 'mouseout';
}
class MJaxMouseOverEvent extends MJaxEventBase{
    protected $strEventName = 'mouseover';
}
class MJaxMouseUpEvent extends MJaxEventBase{
    protected $strEventName = 'mouseup';
}
class MJaxResizeEvent extends MJaxEventBase{
    protected $strEventName = 'resize';
}
class MJaxScrollEvent extends MJaxEventBase{
    protected $strEventName = 'scroll';
}
class MJaxSelectEvent extends MJaxEventBase{
    protected $strEventName = 'select';
}
class MJaxSubmitEvent extends MJaxEventBase{
    protected $strEventName = 'submit';
}
class MJaxToggleEvent extends MJaxEventBase{
    protected $strEventName = 'toggle';
}
class MJaxTriggerEvent extends MJaxEventBase{
    protected $strEventName = 'trigger';
}

?>
