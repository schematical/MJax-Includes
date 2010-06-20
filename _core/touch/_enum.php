<?php
/* 
 * the transition animations
 * NOTE: Custom animations are also http://code.google.com/p/jqtouch/wiki/Animations
 */
abstract class MJaxTouchTransition{
    const SLIDE = 'slide';
    const SLIDEUP = 'slideup';
    const DISSOLVE = 'dissolve';
    const FADE = 'fade';
    const FLIP = 'flip';
    const POP = 'pop';
    const SWAP = 'swap';
    const CUBE = 'cube';
}
abstract class MJaxTouchTextMode{
    const SingleLine = 'SingleLine';
    const MultiLine = 'MultiLine';
    const Password = 'Password';
}
abstract class MJaxTouchCssClass{
    /*-----MJax----------*/
    const MJaxTouchForm = 'MJaxTouchForm';
    /*-----Function------*/
    const FORM = 'form';
    const CANCEL = 'cancel';
    const GOBACK = 'goback';
    const SUBMIT = 'submit';
    /*-----Position------*/
    const TOOLBAR = 'toolbar';
    const BACK = 'back';
    const FORWARD = 'forward';
    /*-----style ----*/
    const PLASTIC = 'plastic';
    const METAL = 'metal';
    const EDGE = 'edgetoedge';
    const ROUNCED = 'rounded';
    const INFO = 'info';
}
abstract class MJaxTouchScreenPostData{
    const CONTROL_ID = 'control_id';
    const EVENT = 'event';
    const EVENT_TYPE = 'event_type';
    const MJaxTouchPage__FormState = 'MJaxTouchPage__FormState';
    const ACTIVE_SCREEN = 'active_screen';

}
abstract class MJaxTouchPageEvent{
    const LOAD_SCREEN = 'load_screen';
    const CONTROL_EVENT = 'control_event';
}
?>
