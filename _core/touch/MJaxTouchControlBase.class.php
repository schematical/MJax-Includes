<?php
/* 
 *
 */
abstract class MJaxTouchControlBase extends MJaxControl{

    public function Render($blnPrint = true){
       return '';
    }
    public function RenderJSCalls(){
        $strDocumentReady = '';

        foreach($this->arrEvents as $arrSubEvents){

            foreach($arrSubEvents as $objEvent){
                if(!$objEvent->Rendered){
                    $strDocumentReady .= $objEvent->Render();
                }
            }
        }
        foreach($this->arrPlugins as $objPlugin){
            $strDocumentReady .= $objPlugin->Render(false);
        }
        $strRendered = '';
        if(strlen($strDocumentReady) > 0){
            $strDocumentReady = sprintf("$('#%s').die(); ", $this->strControlId) . $strDocumentReady;
            
            $strRendered .= sprintf("$(document).ready(function(){%s});\n", $strDocumentReady);
            
        }
        return $strRendered;
    }
    public function RemoveControl($ctlChild, $blnRemoveFromForm = false){
        if(key_exists($ctlChild->ControlId, $this->arrControls)){
            unset($this->arrChildControls[$ctlChild->ControlId]);
            if($blnRemoveFromForm){
                $this->objForm->RemoveChildControl($ctlChild);
            }
        }
    }
}
?>
