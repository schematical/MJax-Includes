<?php
/* 
 * 
 */
class MJaxTouchList extends MJaxTouchControl{

    public function AddChildControl($objControl) {
        if(!($objControl instanceof MJaxTouchListItem)){
            throw new QCallerException("Child controls of MJaxList must be MJaxListItems");
        }
        parent::AddChildControl($objControl);
    }

    public function Render($blnPrint = true){
        $strRendered = parent::Render();
        $strRendered .= sprintf("<ul id='%s' name='%s' %s>\n", $this->strControlId, $this->strControlId, $this->GetAttrString());
         foreach($this->arrChildControls as $objListItem){
            //render list items
            $strRendered .= $objListItem->Render(false);
         }
        $strRendered .= "</ul>\n";
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    public function AddListItem($mixChild, $strId = null){
        if(is_null($strId)){
            $strId = $this->strControlId . "_li" . count($this->arrChildControls);
        }
        if(class_exists($mixChild, true) && (MJaxApplication::HasParent($mixChild, 'MJaxTouchControl'))){
            $ctlListItem = new MJaxTouchListItem($this, $strId . "_li");
            $ctlListItem->AutoRenderChildren = true;
            $cltToReturn = new $mixChild($ctlListItem, $strId);
            return $cltToReturn;
        }elseif(is_string($mixChild)){
            $ctlListItem = new MJaxTouchListItem($this, $strId);
            $ctlListItem->Text = $mixChild;
            return $ctlListItem;
        }else{
            throw new QCallerException("First parameter must be either a string or the name of a class that extends 'MJaxTouchControl' ");
        }
    }

}
?>
