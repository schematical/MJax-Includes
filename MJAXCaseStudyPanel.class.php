<?php
/* 
 * This holds infromation specific to the MJAX framework
 */
class MJAXCaseStudyPanel extends MLCCaseStudyPanelBase{
    
     public function __construct($objParentControl,$strControlId = null) {
        parent::__construct($objParentControl,$strControlId);
        $this->AddCssClass(MJaxApplication::CssClass(MLCCssClass::CASESTUDY_LAB));
    }
}
?>
