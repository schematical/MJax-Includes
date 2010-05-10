<?php
class MJaxCssHeaderAsset extends MJaxHeaderAsset{
    public function  __construct($strSrc) {
        $this->strSrc = $strSrc;
    }
    public function  __toString() {
        return sprintf('<link rel="stylesheet" type="text/css" href="%s"/>', $this->strSrc);
    }
}

?>
