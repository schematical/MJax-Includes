<?php
/*
 * This holds infromation specific to Gymifinty site
 */
class GymfinityCaseStudyPanel extends MLCCaseStudyPanelBase{

    public function __construct($objParentControl,$strControlId = null) {
        parent::__construct($objParentControl,$strControlId);
        $this->AddCssClass(MJaxApplication::CssClass(MLCCssClass::CASESTUDY_SITE));
    }
}
?>