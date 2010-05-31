<?php
/*
 * A simple list screen
 */
class ScnList extends MJaxTouchScreen{
    public $lstMain = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __DOCROOT__ . __VIRTUAL_DIRECTORY__ . __TPL_ASSETS__ . '/' . get_class($this) . '.tpl.php';
        $this->lstMain = new MJaxTouchList($this, 'lstMain');

    }
}
?>
