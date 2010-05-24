<?php
/* 
 * This will be used to act as a proxy for certain controls that will be prerendered
 */
class MJaxControlProxy extends MJaxControl{
    
    public function __construct($objParentControl,$strControlId = null) {
        parent::__construct($objParentControl,$strControlId);
        $this->blnModified = false;
    }
    public function Render(){
        throw new QCallerException("A MJaxControlProxy instance cannot be rendered");
    }
}
?>
