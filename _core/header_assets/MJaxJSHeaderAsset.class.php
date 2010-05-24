<?php
class MJaxJSHeaderAsset extends MJaxHeaderAsset{
    
    public function  __construct($strSrc) {
        $this->strSrc = $strSrc;
    }
    public function  __toString() {
        return sprintf('<script src="%s"></script>', $this->strSrc);
    }
}

?>