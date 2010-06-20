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
    
    protected $pnlMLCToolBar = null;

    public function Form_Create() {
        //Respons Header fun
        header("X-FunStuff:Wow you must really be dedicatied to check out my headers-I wonder what is happening on port 5033?");
        header("X-Ninjas:Dude ninjas rule... don't lie!");
        header("X-OtherStuff:You know zappos.com hides stuff in their headers too!");

        //SEO and weird mistic crap
        $this->strTitle = "Matt Lea Consulting - PHP Framework lover and jQuery Ninja";
        $this->AddHeaderAsset(new MJaxMetaHeaderAsset(MJaxMetaHeaderAsset::description, 'Matt Lea Consulting - PHP Framework lover and jQuery Ninja: I love the art involved in creating a good framework, and the science'));
        $this->AddHeaderAsset(new MJaxMetaHeaderAsset(MJaxMetaHeaderAsset::keywords, 'Matt Lea, PHP, QCodo, jQuery, MJax, MJaxTouch, jQTouch'));


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
        $this->pnlTwitterIcon->Attr('href', 'http://www.twitter.com/3villabs');
        $this->pnlTwitterIcon->Modified = false;

        $this->pnlLabIcon = new MJaxPanel($this, 'labIcon');
        $this->pnlLabIcon->AddCssClass($cssClass);
        $this->pnlLabIcon->Attr('page', 'lab');
        $this->pnlLabIcon->Modified = false;

        $this->pnlMLCToolBar = new MJaxPanel($this, 'MLCToolBar');
        $this->pnlMLCToolBar->Text = "Copyright Matt Lea 2010";
        $this->pnlMLCToolBar->Modified = false;
    }
    public function SetToolBarText($strText){
        $this->pnlMLCToolBar->Text = $strText;
    }
}
?>
