<?php
/* 
 * This class holds the information for my portfolio site
 */
class MLCSiteForm extends MJaxForm{
    protected $pnlHomeIcon = null;
    protected $pnlContactIcon = null;
    protected $pnlStartUpIcon = null;
    protected $pnlDesignersIcon = null;
    protected $pnlTwitterIcon = null;
    protected $pnlLabIcon = null;

    public function Form_Create() {
        $cssClass = MJaxApplication::CssClass('icon');
        $cssClass->AddAction(new MJaxClickEvent(), new MJaxJavascriptAction('MLCSite.IconClick'));
        
        $this->pnlHomeIcon = new MJaxPanel($this, 'homeIcon');
        $this->pnlHomeIcon->AddCssClass($cssClass);
        $this->pnlHomeIcon->Attr('page', 'index');
        $this->pnlHomeIcon->Modified = false;

        $this->pnlContactIcon = new MJaxPanel($this, 'contactIcon');
        $this->pnlContactIcon->AddCssClass($cssClass);
        $this->pnlContactIcon->Attr('page', 'contact');
        $this->pnlContactIcon->Modified = false;
        
        $this->pnlStartUpIcon = new MJaxPanel($this, 'startUpIcon');
        $this->pnlStartUpIcon->AddCssClass($cssClass);
        $this->pnlStartUpIcon->Attr('page', 'startUps');
        $this->pnlStartUpIcon->Modified = false;

        $this->pnlDesignersIcon = new MJaxPanel($this, 'designersIcon');
        $this->pnlDesignersIcon->AddCssClass($cssClass);
        $this->pnlDesignersIcon->Attr('page', 'designers');
        $this->pnlDesignersIcon->Modified = false;

        $this->pnlTwitterIcon = new MJaxPanel($this, 'twitterIcon');
        $this->pnlTwitterIcon->AddCssClass($cssClass);
        $this->pnlTwitterIcon->Attr('page', 'twitter');
        $this->pnlTwitterIcon->Modified = false;

        $this->pnlLabIcon = new MJaxPanel($this, 'labIcon');
        $this->pnlLabIcon->AddCssClass($cssClass);
        $this->pnlLabIcon->Attr('page', 'lab');
        $this->pnlLabIcon->Modified = false;
    }
}
?>
