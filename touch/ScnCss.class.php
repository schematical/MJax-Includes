<?php
/*
 * A simple list screen
 */
class ScnClass extends MJaxTouchScreen{
    public $lstMain = null;
    
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __DOCROOT__ . __VIRTUAL_DIRECTORY__ . __TPL_ASSETS__ . '/' . get_class($this) . '.tpl.php';
       
    }
    public function Create_Controls() {
        $this->lstMain = new MJaxTouchList($this, 'lstMain');

        $btnLink = $this->lstMain->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->ActionParameter = '';
        $btnLink->Text = 'Calculator Demo';


        $btnLink = $this->lstMain->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->Text = 'Transition Demo';
        $btnLink->ActionParameter = 'scnTransition';

        $btnLink = $this->lstMain->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->Text = 'Class Demo';
        $btnLink->ActionParameter = 'scnHome';
        
        parent::Create_Controls();
    }
    public function btnLink_click($strFormId, $strControlId, $strActionParam){
        $this->objForm->SetActiveScreen($strActionParam);
    }
}
?>
