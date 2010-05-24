<?php
/* 
 * This is a simple button class for use with the mjax framework
 */
class MJaxButton extends MJaxControl{

    public function Render($blnPrint = true){
        //Render Actions first if applicable
        $strRendered = parent::Render();
        
        $strRendered .= sprintf("<input id='%s' name='%s' type='button' value='%s'></input>", $this->strControlId, $this->strControlId, $this->strText);
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }

}
?>
