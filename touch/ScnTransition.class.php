<?php
/* 
 * A simple home screen
 */
class ScnTransition extends MJaxTouchScreen{
    public $lstTransitions = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __DOCROOT__ . __VIRTUAL_DIRECTORY__ . __TPL_ASSETS__ . '/' . get_class($this) . '.tpl.php';
        
    }
    public function Create_Controls() {
        $this->lstTransitions = new MJaxTouchList($this, 'lstTransitions');

        $btnLink = $this->lstTransitions->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->ActionParameter = MJaxTouchTransition::SLIDE;
        $btnLink->Text = 'Slide';

        $btnLink = $this->lstTransitions->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->ActionParameter = MJaxTouchTransition::SLIDEUP;
        $btnLink->Text = 'Slide Up';

        $btnLink = $this->lstTransitions->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->ActionParameter = MJaxTouchTransition::CUBE;
        $btnLink->Text = 'Cube';

        $btnLink = $this->lstTransitions->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->ActionParameter = MJaxTouchTransition::DISSOLVE;
        $btnLink->Text = 'Dissolve';

        $btnLink = $this->lstTransitions->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->ActionParameter = MJaxTouchTransition::FADE;
        $btnLink->Text = 'Fade';

        $btnLink = $this->lstTransitions->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->ActionParameter = MJaxTouchTransition::FLIP;
        $btnLink->Text = 'Flip';

        $btnLink = $this->lstTransitions->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->ActionParameter = MJaxTouchTransition::POP;
        $btnLink->Text = 'Pop';

        $btnLink = $this->lstTransitions->AddListItem('MJaxTouchLinkButton');
        $btnLink->AddAction(new MJaxClickEvent(), new MJaxTouchServerControlAction($this, 'btnLink_click'));
        $btnLink->ActionParameter = MJaxTouchTransition::SWAP;
        $btnLink->Text = 'Swap';
        
        parent::Create_Controls();
    }
    public function btnLink_click($strFormId, $strControlId, $strActionParam){
        $this->objForm->scnTransitionFinish->Transition = $strActionParam;
        $this->objForm->SetActiveScreen($this->objForm->scnTransitionFinish);
    }
}
?>
