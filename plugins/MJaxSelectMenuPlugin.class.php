<?php
/* 
 * This class bridges the gap between the selcet menu plugin and the MJax Framework
 * 
 * http://www.filamentgroup.com/lab/jquery_ui_selectmenu_an_aria_accessible_plugin_for_styling_a_html_select
 */
class MJaxSelectMenuPlugin extends MJaxPluginBase{
   
    public function  __construct($objForm) {
        parent::__construct($objForm);
        $this->objForm->AddHeaderAsset(new MJaxJSHeaderAsset(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__ . '/jquery/ui.selectmenu.js'));
        $this->objForm->AddHeaderAsset(new MJaxCssHeaderAsset(__VIRTUAL_DIRECTORY__ . __CSS_ASSETS__ . '/MJax/ui.selectmenu.css'));
        $this->objForm->AddHeaderAsset(new MJaxCssHeaderAsset('http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-darkness/jquery-ui.css'));
    }
    public function Render($blnPrint = true){
        $strRendered = sprintf("$('%s').selectmenu();", $this->strSelector);
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    
}
?>
