<?php
/*
 * This class will serve as the base form for the MJax Package
 */
class MJaxFormBase extends QBaseClass{
    const FILEINFO_BASENAME = 'basename';
    //------Static Vars------
    protected static $strCurrAction = null;
    public static $EncryptionKey = null;
    public static $FormStateHandler = 'QFormStateHandler';

    //------Instance------
    protected $arrControls = array();
    protected $intNextControlId = 1;
    protected $strFormId = null;
    protected $arrAsset = array();
    protected $strCallType = null;
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "FormId": return $this->strFormId;
            case "CallType": return $this->strCallType;
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
            case "HtmlIncludeFilePath":

            default:
                try {
                    return parent::__set($strName, $mixValue);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
        }
    }


    /////////////////////////
    // Helpers for ControlId Generation
    /////////////////////////
    public function GenerateControlId() {
        $strToReturn = sprintf('c%s', $this->intNextControlId);
        $this->intNextControlId++;
        return $strToReturn;
    }


    public static function Run($strFormId, $strAlternateHtmlFile = null) {
        // Ensure strFormId is a class
        $objClass = new $strFormId();
        $objClass->strFormId = $strFormId;
        // Ensure strFormId is a subclass of QForm
        if (!($objClass instanceof MJaxForm)){
            throw new QCallerException('Object is not a subclass of MJaxForm (note, it can NOT be a subclass of QFormBase): ' . $strFormId);
        }
        //Check to see if the form has posted data
        
        if (key_exists(MJaxFormPostData::MJaxForm__FormState, $_POST)){
                //Tell the object and the application what the call type is
                
				$strPostDataState = $_POST[MJaxFormPostData::MJaxForm__FormState];

				if($strPostDataState){
					// We might have a valid form state -- let's see by unserializing this object
					$objClass = MJaxForm::Unserialize($strPostDataState);
                }
                $objClass->ParsePostData();

                $objClass->strCallType = QCallType::Ajax;
                QApplication::$RequestMode = QRequestMode::Ajax;

        }elseif((key_exists(MJaxFormPostData::ACTION, $_POST)) && ($_POST[MJaxFormPostData::ACTION] == MJaxFormAction::CHANGE_PAGE)){
             $objClass->strCallType = QCallType::Ajax;
             QApplication::$RequestMode = QRequestMode::Ajax;
             $objClass->Form_Create();
        }else{
            $objClass->strCallType = QCallType::None;
            QApplication::$RequestMode = QRequestMode::Standard;
            $objClass->Form_Create();
        }
        if(key_exists(MJaxFormPostData::ACTION, $_POST)){
            self::$strCurrAction = $_POST[MJaxFormPostData::ACTION];
            switch(self::$strCurrAction){
                case(MJaxFormAction::CONTROL_EVENT):
                    $objClass->TriggerControlEvent($_POST[MJaxFormPostData::CONTROL_ID], $_POST[MJaxFormPostData::EVENT]);
                break;
            }
        }

        
        $objClass->Form_PreRender();
        if($objClass->strCallType == QCallType::Ajax){
            $objClass->RenderAjax();
        }else{
            $objClass->Render();
        }
        $objClass->Form_Exit();
    }
    public static function LocateTemplate($strFileName){
        $arrPathInfo = pathinfo($strFileName);
        if(strpos($strFileName, '.class') !== false){
            $strFileName = str_replace(".class.php", ".tpl.php", $arrPathInfo[self::FILEINFO_BASENAME]);
        }else{
            $strFileName = str_replace(".php", ".tpl.php", $arrPathInfo[self::FILEINFO_BASENAME]);
        }
        $strAssetFile = $arrPathInfo['dirname'] . __REL_TPL_DIR__ . "/". $strFileName;
        return $strAssetFile;
    }
    

    protected function Render(){
        require(__DOCROOT__ . __PHP_ASSETS__ . '/header.inc.php');

        require(self::LocateTemplate($_SERVER[MLCServer::SCRIPT_FILENAME]));
        $strFormState = sprintf('<input type="hidden" name="%s" id="%s" value="%s" />', MJaxFormPostData::MJaxForm__FormState, MJaxFormPostData::MJaxForm__FormState, MJaxForm::Serialize($this));
        _p($strFormState, false);
        
        require(__DOCROOT__ . __PHP_ASSETS__ . '/footer.inc.php');
    }
    protected function RenderAjax(){
        ob_clean();
        
        // Output it and update render state
				if (QApplication::$EncodingType)
					_p(sprintf("<?xml version=\"1.0\" encoding=\"%s\"?>\r\n", QApplication::$EncodingType), false);
				else
					_p("<?xml version=\"1.0\"?>\r\n", false);
        require(__DOCROOT__ . __PHP_ASSETS__ . '/header_ajax.inc.php');

        require(self::LocateTemplate($_SERVER[MLCServer::SCRIPT_FILENAME]));
        $strFormState = sprintf('<input type="hidden" name="%s" id="%s" value="%s" />', MJaxFormPostData::MJaxForm__FormState, MJaxFormPostData::MJaxForm__FormState, MJaxForm::Serialize($this));
        _p($strFormState, false);
        require(__DOCROOT__ . __PHP_ASSETS__ . '/footer_ajax.inc.php');
        header('Content-Type: text/xml');
        
    }
    public function RenderControlJSCalls($blnPrint = true, $blnAjaxFormating = false){
        //Cycle through all controls and get their JS calls for this time
        $strRendered = '';
        
        foreach($this->arrControls as $objControl){
            $strRendered .= $objControl->RenderJSCalls($blnAjaxFormating);
        }
        if($blnAjaxFormating){
            $strRendered = QString::XmlEscape(trim($strRendered));
        }
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    public function TriggerControlEvent($strControlId, $strEvent){
        if(!key_exists($strControlId, $this->arrControls)){
            throw new QCallerException("Control '" . $strControlId . "' does not exist");
        }
        $this->arrControls[$strControlId]->TriggerEvent($strEvent);

    }
    public function RegisterControl($objControl){
        $strControlId = $objControl->ControlId;
        if(key_exists($strControlId, $this->arrControls)){
                throw new QCallerException("A control with the Id '" . $strControlId . "' already exists");
        }
        $this->arrControls[$strControlId] = $objControl;
    }
    public function AddHeaderAsset($objAsset){
        $this->arrAsset[] = $objAsset;
    }
    public function RenderHeaderAssets($blnPrint  = true){
        $strRender = '';
        foreach($this->arrAsset as $objAsset){
            $strRender .= $objAsset->__toString();
        }
        if($blnPrint){
            _p($strRender, false);
        }else{
            return $strRender;
        }
        
    }
    public function RenderControlRegisterJS($blnPrint = true, $blnAjaxFormating = false){
       $strRendered = '';
       if(!$blnAjaxFormating){
            $strRendered .= "<script language='javascript'>\n\t";
       }
       $strRendered .= "$(document).ready(function(){\n\t";
       $strRendered .= "MJax.ClearRegisteredControls();\n\t";
       foreach($this->arrControls as $objControl){
            $strRendered .= sprintf("MJax.RegisterControl('%s');\n\t", $objControl->ControlId);
       }
       $strRendered .= "});\n\t";
       if(!$blnAjaxFormating){
            $strRendered .= "</script>";
       }
       if($blnAjaxFormating){
            $strRendered = QString::XmlEscape(trim($strRendered));
        }
       if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    public function ParsePostData(){
        foreach($this->arrControls as $objControl){
            $objControl->ParsePostData();
        }
    }
    protected function Form_Run() {}
    protected function Form_Load() {}
    protected function Form_Create() {}
    protected function Form_PreRender() {}
    protected function Form_Validate() {return true;}
    protected function Form_Exit() {}
    
    /**
     * @param Form $objForm
     * @return string the Serialized Form
     */
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

    /**
     * @param string $strSerializedForm
     * @return Form the Form object
     */
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

}
?>