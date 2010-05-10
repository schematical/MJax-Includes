<?php
/* 
 * This will contain the code needed to generate a select box
 */
class MJaxListBox extends MJaxControlBase{
    protected $arrListItems = array();
    public function Render($blnPrint = true){
        $strRendered = parent::Render();
        $strRendered .= sprintf("<select id='%s' name='%s'>\n", $this->strControlId, $this->strControlId);
         foreach($this->arrListItems as $objListItem){
            //render list items
            $strRendered .= $objListItem->__toString();
         }
        $strRendered .= "</select>\n";
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    public function ParsePostData() {
			// Check to see if this Control's Value was passed in via the POST data
			if (array_key_exists($this->strControlId, $_POST)) {
				// It was -- update this Control's value with the new value passed in via the POST arguments
				$strValue = $_POST[$this->strControlId];

                foreach($this->arrListItems as $objListItem){
                    if($objListItem->Value == $strValue){
                        $objListItem->Selected = true;
                    }
                }
            }
    }
    public function AddItem($strText, $strValue = null, $blnSelected = false){
        if($strText instanceof MJaxListItem){
            $this->arrListItems[] = $strText;
        }else{
            $this->arrListItems[] = new MJaxListItem($strText, $strValue);
        }
    }
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName) {
        switch ($strName) {
            case "SelectedItem":
                $arrSelected = array();
                 foreach($this->arrListItems as $objListItem){
                    if($objListItem->Selected){
                        $arrSelected[] = $objListItem;
                    }
                }
                if(count($arrSelected) == 0){
                    return null;
                }elseif(count($arrSelected) == 1){
                    return $arrSelected[0];
                }else{
                    return $arrSelected;
                }
            
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
            /*
            case "Selected":
                try {
                    return ($this->blnSelected = QType::Cast($mixValue, QType::Boolean));
                } catch (QCallerException $objExc) {
                    $objExc->IncrementOffset();
                    throw $objExc;
                }
             */
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