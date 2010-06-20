<?php
class MJaxMetaHeaderAsset extends MJaxHeaderAsset{
    const description = 'description';
    const keywords = 'keywords';
    const generator = 'generator';
    protected $strContent = null;
    public function  __construct($strName, $strContent) {
        $this->strSrc = $strName;
        $this->strContent = $strContent;
    }
    public function  __toString() {
        return sprintf('<meta name="%s" content="%s"></script>', $this->strSrc, $this->strContent);
    }
}

?>
