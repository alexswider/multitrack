<?php
	/**
	 * The abstract QJqCheckBoxGen class defined here is
	 * code-generated and contains options, events and methods scraped from the
	 * JQuery UI documentation Web site. It is not generated by the typical
	 * codegen process, but rather is generated periodically by the core QCubed
	 * team and checked in. However, the code to generate this file is
	 * in the assets/_core/php/_devetools/jquery_ui_gen/jq_control_gen.php file
	 * and you can regenerate the files if you need to.
	 *
	 * The comments in this file are taken from the JQuery UI site, so they do
	 * not always make sense with regard to QCubed. They are simply provided
	 * as reference. Note that this is very low-level code, and does not always
	 * update QCubed state variables. See the QJqCheckBoxBase 
	 * file, which contains code to interface between this generated file and QCubed.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the QJqCheckBox class file.
	 *
	 */

	/* Custom event classes for this control */
	
	
	/**
	 * This event is triggered when button is created.
	 */
	class QJqCheckBox_CreateEvent extends QJqUiEvent {
		const EventName = 'buttoncreate';
	}

	/* Custom "property" event classes for this control */

	/**
	 * @property boolean $Disabled Disables (true) or enables (false) the button. Can be set when initialising
	 * 		(first creating) the button.
	 * @property boolean $JqText Whether to show any text - when set to false (display no text), icons (see
	 * 		icons option) must be enabled, otherwise it'll be ignored.
	 * @property array $Icons Icons to display, with or without text (see text option). The primary icon
	 * 		is displayed by default on the left of the label text, the secondary by
	 * 		default is on the right. Value for the primary and secondary properties
	 * 		must be a classname (String), eg. "ui-icon-gear". For using only one icon:
	 * 		icons: {primary:'ui-icon-locked'}. For using two icons: icons:
	 * 		{primary:'ui-icon-gear',secondary:'ui-icon-triangle-1-s'}
	 * @property string $Label Text to show on the button. When not specified (null), the element's html
	 * 		content is used, or its value attribute when it's an input element of type
	 * 		submit or reset; or the html content of the associated label element if its
	 * 		an input of type radio or checkbox
	 */

	class QJqCheckBoxGen extends QCheckBox	{
		protected $strJavaScripts = __JQUERY_EFFECTS__;
		protected $strStyleSheets = __JQUERY_CSS__;
		/** @var boolean */
		protected $blnDisabled = null;
		/** @var boolean */
		protected $blnJqText = null;
		/** @var array */
		protected $arrIcons = null;
		/** @var string */
		protected $strLabel;
		
		protected function makeJsProperty($strProp, $strKey) {
			$objValue = $this->$strProp;
			if (null === $objValue) {
				return '';
			}

			return $strKey . ': ' . JavaScriptHelper::toJsObject($objValue) . ', ';
		}

		protected function makeJqOptions() {
			$strJqOptions = '';
			$strJqOptions .= $this->makeJsProperty('Disabled', 'disabled');
			$strJqOptions .= $this->makeJsProperty('JqText', 'text');
			$strJqOptions .= $this->makeJsProperty('Icons', 'icons');
			$strJqOptions .= $this->makeJsProperty('Label', 'label');
			if ($strJqOptions) $strJqOptions = substr($strJqOptions, 0, -2);
			return $strJqOptions;
		}

		public function getJqControlId() {
			return $this->ControlId;
		}

		public function getJqSetupFunction() {
			return 'button';
		}

		public function GetControlJavaScript() {
			return sprintf('jQuery("#%s").%s({%s})', $this->getJqControlId(), $this->getJqSetupFunction(), $this->makeJqOptions());
		}

		public function GetEndScript() {
			return  $this->GetControlJavaScript() . '; ' . parent::GetEndScript();
		}
		
		/**
		 * Call a JQuery UI Method on the object. Takes variable number of arguments.
		 * 
		 * @param string $strMethodName the method name to call
		 * @internal param $mixed [optional] $mixParam1
		 * @internal param $mixed [optional] $mixParam2
		 */
		protected function CallJqUiMethod($strMethodName /*, ... */) {
			$args = func_get_args();

			$strArgs = JavaScriptHelper::toJsObject($args);
			$strJs = sprintf('jQuery("#%s").%s(%s)',
				$this->getJqControlId(),
				$this->getJqSetupFunction(),
				substr($strArgs, 1, strlen($strArgs)-2));	// params without brackets
			QApplication::ExecuteJavaScript($strJs);
		}


		/**
		 * Remove the button functionality completely. This will return the element
		 * back to its pre-init state.
		 */
		public function Destroy() {
			$this->CallJqUiMethod("destroy");
		}
		/**
		 * Disable the button.
		 */
		public function Disable() {
			$this->CallJqUiMethod("disable");
		}
		/**
		 * Enable the button.
		 */
		public function Enable() {
			$this->CallJqUiMethod("enable");
		}
		/**
		 * Get or set any button option. If no value is specified, will act as a
		 * getter.
		 * @param $optionName
		 * @param $value
		 */
		public function Option($optionName, $value = null) {
			$this->CallJqUiMethod("option", $optionName, $value);
		}
		/**
		 * Set multiple button options at once by providing an options object.
		 * @param $options
		 */
		public function Option1($options) {
			$this->CallJqUiMethod("option", $options);
		}
		/**
		 * Refreshes the visual state of the button. Useful for updating button state
		 * after the native element's checked or disabled state is changed
		 * programatically.
		 */
		public function Refresh() {
			$this->CallJqUiMethod("refresh");
		}


		public function __get($strName) {
			switch ($strName) {
				case 'Disabled': return $this->blnDisabled;
				case 'JqText': return $this->blnJqText;
				case 'Icons': return $this->arrIcons;
				case 'Label': return $this->strLabel;
				default: 
					try { 
						return parent::__get($strName); 
					} catch (QCallerException $objExc) { 
						$objExc->IncrementOffset(); 
						throw $objExc; 
					}
			}
		}

		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'Disabled':
					try {
						$this->blnDisabled = QType::Cast($mixValue, QType::Boolean);
						if ($this->Rendered) {
							$this->CallJqUiMethod('option', 'disabled', $this->blnDisabled);
						}
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'JqText':
					try {
						$this->blnJqText = QType::Cast($mixValue, QType::Boolean);
						if ($this->Rendered) {
							$this->CallJqUiMethod('option', 'text', $this->blnJqText);
						}
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Icons':
					try {
						$this->arrIcons = QType::Cast($mixValue, QType::ArrayType);
						if ($this->Rendered) {
							$this->CallJqUiMethod('option', 'icons', $this->arrIcons);
						}
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Label':
					try {
						$this->strLabel = QType::Cast($mixValue, QType::String);
						if ($this->Rendered) {
							$this->CallJqUiMethod('option', 'label', $this->strLabel);
						}
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				case 'Enabled':
					$this->Disabled = !$mixValue;	// Tie in standard QCubed functionality
					parent::__set($strName, $mixValue);
					break;
					
				default:
					try {
						parent::__set($strName, $mixValue);
						break;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}

?>
