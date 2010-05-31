<?php
/* 
 * 
 */
class MJaxList extends MJaxTouchControl{

    public function AddChildControl($objControl) {
        if(!($objControl instanceof MJaxTouchListItem)){
            throw new QCallerException("Child controls of MJaxList must be MJaxListItems");
        }
        parent::AddChildControl($objControl);
    }

    public function Render($blnPrint = true){
        $strRendered = parent::Render();
        $strRendered .= sprintf("<ul id='%s' name='%s' %s>\n", $this->strControlId, $this->strControlId, $this->GetAttrString());
         foreach($this->arrListItems as $objListItem){
            //render list items
            $strRendered .= $objListItem->__toString();
         }
        $strRendered .= "</ul>\n";
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }

}
?>
