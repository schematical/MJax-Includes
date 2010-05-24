<?php
/* 
 * This is a basic ajax text box
 */
class MJaxTextBox extends MJaxControl{
    protected $strCrossScripting = null;
    public function Render($blnPrint = true){
        $strRendered = parent::Render();
        $strRendered .= sprintf("<input id='%s' name='%s' class='ui-widget' type='text' value='%s' />", $this->strControlId, $this->strControlId, $this->strText);
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
                /*
				// APPEARANCE
				case "Columns": return $this->intColumns;
				case "Text": return $this->strText;
				case "LabelForRequired": return $this->strLabelForRequired;
				case "LabelForRequiredUnnamed": return $this->strLabelForRequiredUnnamed;
				case "LabelForTooShort": return $this->strLabelForTooShort;
				case "LabelForTooShortUnnamed": return $this->strLabelForTooShortUnnamed;
				case "LabelForTooLong": return $this->strLabelForTooLong;
				case "LabelForTooLongUnnamed": return $this->strLabelForTooLongUnnamed;

				// BEHAVIOR
				case "MaxLength": return $this->intMaxLength;
				case "MinLength": return $this->intMinLength;
				case "ReadOnly": return $this->blnReadOnly;
				case "Rows": return $this->intRows;
                 */
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

    
}
?>
