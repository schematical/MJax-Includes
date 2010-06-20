<?php
/*
 * A simple list screen
 */
class YBHomeScreen extends MJaxTouchScreen{
    public $txtMessage = null;
    public $lstMain = null;

    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __DOCROOT__ . __VIRTUAL_DIRECTORY__ . __TPL_ASSETS__ . '/yelbar/' . get_class($this) . '.tpl.php';

    }
    
    public function Create_Controls() {
      
        
        $this->ReloadMessages();

        parent::Create_Controls();
    }
    public function Screen_Activate() {
        parent::Screen_Activate();
        $this->objForm->TriggerPostLocationData();
    }
    public function ReloadMessages(){
        if(!is_null($this->lstMain)){
            $this->RemoveControl($this->lstMain, true);
        }
        $this->lstMain = new MJaxTouchList($this, 'lstMain');

        $this->txtMessage = $this->lstMain->AddListItem('MJaxTouchTextBox', 'txtMessage');
        $this->txtMessage->Attr('placeholder', 'Message');


        $btnLink = $this->lstMain->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->Text = 'Send';
        $arrMessages = Message::LoadAll();
        $objLocationData = YBAuthDriver::UserLocationData();
        foreach($arrMessages as $objMessage){
            $strBody = $objMessage->Attr(MessageAttrType::BODY);
            $fltDist = $objLocationData->FindDistanceFrom($objMessage->Lat, $objMessage->Long);
            $this->lstMain->AddListItem($strBody . " (" . round($fltDist,2) . ")");
        }
    }
    public function btnLink_click($strFormId, $strControlId, $strActionParam){
        $objMessage = new Message();
        $objMessage->IdUser = YBAuthDriver::IdUser();
        $objLocationData = YBAuthDriver::UserLocationData();
        $objMessage->Lat = $objLocationData->Lat;
        $objMessage->Long = $objLocationData->Long;
        $objMessage->Save();
        $objMessage->Attr(MessageAttrType::BODY, $this->txtMessage->Text);        
         
    }
}
?>
