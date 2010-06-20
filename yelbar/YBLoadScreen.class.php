<?php
/*
 * A load screen to be rendered when the first call is made
 */
class YBLoadScreen extends MJaxTouchScreen{
   

    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __DOCROOT__ . __VIRTUAL_DIRECTORY__ . __TPL_ASSETS__ . '/yelbar/' . get_class($this) . '.tpl.php';
        $this->Attr('transition','slide');
        $this->AddAction(new MJaxTouchLocationEvent(), new MJaxTouchServerControlAction($this, 'scnYBLoadScreen_location'));
    }
    
    public function Create_Controls() {
        parent::Create_Controls();
    }
    public function scnYBLoadScreen_location(){
        $blnSuccess = YBAuthDriver::UpdateUserLocation($this->objForm->GetLocation());
        
    }
 
}
?>
