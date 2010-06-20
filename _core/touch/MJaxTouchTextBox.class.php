<?php
/* 
 * This is a basic ajax text box
 */
class MJaxTouchTextBox extends MJaxTouchControl{
    protected $strCrossScripting = null;
    protected $strTextMode = null;
    public function __construct($objParentControl, $strControlId = null) {
        parent::__construct($objParentControl, $strControlId);
        $this->strTextMode = MJaxTouchTextMode::SingleLine;
        $this->Attr('type', 'text');
    }
    public function Render($blnPrint = true){
        switch($this->strTextMode){
            case(MJaxTouchTextMode::MultiLine):
                $strElementName = 'textarea';
            break;
            case(MJaxTouchTextMode::Password):
                $strElementName = 'input';
                $this->Attr('type', 'password');
            break;
            case(MJaxTouchTextMode::SingleLine):
            default:
                $strElementName = 'input';
            break;
        }
        $strRendered = parent::Render();
        $strRendered .= sprintf("<%s id='%s' name='%s' value='%s' %s/>", $strElementName, $this->strControlId, $this->strControlId, $this->strText, $this->GetAttrString());
        if($blnPrint){
            _p($strRendered, false);
        }else{
            return $strRendered;
        }
    }
    public function ParsePostData() {
			// Check to see if this Control's Value was passed in via the POST data
			if (array_key_exists($this->strControlId, $_POST)) {
				// It was -- update this Control's value with the new value passed in via the POST arguments
                if($this->strText != $_POST[$this->strControlId]){
                    //$this->blnModified = true;
                }
				$this->strText = $_POST[$this->strControlId];

				switch ($this->strCrossScripting) {
					case QCrossScripting::Allow:
						// Do Nothing, allow everything
						break;
					case QCrossScripting::HtmlEntities:
						// Go ahead and perform HtmlEntities on the text
						$this->strText = QApplication::HtmlEntities($this->strText);
						break;
					default:
						// Deny the Use of CrossScripts

						// Check for cross scripting patterns
						// TODO: Change this to RegExp
						$strText = strtolower($this->strText);
						if ((strpos($strText, '<script') !== false) ||
							(strpos($strText, '<applet') !== false) ||
							(strpos($strText, '<embed') !== false) ||
							(strpos($strText, '<style') !== false) ||
							(strpos($strText, '<link') !== false) ||
							(strpos($strText, '<body') !== false) ||
							(strpos($strText, '<iframe') !== false) ||
							(strpos($strText, 'javascript:') !== false) ||
							(strpos($strText, ' onfocus=') !== false) ||
							(strpos($strText, ' onblur=') !== false) ||
							(strpos($strText, ' onkeydown=') !== false) ||
							(strpos($strText, ' onkeyup=') !== false) ||
							(strpos($strText, ' onkeypress=') !== false) ||
							(strpos($strText, ' onmousedown=') !== false) ||
							(strpos($strText, ' onmouseup=') !== false) ||
							(strpos($strText, ' onmouseover=') !== false) ||
							(strpos($strText, ' onmouseout=') !== false) ||
							(strpos($strText, ' onmousemove=') !== false) ||
							(strpos($strText, ' onclick=') !== false) ||
							(strpos($strText, '<object') !== false) ||
							(strpos($strText, 'background:url') !== false))
							throw new QCrossScriptingException($this->strControlId);
				}
			}
		}

        /////////////////////////
		// Public Properties: GET
		/////////////////////////
		public function __get($strName) {
			switch ($strName) {
				// APPEARANCE
				case "Columns": return $this->Attr('columns');
                case "Placeholder": return $this->Attr('placeholder');
				// BEHAVIOR
				case "MaxLength": return $this->Attr('maxlength');
				case "MinLength": return $this->Attr('minlength');
				case "ReadOnly": return $this->Attr('readonly');
				case "Rows": return $this->Attr('rows');
                case "CrossScripting": return $this->strCrossScripting;
				case "TextMode": return $this->strTextMode;
             

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
		/////////////////////////
		// Public Properties: SET
		/////////////////////////
		public function __set($strName, $mixValue) {
			$this->blnModified = true;

			switch ($strName) {
				// APPEARANCE
                case "Placeholder":
					try {
						$this->Attr('placeholder', QType::Cast($mixValue, QType::String));
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "Columns":
					try {
						$this->Attr('columns', QType::Cast($mixValue, QType::Integer));
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				// BEHAVIOR
				case "CrossScripting":
					try {
						$this->strCrossScripting = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "MaxLength":
					try {
						$this->Attr('minlength', QType::Cast($mixValue, QType::Integer));
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "MinLength":
					try {
						$this->Attr('minlength', QType::Cast($mixValue, QType::Integer));
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "ReadOnly":
					try {
						$this->Attr('readonly', QType::Cast($mixValue, QType::Boolean))?'readonly':'';
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "Rows":
					try {
						$this->Attr('rows', QType::Cast($mixValue, QType::Integer));
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "TextMode":
					try {
						$this->strTextMode = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				// LAYOUT
				case "Wrap":
					try {
						$this->Attr('wrap',QType::Cast($mixValue, QType::Boolean));
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				default:
					try {
						parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
					break;
			}
		}
	
    
}
?>
