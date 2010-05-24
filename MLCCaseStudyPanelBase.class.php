<?php
/* 
 * This holds infromation specific to COTR
 */
class MLCCaseStudyPanelBase extends MJaxPanel{
    public $blnCreateNavButtonsCalled = false;

    public $btnNext = null;
    public $btnPrev = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __DOCROOT__ . __VIRTUAL_DIRECTORY__ . __TPL_ASSETS__ . '/mjax_panels/' . get_class($this) . '.tpl.php';
    }
    public function CreateNavButtons(){
        if(!$this->blnCreateNavButtonsCalled){
            
            $cssClass = MJaxApplication::CssClass('cmdLineButton');

            $this->AddCssClass(MJaxApplication::CssClass('caseStudyPanel'));
            $this->btnNext = new MJaxLinkButton($this, $this->strControlId . '_btnNext');
            $objPlugin = new MJaxScrollToPlugin($this->objForm, '#' . $this->objForm->GetCaseStudyIndex($this->strControlId, + 1), array(), 1200);
            $objPlugin->SetTargetControl($this->objForm->MainWindow);
            $this->btnNext->AddAction(new MJaxClickEvent(), new MJaxPluginAction($objPlugin));
            $this->btnNext->Text = "next/";
            $this->btnNext->ActionParameter = $this->strControlId;
            $this->btnNext->AddCssClass($cssClass);

            $this->btnPrev = new MJaxLinkButton($this, $this->strControlId . '_btnPrev');
            $objPlugin = new MJaxScrollToPlugin($this->objForm, '#' .$this->objForm->GetCaseStudyIndex($this->strControlId, - 1), array(), 1200);
            $objPlugin->SetTargetControl($this->objForm->MainWindow);
            $this->btnPrev->AddAction(new MJaxClickEvent(), new MJaxPluginAction($objPlugin));
            $this->btnPrev->Text = "previous/";
            $this->btnPrev->ActionParameter = $this->strControlId;
            $this->btnPrev->AddCssClass($cssClass);
            
            $this->blnCreateNavButtonsCalled = true;
        }else{
            Throw new QCallerException("Function CreateNavButtons has already been called");
        }
    }
}
?>
