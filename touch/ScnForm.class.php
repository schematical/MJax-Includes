<?php
/*
 * A simple list screen
 */
class ScnForm extends MJaxTouchScreen{
    const ADD = 'add';
    const SUB = 'sub';
    const MULTI = 'multi';
    const DIVID = 'divid';

    public $pnlError = null;
    public $txtNum1 = null;
    public $txtNum2 = null;
    public $selOperator = null;
    public $txtResult = null;
    public $btnCalc = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __DOCROOT__ . __VIRTUAL_DIRECTORY__ . __TPL_ASSETS__ . '/' . get_class($this) . '.tpl.php';
        
    }
    public function Create_Controls() {
        $this->pnlError = new MJaxTouchPanel($this, 'pnlError');

        $this->txtNum1 = new MJaxTouchTextBox($this, 'txtNum1');
        $this->txtNum1->Placeholder = 'Number 1';
        
        $this->txtNum2 = new MJaxTouchTextBox($this, 'txtNum2');
        $this->txtNum2->Placeholder = 'Number 2';

        $this->selOperator = new MJaxTouchSelectBox($this, 'selOperator');
        $this->selOperator->AddItem("Add", self::ADD, true);
        $this->selOperator->AddItem("Subtract", self::SUB);
        $this->selOperator->AddItem("Divide", self::DIVID);
        $this->selOperator->AddItem("Multiply", self::MULTI);

        $this->txtResult = new MJaxTouchTextBox($this, 'txtResult');
        $this->txtResult->Placeholder = 'Results';
        $this->txtResult->ReadOnly = true;

        $this->btnCalc = new MJaxTouchLinkButton($this, 'btnCalc');
        $this->btnCalc->Text = 'Calculate';
        $this->btnCalc->AddAction(new MJaxTouchClickEvent(), new MJaxTouchServerControlAction($this, 'btnCalc_click'));
        parent::Create_Controls();

    }
    public function btnCalc_click($strFormId, $strControlId, $strActionParameter){
        if((!is_numeric($this->txtNum1->Text))||(!is_numeric($this->txtNum1->Text))){
            $this->pnlError->Text = "Both inputs must be numeric!!!";
            return false;
        }else{
            $this->pnlError->Text = "";
            $fltNum1 = $this->txtNum1->Text;
            $fltNum2 = $this->txtNum2->Text;
        }

        switch($this->selOperator->SelectedItem->Value){
            case(self::ADD):
                $this->txtResult->Text = $fltNum1 + $fltNum2;
            break;
            case(self::SUB):
                $this->txtResult->Text = $fltNum1 - $fltNum2;
            break;
            case(self::MULTI):
                $this->txtResult->Text = $fltNum1 * $fltNum2;
            break;
            case(self::DIVID):
                $this->txtResult->Text = $fltNum1 / $fltNum2;
            break;
        }
    }
}
?>
