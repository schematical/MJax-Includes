<?php
/* 
 * This class manages screens on a
 */
class MJaxTouchPageBase extends MJaxFormBase{
    protected $scnActiveScreen = null;
    protected $arrScreens = array();
    public static function Run($strFormId,$strAlternateHtmlFile = null){
         // Ensure strFormId is a class
        $objClass = new $strFormId();
        $objClass->strFormId = $strFormId;
        // Ensure strFormId is a subclass of QForm
        if (!($objClass instanceof MJaxTouchPage)){
            throw new QCallerException('Object is not a subclass of MJaxTouchPage (note, it can NOT be a subclass of QFormBase): ' . $strFormId);
        }
        //Check to see if the form has posted data

        if (key_exists(MJaxFormPostData::MJaxForm__FormState, $_POST)){
                //Tell the object and the application what the call type is

				$strPostDataState = $_POST[MJaxFormPostData::MJaxForm__FormState];

				if($strPostDataState){
					// We might have a valid form state -- let's see by unserializing this object
					$objClass = MJaxTouchPage::Unserialize($strPostDataState);
                }
                $objClass->ParsePostData();

                $objClass->strCallType = QCallType::Ajax;
                QApplication::$RequestMode = QRequestMode::Ajax;

        }elseif((key_exists(MJaxFormPostData::ACTION, $_POST)) && ($_POST[MJaxFormPostData::ACTION] == MJaxFormAction::CHANGE_PAGE)){
             $objClass->strCallType = QCallType::Ajax;
             QApplication::$RequestMode = QRequestMode::Ajax;
        }else{
            $objClass->strCallType = QCallType::None;
            QApplication::$RequestMode = QRequestMode::Standard;
        }
        if(key_exists(MJaxFormPostData::ACTION, $_POST)){
            self::$strCurrAction = $_POST[MJaxFormPostData::ACTION];
            switch(self::$strCurrAction){
                case(MJaxFormAction::CONTROL_EVENT):
                    $objClass->TriggerControlEvent($_POST[MJaxFormPostData::CONTROL_ID], $_POST[MJaxFormPostData::EVENT]);
                break;
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
        $strHeader = $this->EvaluateTemplate(__DOCROOT__ . __PHP_ASSETS__ . '/mjax_touch/touch_header.inc.php');
        _p($strHeader, false);
        //require(self::LocateTemplate($this->strTemplate));
        foreach($this->arrScreens as $scnScreen){
            $this->Render();
        }
        $strFooter = $this->EvaluateTemplate(__DOCROOT__ . __PHP_ASSETS__ . '/mjax_touch/touch_footer.inc.php');
        $strFormState = sprintf('<input type="hidden" name="%s" id="%s" value="%s" />', MJaxFormPostData::MJaxForm__FormState, MJaxFormPostData::MJaxForm__FormState, MJaxForm::Serialize($this));
        _p($strFormState, false);
        _p($strFooter, false);


    }
    /**
     * This function is a bit different then the MJaxForm being as it does NOT return XML instead just a single element to match the one posted
     */
    protected function RenderAjax(){
        //basically render the active screen
       

    }
    public function SetActiveScreen(){
        
    }
}
?>
