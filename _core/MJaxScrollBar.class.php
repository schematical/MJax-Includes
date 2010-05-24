<?php
/* 
 * This is a basic dif for use with the MJax Framework
 */
class MJaxScrollBar extends MJaxPanel{
    protected $pnlSlider = null;
    protected $intIncriment = null;
    public function __construct($objParentControl, $strControlId = null, $intIncriment = 400) {
        parent::__construct($objParentControl, $strControlId);
        $this->intIncriment = $intIncriment;
        $cssClass = MJaxApplication::CssClass(MJaxCssClass::SCROLLBAR_HOLDER);
        $this->AddCssClass($cssClass);

        
        $cssClass = MJaxApplication::CssClass(MJaxCssClass::SCROLLBAR_SLIDER);
        $this->pnlSlider = new MJaxPanel($this, 'pnlSlider' . $this->strControlId);
        $this->pnlSlider->AddCssClass($cssClass);
    }
}
?>