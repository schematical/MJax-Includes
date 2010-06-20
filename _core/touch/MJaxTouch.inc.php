<?php
    
    define("__MJAX_TOUCH__", __MJAX__ . "/touch");
    define("__MJAX_TOUCH_CORE__", __MJAX_CORE__ . "/touch");
    QApplicationBase::$ClassFile['MJaxTouchConfig'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchConfig.class.php';
    QApplicationBase::$ClassFile['MJaxTouchControl'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchControl.class.php';
    QApplicationBase::$ClassFile['MJaxTouchControlBase'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchControlBase.class.php';
    QApplicationBase::$ClassFile['MJaxTouchList'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchList.class.php';
    QApplicationBase::$ClassFile['MJaxTouchListItem'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchListItem.class.php';
    QApplicationBase::$ClassFile['MJaxTouchPage'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchPage.class.php';
    QApplicationBase::$ClassFile['MJaxTouchPageBase'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchPageBase.class.php';
    QApplicationBase::$ClassFile['MJaxTouchScreen'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchScreen.class.php';
    QApplicationBase::$ClassFile['MJaxTouchLinkButton'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchLinkButton.class.php';
    QApplicationBase::$ClassFile['MJaxTouchPanel'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchPanel.class.php';
    QApplicationBase::$ClassFile['MJaxTouchSelectBox'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchSelectBox.class.php';
    QApplicationBase::$ClassFile['MJaxTouchSelectItem'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchSelectItem.class.php';
    QApplicationBase::$ClassFile['MJaxTouchTextBox'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchTextBox.class.php';
    QApplicationBase::$ClassFile['MJaxTouchJSAppCall'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchJSAppCall.class.php';
    QApplicationBase::$ClassFile['MJaxTouchLocationData'] = __MJAX_TOUCH_CORE__ . '/MJaxTouchLocationData.class.php';

    require_once(__MJAX_TOUCH_CORE__ .  "/_enum.php");
    require_once(__MJAX_TOUCH_CORE__ .  "/_actions.php");
    require_once(__MJAX_TOUCH_CORE__ .  "/_events.php");

    /*-----NON CORE FILES--------*/
    QApplicationBase::$ClassFile['ScnHome'] = __MJAX_TOUCH__ . '/ScnHome.class.php';
    QApplicationBase::$ClassFile['ScnList'] = __MJAX_TOUCH__ . '/ScnList.class.php';
    QApplicationBase::$ClassFile['ScnForm'] = __MJAX_TOUCH__ . '/ScnForm.class.php';
    QApplicationBase::$ClassFile['ScnTransition'] = __MJAX_TOUCH__ . '/ScnTransition.class.php';
    QApplicationBase::$ClassFile['ScnTransitionFinish'] = __MJAX_TOUCH__ . '/ScnTransitionFinish.class.php';

    require_once(__MJAX__ . '/yelbar/yelbar.inc.php');
?>
