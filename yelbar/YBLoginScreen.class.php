<?php
/*
 * A simple list screen
 */
class YBLoginScreen extends MJaxTouchScreen{
    public $pnlError = null;
    public $txtEmail = null;
    public $txtPassword = null;
    public $lstMain = null;

    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __DOCROOT__ . __VIRTUAL_DIRECTORY__ . __TPL_ASSETS__ . '/yelbar/' . get_class($this) . '.tpl.php';

    }
    
    public function Create_Controls() {
        $this->lstMain = new MJaxTouchList($this, 'lstLogin');

        $this->pnlError = $this->lstMain->AddListItem('MJaxTouchPanel', 'pnlError');

        $this->txtEmail = $this->lstMain->AddListItem('MJaxTouchTextBox', 'txtEmail');
        $this->txtEmail->Attr('placeholder', 'Username');

        $this->txtPassword = $this->lstMain->AddListItem('MJaxTouchTextBox', 'txtPassword');
        $this->txtPassword->TextMode = MJaxTouchTextMode::Password;
        $this->txtPassword->Attr('placeholder', 'Password');

        $btnLogin = $this->lstMain->AddListItem('MJaxTouchLinkButton');
        $btnLogin->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLogin_click'));
        $btnLogin->Text = 'Login';

        parent::Create_Controls();
    }
    public function btnLogin_click($strFormId, $strControlId, $strActionParam){
        $strEmail = $this->txtEmail->Text;
        $strPassword = $this->txtPassword->Text;
        $blnSuccess = YBAuthDriver::Authenticate($strEmail, $strPassword);
        if($blnSuccess){
            
        }else{
            if(eregi('^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$', $strEmail) && strlen($strPassword) >= 6){
                $objUser = YBAuthDriver::CreateUser($strEmail, $strPassword, 1, UserTypeCdTpcd::RecUser);
                $blnSuccess = YBAuthDriver::Authenticate($strEmail, $strPassword);
            }else{
                $this->pnlError->Text = 'Please enter in a valid email and a password longer than 6 charecters long';
                return false;
            }
            if(!$blnSuccess){
                $this->pnlError->Text = 'We were unable to create a user account for you at this time';
                return false;
            }
        }
        $this->objForm->SetActiveScreen($this->objForm->scnHome);
    }
}
?>
