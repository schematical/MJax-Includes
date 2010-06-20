<?php
/*
 * This class manages screens on a
 */
class MJaxTouchPageBase extends MJaxForm{
    public static $strCurrEvent = null;

    protected $scnActiveScreen = null;
    protected $arrScreens = array();
    protected $objConfig = null;
    protected $arrHistory = array();
    protected $arrJSAppCalls = array();
    protected $strDefaultTransition = 'slide';
    protected $strDefaultBackTransition = 'back';
    protected $blnPostLocationData = false;
    protected $scnLoadScreen = null;




    public static function Run($strFormId,$strAlternateHtmlFile = null){



         // Ensure strFormId is a class
        $objClass = new $strFormId();
        //Set Default CallTypes
        $objClass->strCallType = QCallType::None;
        QApplication::$RequestMode = QRequestMode::Standard;


        $objClass->objConfig = new MJaxTouchConfig();

        $objClass->strFormId = $strFormId;
        // Ensure strFormId is a subclass of QForm
        if (!($objClass instanceof MJaxTouchPage)){
            throw new QCallerException('Object is not a subclass of MJaxTouchPage (note, it can NOT be a subclass of QFormBase): ' . $strFormId);
        }
        //Check to see if the form has posted data

        if (key_exists(MJaxTouchScreenPostData::MJaxTouchPage__FormState, $_POST)){
                //Tell the object and the application what the call type is

				$strPostDataState = $_POST[MJaxTouchScreenPostData::MJaxTouchPage__FormState];

				if($strPostDataState){
					// We might have a valid form state -- let's see by unserializing this object
					$objClass = MJaxTouchPage::Unserialize($strPostDataState);
                }
                $objClass->ParsePostData();

                $objClass->strCallType = QCallType::Ajax;
                QApplication::$RequestMode = QRequestMode::Ajax;

        }

        if(key_exists(MJaxTouchScreenPostData::EVENT, $_POST)){
            self::$strCurrEvent = $_POST[MJaxTouchScreenPostData::EVENT];
            switch(self::$strCurrEvent){
                case(MJaxTouchPageEvent::LOAD_SCREEN):
                     $objClass->SetActiveScreen($_POST[MJaxTouchScreenPostData::ACTIVE_SCREEN]);
                break;
                case(MJaxTouchPageEvent::CONTROL_EVENT):
                    $objClass->TriggerControlEvent($_POST[MJaxTouchScreenPostData::CONTROL_ID], $_POST[MJaxTouchScreenPostData::EVENT_TYPE]);
                break;
            }
        }else{
            $objClass->Form_Create();
            if(!is_null($objClass->scnLoadScreen)){
                $objClass->AddJSAppCall('SetLoadScreenId', array(sprintf('"%s"', $objClass->scnLoadScreen->ControlId)));
                $objClass->AddJSAppCall('SetActiveScreenId', array(sprintf('"%s"', $objClass->scnActiveScreen->ControlId)));
            }
        }
        //Figure out template situation
        if(is_null($strAlternateHtmlFile)){
            $objClass->strTemplate = $_SERVER[MLCServer::SCRIPT_FILENAME];
        }else{
            $objClass->strTemplate = $strAlternateHtmlFile;
        }
        //Call the appropriate render
        if($objClass->strCallType == QCallType::Ajax){
            $objClass->RenderAjax();
        }else{
            $objClass->Render();
        }

    }


    protected function Render(){
        $strRendered = '';
        $strHeader = $this->EvaluateTemplate(__DOCROOT__ . __TPL_ASSETS__ . '/touch_header.inc.php');
        _p($strHeader, false);
        if(!is_null($this->scnLoadScreen)){
            $this->scnLoadScreen->RenderOnLoad = true;
        }
        foreach($this->arrScreens as $scnScreen){
            if(($this->scnActiveScreen->ControlId != $scnScreen->ControlId) && ($scnScreen->RenderOnLoad)){
                $strRendered .= $scnScreen->Render(false);
            }
        }
        foreach($this->arrScreens as $scnScreen){
            if(($this->scnActiveScreen->ControlId == $scnScreen->ControlId)){
                $strRendered .= $scnScreen->Render(false);
            }
        }
        $strFooter = $this->EvaluateTemplate(__DOCROOT__ . __TPL_ASSETS__ . '/touch_footer.inc.php');
        _p($strRendered, false);
        _p($strFooter, false);


    }
    /**
     * This function is a bit different then the MJaxForm being as it does NOT return XML instead just a single element to match the one posted
     */
    protected function RenderAjax(){
        //basically render the active screen
       $strRendered = '';

        foreach($this->arrScreens as $scnScreen){
            if($this->scnActiveScreen->ControlId == $scnScreen->ControlId){
                $strRendered .= $scnScreen->Render(false, true);
            }
        }

        _p($strRendered, false);


    }
    public function RenderFormState($blnPrint = true, $blnRenderForAjax = false){
        $strFooter = $this->EvaluateTemplate(__DOCROOT__ . __TPL_ASSETS__ . '/touch_footer.inc.php');
        $strAjaxAfter = ($blnRenderForAjax?'_ajax':'');
        $objForm = clone $this;
        $strFormState = sprintf('<input type="hidden" name="%s%s" id="%s%s" value="%s" />', MJaxTouchScreenPostData::MJaxTouchPage__FormState, $strAjaxAfter,MJaxTouchScreenPostData::MJaxTouchPage__FormState, $strAjaxAfter, MJaxForm::Serialize($objForm));
        $strFormState .= sprintf('<input type="hidden" name="%s%s" id="%s%s" value="%s" />', MJaxTouchScreenPostData::CONTROL_ID, $strAjaxAfter, MJaxTouchScreenPostData::CONTROL_ID, $strAjaxAfter, '');
        $strFormState .= sprintf('<input type="hidden" name="%s%s" id="%s%s" value="%s" />', MJaxTouchScreenPostData::EVENT, $strAjaxAfter, MJaxTouchScreenPostData::EVENT, $strAjaxAfter, '');
        $strFormState .= sprintf('<input type="hidden" name="%s%s" id="%s%s" value="%s" />', MJaxTouchScreenPostData::ACTIVE_SCREEN, $strAjaxAfter, MJaxTouchScreenPostData::ACTIVE_SCREEN, $strAjaxAfter, $this->scnActiveScreen->ControlId);
        if($blnPrint){
            _p($strFormState, false);
        }else{
            return $strFormState;
        }
    }
    public function RegisterScreen($scnScreen){
        $this->arrScreens[$scnScreen->ControlId] = $scnScreen;
        if(is_null($this->scnActiveScreen)){
            $this->scnActiveScreen = $scnScreen;
        }
    }
    public function SetActiveScreen($scnScreen){

        if((is_numeric($scnScreen)) && ($scnScreen == -1)){
            $intIndex = (count($this->arrHistory)-1) + $scnScreen;
            if($intIndex < 0){
                $intIndex = 0;
            }

            $scnScreen = $this->arrHistory[$intIndex];
            $scnScreen->Attr('goBack', $this->arrHistory[count($this->arrHistory)-1]->ControlId);
            array_pop($this->arrHistory);


        }elseif($scnScreen instanceof MJaxTouchScreen){
            $this->arrHistory[] = $scnScreen;
        }elseif(is_string($scnScreen)){
            if(!key_exists($scnScreen, $this->arrScreens)){
                throw new QCallerException("No such screen has been registered (" . $scnScreen . ")");
            }
            $scnScreen = $this->arrScreens[$scnScreen];
            $this->arrHistory[] = $scnScreen;
        }
        $this->scnActiveScreen->Screen_Deactivate();
        $this->scnActiveScreen = $scnScreen;
        $this->scnActiveScreen->Screen_Activate();

    }

    public function RenderControlRegisterJS($blnPrint = true){
       $strRendered = '';

       $strRendered .= "$(document).ready(function(){\n\t";
       $strRendered .= "MJaxTouch.ClearRegisteredControls();\n\t";
       foreach($this->arrControls as $objControl){
            $strRendered .= sprintf("MJaxTouch.RegisterControl('%s');\n\t", $objControl->ControlId);
       }
       $strRendered .= "});\n\t";

       if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    public function RenderControlJSCalls($blnPrint = true){
        //Cycle through all controls and get their JS calls for this time
        $strRendered = '';

        foreach($this->arrControls as $objControl){

            $strRendered .= $objControl->RenderJSCalls() ."\n\n";
        }



        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    public function AddJSAppCall($strFunction, $arrParameters = array()){
        $this->arrJSAppCalls[] = new MJaxTouchJSAppCall($strFunction, $arrParameters);
    }

    public function RenderJSAppCalls($blnPrint = true, $blnCleanUp = true){
        //Sets up the JS to send the nav every time

        $strDocumentReady = '';
        foreach($this->arrJSAppCalls as $objJSAppCall){
            $strDocumentReady .= $objJSAppCall->Render(false);
        }

        //Get rid of old js calls so they dont get rendered next time
        if($blnCleanUp){
            $this->arrJSAppCalls = array();
        }
        if(strlen($strDocumentReady) > 1){
            $strRendered = "$(document).ready(function(){\n\t";
            $strRendered .= $strDocumentReady;
            $strRendered .= "});\n\t";
        }else{
            $strRendered = '';
        }
        if($blnPrint){
            _p($strRendered);
        }else{
            return $strRendered;
        }

    }
    public function RemoveChildControl($ctlChild){
        if(key_exists($ctlChild->ControlId, $this->arrControls)){
            unset($this->arrControls[$ctlChild->ControlId]);
        }
        if(key_exists($ctlChild->ControlId, $this->arrScreens)){
            unset($this->arrScreens[$ctlChild->ControlId]);
        }
    }
    ////////////////////////
    // Location Based Functionality
    ///////////////////////

    public function TriggerPostLocationData(){
            $this->AddJSAppCall('TriggerPostLocationData');
    }
    public function GetLocation(){
        //Checks to see if stuff was posted
        return new MJaxTouchLocationData();
    }

    /////////////////////////
    // Public Properties: GET
    /////////////////////////
   public function __get($strName) {
        switch ($strName) {
            case "ActiveScreen": return $this->scnActiveScreen;
            case "DefaultTransition": return $this->strDefaultTransition;
            case "DefaultBackTransition": return $this->strDefaultBackTransition;
            case "Location": return $this->GetLocation();
            case "LoadScreen": return $this->scnLoadScreen;
            default:
                try {
                    return parent::__get($strName);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }
      /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue) {
        switch ($strName) {
            case "PostLocationData":
                try {
                    return ($this->SetPostLocationData(QType::Cast($mixValue, QType::Boolean)));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "DefaultTransition":
                try {
                    return ($this->strDefaultTransition = QType::Cast($mixValue, QType::String));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
             case "LoadScreen":
                try {
                    return ($this->scnLoadScreen = $mixValue);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
             case "DefaultBackTransition":
                try {
                    return ($this->strDefaultBackTransition = QType::Cast($mixValue, QType::String));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            default:
                try {
                    return parent::__set($strName, $mixValue);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }
    /*
     *

    public static function Serialize(MJaxForm $objForm) {
         // Create a Clone of the Form to Serialize
        $objForm = clone($objForm);

        // Cleanup Reverse Control->Form links
        if($objForm->arrControls){
            foreach ($objForm->arrControls as $objControl){
                $objControl->SetForm(null);
            }
        }
        // Use PHP "serialize" to serialize the form
        $strSerializedForm = serialize($objForm);

        // Setup and Call the FormStateHandler to retrieve the PostDataState to return
        $strSaveCommand = array(MJaxForm::$FormStateHandler, 'Save');
        $strPostDataState = call_user_func_array($strSaveCommand, array($strSerializedForm, false));

        // Return the PostDataState
        return $strPostDataState;
    }


    public static function Unserialize($strPostDataState) {
        // Setup and Call the FormStateHandler to retrieve the Serialized Form
        $strLoadCommand = array(MJaxForm::$FormStateHandler, 'Load');
        $strSerializedForm = call_user_func($strLoadCommand, $strPostDataState);

        if ($strSerializedForm) {
            // Unserialize and Cast the Form
            $objForm = unserialize($strSerializedForm);
            $objForm = QType::Cast($objForm, 'MJaxForm');

            // Reset the links from Control->Form
            if ($objForm->arrControls){
                foreach($objForm->arrControls as $objControl){
                    $objControl->SetForm($objForm);
                }
            }

            // Return the Form
            return $objForm;
        } else
            return null;
    }
     */
}
?>