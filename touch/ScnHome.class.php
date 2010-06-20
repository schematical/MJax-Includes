<?php
/* 
 * A simple home screen
 */
class ScnHome extends MJaxTouchScreen{
    public $btnNext = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __DOCROOT__ . __VIRTUAL_DIRECTORY__ . __TPL_ASSETS__ . '/' . get_class($this) . '.tpl.php';
        
    }
    public function Create_Controls() {
        $this->btnNext = new MJaxTouchLinkButton($this, 'btnNext');
        $this->btnNext->Text = "Next";
        $this->btnNext->AddAction(new MJaxClickEvent(), new MJaxSelectSceenAction($this->objForm->scnList));
        parent::Create_Controls();
    }
}
?>
