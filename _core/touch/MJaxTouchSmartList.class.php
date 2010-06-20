<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MJaxTouchSmartList extends MJaxTouchList{
    protected $strDataClass = null;
    protected $mixQuery = null;
    protected $mixChild = null;
    protected $strTextProperty = '__toString';
    protected $strActionParameterProperty = null;
    protected $arrEvents = array();
    protected $arrActions = array();
    protected $arrChildCssClasses = array();
    protected $arrProperties = array();
    protected $blnPopulated = false;
    protected $arrPopulatedChildren = array();
    public static function Populate($strDataClass, $mixChild = null, $mixQuery = null){
         $this->strDataClass = $strDataClass;
         $this->mixChild = $mixChild;
         $this->mixQuery = $mixQuery;

         $strDataClass = $this->strDataClass;

         $objDataClass = new $$strDataClass();
         $arrResult = $objDataClass->QueryArray($this->mixQuery);
         foreach($arrResult as $objResult){
             $strTextProperty = $this->strTextProperty;
             if(is_null($this->mixChild)){
                $ctlChild = parent::AddListItem($objResult->$strTextProperty);
             }else{
                $ctlChild = parent::AddListItem($this->mixChild);
                $ctlChild->Text = $objResult->$strTextProperty;
             }
             if(!is_null($this->strActionParameterProperty)){
                 $strActionParameterProperty = $this->strActionParameterProperty;
                 $ctlChild->ActionParameter = $objResult->$strActionParameterProperty;
             }
             //Add Action
             for($i = 0; $i < $this->arrEvents; $i++){
                $mixEvent = clone($this->arrEvents[$i]);
                $mixAction = clone($this->arrActions[$i]);
                $ctlChild->AddAction($mixEvent,$mixAction);
             }
             //Add Css Classes
             foreach($this->arrChildCssClasses as $cssChildClass){
                $ctlChild->AddCssClass($cssChildClass);
             }
             $this->arrPopulatedChildren[] = $ctlChild;
         }
        

         $blnPopulated = true;
    }

    public function AddChildCssClass($cssClass){
        $this->arrChildCssClasses[] = $cssClass;
        if($blnPopulated){
            foreach($this->arrPopulatedChildren as $ctlChild){
                $ctlChild->AddCssClass($cssClass);
            }
        }
    }
    public function AddChildAction($objEvent, $objAction){
        $intNewIndex = count($this->arrEvents);
        $this->arrEvents[$intNewIndex] = $objEvent;
        $this->arrActions[$intNewIndex] = $objAction;
        if($blnPopulated){
            foreach($this->arrPopulatedChildren as $ctlChild){
                $ctlChild->AddAction(clone($objEvent), clone($objEvent));
            }
        }
    }
     /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "TextProperty": return $this->strTextProperty;
            case "ActionParameterProperty": return $this->strActionParameterProperty;

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
            case "ActionParameterProperty":
                try {
                    return ($this->strActionParameterProperty = $mixValue);
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
            case "TextProperty":
                try {
                    return ($this->strTextProperty = $mixValue);
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

}
?>
