<?php
/* 
 * This box will pop up on top of everything else with absolute positioning
 */
class MJaxDialogBox extends MJaxPanel{

    public function  __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->objStyle->Position = 'fixed';
        $this->objStyle->Top = '100Px';
        $this->objStyle->Left = '0Px';
        $this->objStyle->Width = '100%';
        $this->objStyle->Overflow = 'hidden';
        
        //$this->objStyle->Height = '100%';
        
    }
    public function Render($blnPrint = true){
        $strText = "<div style='position:relitive'><div style='width:400Px; margin-left:auto; margin-right:auto;'>";
        $strText .= $this->strText;
        if($this->blnAutoRenderChildren){
            foreach($this->arrChildControls as $objChildControl){
                $strText .= $objChildControl->Render(false);
            }
            $this->blnAutoRenderChildren = false;
        }
        $strText .= "</div></div>";

        $this->strText = $strText;
        $strRendered = parent::Render($blnPrint);
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }

    }
    public function ShowDialogBox(){
        $objStyle = new MJaxControlStyle();
        $objStyle->height = $this->objStyle->height;
        $this->objStyle->height = '1Px';
        $this->Animate($objStyle,2000);
        $this->objStyle->SetProperty('z-index', '10000');
    }
    public function HideDialogBox(){
        $objStyle = new MJaxControlStyle();
        $objStyle->height = '0Px';
        $this->Animate($objStyle,2000);

        $this->objStyle->SetProperty('z-index', '-1');
    }
    
}
?>
