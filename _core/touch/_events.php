<?php
class MJaxTouchClickEvent extends MJaxEventBase{
    protected $strEventName = 'click';
}
class MJaxTouchTapEvent extends MJaxEventBase{
    protected $strEventName = 'tap';
}
class MJaxTouchSwipeEvent extends MJaxEventBase{
    protected $strEventName = 'swipe';
}
class MJaxTouchTurnEvent extends MJaxEventBase{
    protected $strEventName = 'turn';
}
class MJaxTouchAnimationStartEvent extends MJaxEventBase{
    protected $strEventName = 'pageAnimationStart';
}
class MJaxTouchAnimationEndEvent extends MJaxEventBase{
    protected $strEventName = 'pageAnimationEnd';
}
/**
 * This class sets the MJaxScreen to repost its self when ever the form location is updated
 */
class MJaxTouchLocationEvent extends MJaxEventBase{
    protected $strEventName = 'updateformlocation';
    
    public function Render(){
        
        $strRendered = sprintf("$(document).bind('%s', %s);", $this->strEventName, $this->objAction->Render());
        $this->blnRendered = true;
        return $strRendered;
    }
    public function RenderUnbind(){
        $strRendered = sprintf("$(document).unbind('%s');", $this->strEventName);
    }
}
/**
 * This class sets the MJaxScreen to repost its self at certain intervulls
 * Would be great in a chat application
 */
class MJaxTouchTimerEvent extends MJaxEventBase{
    protected $intMiliSeconds = null;
    protected $strLabel = null;
    protected $intTimes = null;
    public function __construct($intMiliSeconds, $strLabel, $intTimes) {
        $this->intMiliSeconds = $intMiliSeconds;
        $this->strLabel = $strLabel;
        $this->intTimes = $intTimes;
    }
    public function Render(){
        if(!is_null($this->intTimes)){
            $strRendered = sprintf("$(document).everyTime(%d, %s, %s, %d);", $this->intMiliSeconds, $this->strLabel, $this->objAction->Render(), $this->intTimes);
        }else{
            $strRendered = sprintf("$(document).everyTime(%d, %s, %s);", $this->intMiliSeconds, $this->strLabel, $this->objAction->Render());
        }
        $this->blnRendered = true;
        return $strRendered;
    }
    public function RenderUnbind(){}
}
?>