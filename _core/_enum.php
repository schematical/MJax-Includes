<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
abstract class MJaxFormPostData{
    const ACTION = 'action';
    const CONTROL_ID = 'control_id';
    const EVENT = 'event';
    const MJaxForm__FormState = 'MJaxForm__FormState';
}
abstract class MJaxFormAction{
    const CONTROL_EVENT = 'control_event';
    const CHANGE_PAGE = 'change_page';
}
abstract class MJaxEventPostData{
    const KEYCODE = 'keyCode';
}

?>
