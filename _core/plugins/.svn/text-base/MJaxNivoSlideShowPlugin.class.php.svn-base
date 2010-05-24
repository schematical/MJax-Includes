<?php
/*
 *This class will apply the nivo slider jquery plugin to a control(Only tested witht he nivo slide show class)
 */
class MJaxNivoSlideShowPlugin extends MJaxPluginBase{
    protected $arrProperties = array();
    protected $intDuration = null;
    public function  __construct($objForm, $arrProperties = array()) {
        parent::__construct($objForm);
        $this->objForm->AddHeaderAsset(new MJaxJSHeaderAsset(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__ . '/jquery.nivo.slider.pack.js'));
        $this->objForm->AddHeaderAsset(new MJaxCssHeaderAsset(__VIRTUAL_DIRECTORY__ . __CSS_ASSETS__ . '/nivo-slider.css'));
        $this->arrProperties = $arrProperties;
    }
    public function Render($blnPrint = true){
        if(!$this->blnModified){
            return;
        }
        $strProperties = MJaxApplication::ConvertArrayToJason($this->arrProperties);
        $strRendered = sprintf("$('%s').nivoSlider(%s);", $this->strSelector, $strProperties);
        $this->blnModified = false;
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
 /*
        effect:'random',
		slices:15,
		animSpeed:500,
		pauseTime:3000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:true, //Next & Prev
		directionNavHide:true, //Only show on hover
		controlNav:true, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		controlNavThumbsSearch: '.jpg', //Replace this with...
		controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
		keyboardNav:true, //Use left & right arrows
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides
        */
}
?>
