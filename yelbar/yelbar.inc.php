<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('__YB__', dirname(__FILE__));
define('__YB_CORE__', dirname(__FILE__));

QApplicationBase::$ClassFile['YBAuthDriver'] = __YB_CORE__ . '/YBAuthDriver.class.php';

QApplicationBase::$ClassFile['YBHomeScreen'] = __YB_CORE__ . '/YBHomeScreen.class.php';
QApplicationBase::$ClassFile['YBLoadScreen'] = __YB_CORE__ . '/YBLoadScreen.class.php';
QApplicationBase::$ClassFile['YBLoginScreen'] = __YB_CORE__ . '/YBLoginScreen.class.php';


require_once(__YB_CORE__ . "/_enum.php");
?>
