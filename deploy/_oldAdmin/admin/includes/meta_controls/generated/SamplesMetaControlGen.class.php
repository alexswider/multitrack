<?php
	/**
	 * This is a MetaControl class, providing a QForm or QPanel access to event handlers
	 * and QControls to perform the Create, Edit, and Delete functionality
	 * of the Samples class.  This code-generated class
	 * contains all the basic elements to help a QPanel or QForm display an HTML form that can
	 * manipulate a single Samples object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QForm or QPanel which instantiates a SamplesMetaControl
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent
	 * code re-generation.
	 *
	 * @package My QCubed Application
	 * @subpackage MetaControls
	 * @property-read Samples $Samples the actual Samples data class being edited
	 * @property QLabel $IdControl
	 * @property-read QLabel $IdLabel
	 * @property QTextBox $GuidControl
	 * @property-read QLabel $GuidLabel
	 * @property QTextBox $UserNameControl
	 * @property-read QLabel $UserNameLabel
	 * @property QLabel $SubmitDateControl
	 * @property-read QLabel $SubmitDateLabel
	 * @property QTextBox $EmailControl
	 * @property-read QLabel $EmailLabel
	 * @property QTextBox $SpeakTextControl
	 * @property-read QLabel $SpeakTextLabel
	 * @property QTextBox $TranslationControl
	 * @property-read QLabel $TranslationLabel
	 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
	 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
	 */

	class SamplesMetaControlGen extends QBaseClass {
		// General Variables
		/**
		 * @var Samples objSamples
		 * @access protected
		 */
		protected $objSamples;
		/**
		 * @var QForm|QControl objParentObject
		 * @access protected
		 */
		protected $objParentObject;
		/**
		 * @var string strTitleVerb
		 * @access protected
		 */
		protected $strTitleVerb;
		/**
		 * @var boolean blnEditMode
		 * @access protected
		 */
		protected $blnEditMode;

		// Controls that allow the editing of Samples's individual data fields
		/**
		 * @var QLabel lblId
		 * @access protected
		 */
		protected $lblId;
		/**
		 * @var QTextBox txtGuid
		 * @access protected
		 */
		protected $txtGuid;
		/**
		 * @var QTextBox txtUserName
		 * @access protected
		 */
		protected $txtUserName;
		/**
		 * @var QLabel lblSubmitDate
		 * @access protected
		 */
		protected $lblSubmitDate;
		/**
		 * @var QTextBox txtEmail
		 * @access protected
		 */
		protected $txtEmail;
		/**
		 * @var QTextBox txtSpeakText
		 * @access protected
		 */
		protected $txtSpeakText;
		/**
		 * @var QTextBox txtTranslation
		 * @access protected
		 */
		protected $txtTranslation;

		// Controls that allow the viewing of Samples's individual data fields
		/**
		 * @var QLabel lblGuid
		 * @access protected
		 */
		protected $lblGuid;
		/**
		 * @var QLabel lblUserName
		 * @access protected
		 */
		protected $lblUserName;
		/**
		 * @var QLabel lblEmail
		 * @access protected
		 */
		protected $lblEmail;
		/**
		 * @var QLabel lblSpeakText
		 * @access protected
		 */
		protected $lblSpeakText;
		/**
		 * @var QLabel lblTranslation
		 * @access protected
		 */
		protected $lblTranslation;

		// QListBox Controls (if applicable) to edit Unique ReverseReferences and ManyToMany References

		// QLabel Controls (if applicable) to view Unique ReverseReferences and ManyToMany References


		/**
		 * Main constructor.  Constructor OR static create methods are designed to be called in either
		 * a parent QPanel or the main QForm when wanting to create a
		 * SamplesMetaControl to edit a single Samples object within the
		 * QPanel or QForm.
		 *
		 * This constructor takes in a single Samples object, while any of the static
		 * create methods below can be used to construct based off of individual PK ID(s).
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this SamplesMetaControl
		 * @param Samples $objSamples new or existing Samples object
		 */
		 public function __construct($objParentObject, Samples $objSamples) {
			// Setup Parent Object (e.g. QForm or QPanel which will be using this SamplesMetaControl)
			$this->objParentObject = $objParentObject;

			// Setup linked Samples object
			$this->objSamples = $objSamples;

			// Figure out if we're Editing or Creating New
			if ($this->objSamples->__Restored) {
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		 }

		/**
		 * Static Helper Method to Create using PK arguments
		 * You must pass in the PK arguments on an object to load, or leave it blank to create a new one.
		 * If you want to load via QueryString or PathInfo, use the CreateFromQueryString or CreateFromPathInfo
		 * static helper methods.  Finally, specify a CreateType to define whether or not we are only allowed to
		 * edit, or if we are also allowed to create a new one, etc.
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this SamplesMetaControl
		 * @param integer $intId primary key value
		 * @param QMetaControlCreateType $intCreateType rules governing Samples object creation - defaults to CreateOrEdit
 		 * @return SamplesMetaControl
		 */
		public static function Create($objParentObject, $intId = null, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			// Attempt to Load from PK Arguments
			if (strlen($intId)) {
				$objSamples = Samples::Load($intId);

				// Samples was found -- return it!
				if ($objSamples)
					return new SamplesMetaControl($objParentObject, $objSamples);

				// If CreateOnRecordNotFound not specified, throw an exception
				else if ($intCreateType != QMetaControlCreateType::CreateOnRecordNotFound)
					throw new QCallerException('Could not find a Samples object with PK arguments: ' . $intId);

			// If EditOnly is specified, throw an exception
			} else if ($intCreateType == QMetaControlCreateType::EditOnly)
				throw new QCallerException('No PK arguments specified');

			// If we are here, then we need to create a new record
			return new SamplesMetaControl($objParentObject, new Samples());
		}

		/**
		 * Static Helper Method to Create using PathInfo arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this SamplesMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing Samples object creation - defaults to CreateOrEdit
		 * @return SamplesMetaControl
		 */
		public static function CreateFromPathInfo($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::PathInfo(0);
			return SamplesMetaControl::Create($objParentObject, $intId, $intCreateType);
		}

		/**
		 * Static Helper Method to Create using QueryString arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this SamplesMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing Samples object creation - defaults to CreateOrEdit
		 * @return SamplesMetaControl
		 */
		public static function CreateFromQueryString($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::QueryString('intId');
			return SamplesMetaControl::Create($objParentObject, $intId, $intCreateType);
		}



		///////////////////////////////////////////////
		// PUBLIC CREATE and REFRESH METHODS
		///////////////////////////////////////////////

		/**
		 * Create and setup QLabel lblId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblId_Create($strControlId = null) {
			$this->lblId = new QLabel($this->objParentObject, $strControlId);
			$this->lblId->Name = QApplication::Translate('Id');
			if ($this->blnEditMode)
				$this->lblId->Text = $this->objSamples->Id;
			else
				$this->lblId->Text = 'N/A';
			return $this->lblId;
		}

		/**
		 * Create and setup QTextBox txtGuid
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtGuid_Create($strControlId = null) {
			$this->txtGuid = new QTextBox($this->objParentObject, $strControlId);
			$this->txtGuid->Name = QApplication::Translate('Guid');
			$this->txtGuid->Text = $this->objSamples->Guid;
			$this->txtGuid->Required = true;
			$this->txtGuid->MaxLength = Samples::GuidMaxLength;
			return $this->txtGuid;
		}

		/**
		 * Create and setup QLabel lblGuid
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblGuid_Create($strControlId = null) {
			$this->lblGuid = new QLabel($this->objParentObject, $strControlId);
			$this->lblGuid->Name = QApplication::Translate('Guid');
			$this->lblGuid->Text = $this->objSamples->Guid;
			$this->lblGuid->Required = true;
			return $this->lblGuid;
		}

		/**
		 * Create and setup QTextBox txtUserName
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtUserName_Create($strControlId = null) {
			$this->txtUserName = new QTextBox($this->objParentObject, $strControlId);
			$this->txtUserName->Name = QApplication::Translate('User Name');
			$this->txtUserName->Text = $this->objSamples->UserName;
			$this->txtUserName->Required = true;
			$this->txtUserName->MaxLength = Samples::UserNameMaxLength;
			return $this->txtUserName;
		}

		/**
		 * Create and setup QLabel lblUserName
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblUserName_Create($strControlId = null) {
			$this->lblUserName = new QLabel($this->objParentObject, $strControlId);
			$this->lblUserName->Name = QApplication::Translate('User Name');
			$this->lblUserName->Text = $this->objSamples->UserName;
			$this->lblUserName->Required = true;
			return $this->lblUserName;
		}

		/**
		 * Create and setup QLabel lblSubmitDate
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblSubmitDate_Create($strControlId = null) {
			$this->lblSubmitDate = new QLabel($this->objParentObject, $strControlId);
			$this->lblSubmitDate->Name = QApplication::Translate('Submit Date');
			if ($this->blnEditMode)
				$this->lblSubmitDate->Text = $this->objSamples->SubmitDate;
			else
				$this->lblSubmitDate->Text = 'N/A';
			return $this->lblSubmitDate;
		}

		/**
		 * Create and setup QTextBox txtEmail
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtEmail_Create($strControlId = null) {
			$this->txtEmail = new QTextBox($this->objParentObject, $strControlId);
			$this->txtEmail->Name = QApplication::Translate('Email');
			$this->txtEmail->Text = $this->objSamples->Email;
			$this->txtEmail->Required = true;
			$this->txtEmail->MaxLength = Samples::EmailMaxLength;
			return $this->txtEmail;
		}

		/**
		 * Create and setup QLabel lblEmail
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblEmail_Create($strControlId = null) {
			$this->lblEmail = new QLabel($this->objParentObject, $strControlId);
			$this->lblEmail->Name = QApplication::Translate('Email');
			$this->lblEmail->Text = $this->objSamples->Email;
			$this->lblEmail->Required = true;
			return $this->lblEmail;
		}

		/**
		 * Create and setup QTextBox txtSpeakText
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtSpeakText_Create($strControlId = null) {
			$this->txtSpeakText = new QTextBox($this->objParentObject, $strControlId);
			$this->txtSpeakText->Name = QApplication::Translate('Speak Text');
			$this->txtSpeakText->Text = $this->objSamples->SpeakText;
			$this->txtSpeakText->Required = true;
			$this->txtSpeakText->MaxLength = Samples::SpeakTextMaxLength;
			return $this->txtSpeakText;
		}

		/**
		 * Create and setup QLabel lblSpeakText
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblSpeakText_Create($strControlId = null) {
			$this->lblSpeakText = new QLabel($this->objParentObject, $strControlId);
			$this->lblSpeakText->Name = QApplication::Translate('Speak Text');
			$this->lblSpeakText->Text = $this->objSamples->SpeakText;
			$this->lblSpeakText->Required = true;
			return $this->lblSpeakText;
		}

		/**
		 * Create and setup QTextBox txtTranslation
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtTranslation_Create($strControlId = null) {
			$this->txtTranslation = new QTextBox($this->objParentObject, $strControlId);
			$this->txtTranslation->Name = QApplication::Translate('Translation');
			$this->txtTranslation->Text = $this->objSamples->Translation;
			$this->txtTranslation->Required = true;
			$this->txtTranslation->MaxLength = Samples::TranslationMaxLength;
			return $this->txtTranslation;
		}

		/**
		 * Create and setup QLabel lblTranslation
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblTranslation_Create($strControlId = null) {
			$this->lblTranslation = new QLabel($this->objParentObject, $strControlId);
			$this->lblTranslation->Name = QApplication::Translate('Translation');
			$this->lblTranslation->Text = $this->objSamples->Translation;
			$this->lblTranslation->Required = true;
			return $this->lblTranslation;
		}



		/**
		 * Refresh this MetaControl with Data from the local Samples object.
		 * @param boolean $blnReload reload Samples from the database
		 * @return void
		 */
		public function Refresh($blnReload = false) {
			if ($blnReload)
				$this->objSamples->Reload();

			if ($this->lblId) if ($this->blnEditMode) $this->lblId->Text = $this->objSamples->Id;

			if ($this->txtGuid) $this->txtGuid->Text = $this->objSamples->Guid;
			if ($this->lblGuid) $this->lblGuid->Text = $this->objSamples->Guid;

			if ($this->txtUserName) $this->txtUserName->Text = $this->objSamples->UserName;
			if ($this->lblUserName) $this->lblUserName->Text = $this->objSamples->UserName;

			if ($this->lblSubmitDate) if ($this->blnEditMode) $this->lblSubmitDate->Text = $this->objSamples->SubmitDate;

			if ($this->txtEmail) $this->txtEmail->Text = $this->objSamples->Email;
			if ($this->lblEmail) $this->lblEmail->Text = $this->objSamples->Email;

			if ($this->txtSpeakText) $this->txtSpeakText->Text = $this->objSamples->SpeakText;
			if ($this->lblSpeakText) $this->lblSpeakText->Text = $this->objSamples->SpeakText;

			if ($this->txtTranslation) $this->txtTranslation->Text = $this->objSamples->Translation;
			if ($this->lblTranslation) $this->lblTranslation->Text = $this->objSamples->Translation;

		}



		///////////////////////////////////////////////
		// PROTECTED UPDATE METHODS for ManyToManyReferences (if any)
		///////////////////////////////////////////////





		///////////////////////////////////////////////
		// PUBLIC SAMPLES OBJECT MANIPULATORS
		///////////////////////////////////////////////

		/**
		 * This will save this object's Samples instance,
		 * updating only the fields which have had a control created for it.
		 */
		public function SaveSamples() {
			try {
				// Update any fields for controls that have been created
				if ($this->txtGuid) $this->objSamples->Guid = $this->txtGuid->Text;
				if ($this->txtUserName) $this->objSamples->UserName = $this->txtUserName->Text;
				if ($this->txtEmail) $this->objSamples->Email = $this->txtEmail->Text;
				if ($this->txtSpeakText) $this->objSamples->SpeakText = $this->txtSpeakText->Text;
				if ($this->txtTranslation) $this->objSamples->Translation = $this->txtTranslation->Text;

				// Update any UniqueReverseReferences (if any) for controls that have been created for it

				// Save the Samples object
				$this->objSamples->Save();

				// Finally, update any ManyToManyReferences (if any)
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * This will DELETE this object's Samples instance from the database.
		 * It will also unassociate itself from any ManyToManyReferences.
		 */
		public function DeleteSamples() {
			$this->objSamples->Delete();
		}



		///////////////////////////////////////////////
		// PUBLIC GETTERS and SETTERS
		///////////////////////////////////////////////

		/**
		 * Override method to perform a property "Get"
		 * This will get the value of $strName
		 *
		 * @param string $strName Name of the property to get
		 * @return mixed
		 */
		public function __get($strName) {
			switch ($strName) {
				// General MetaControlVariables
				case 'Samples': return $this->objSamples;
				case 'TitleVerb': return $this->strTitleVerb;
				case 'EditMode': return $this->blnEditMode;

				// Controls that point to Samples fields -- will be created dynamically if not yet created
				case 'IdControl':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'IdLabel':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'GuidControl':
					if (!$this->txtGuid) return $this->txtGuid_Create();
					return $this->txtGuid;
				case 'GuidLabel':
					if (!$this->lblGuid) return $this->lblGuid_Create();
					return $this->lblGuid;
				case 'UserNameControl':
					if (!$this->txtUserName) return $this->txtUserName_Create();
					return $this->txtUserName;
				case 'UserNameLabel':
					if (!$this->lblUserName) return $this->lblUserName_Create();
					return $this->lblUserName;
				case 'SubmitDateControl':
					if (!$this->lblSubmitDate) return $this->lblSubmitDate_Create();
					return $this->lblSubmitDate;
				case 'SubmitDateLabel':
					if (!$this->lblSubmitDate) return $this->lblSubmitDate_Create();
					return $this->lblSubmitDate;
				case 'EmailControl':
					if (!$this->txtEmail) return $this->txtEmail_Create();
					return $this->txtEmail;
				case 'EmailLabel':
					if (!$this->lblEmail) return $this->lblEmail_Create();
					return $this->lblEmail;
				case 'SpeakTextControl':
					if (!$this->txtSpeakText) return $this->txtSpeakText_Create();
					return $this->txtSpeakText;
				case 'SpeakTextLabel':
					if (!$this->lblSpeakText) return $this->lblSpeakText_Create();
					return $this->lblSpeakText;
				case 'TranslationControl':
					if (!$this->txtTranslation) return $this->txtTranslation_Create();
					return $this->txtTranslation;
				case 'TranslationLabel':
					if (!$this->lblTranslation) return $this->lblTranslation_Create();
					return $this->lblTranslation;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/**
		 * Override method to perform a property "Set"
		 * This will set the property $strName to be $mixValue
		 *
		 * @param string $strName Name of the property to set
		 * @param string $mixValue New value of the property
		 * @return mixed
		 */
		public function __set($strName, $mixValue) {
			try {
				switch ($strName) {
					// Controls that point to Samples fields
					case 'IdControl':
						return ($this->lblId = QType::Cast($mixValue, 'QControl'));
					case 'GuidControl':
						return ($this->txtGuid = QType::Cast($mixValue, 'QControl'));
					case 'UserNameControl':
						return ($this->txtUserName = QType::Cast($mixValue, 'QControl'));
					case 'SubmitDateControl':
						return ($this->lblSubmitDate = QType::Cast($mixValue, 'QControl'));
					case 'EmailControl':
						return ($this->txtEmail = QType::Cast($mixValue, 'QControl'));
					case 'SpeakTextControl':
						return ($this->txtSpeakText = QType::Cast($mixValue, 'QControl'));
					case 'TranslationControl':
						return ($this->txtTranslation = QType::Cast($mixValue, 'QControl'));
					default:
						return parent::__set($strName, $mixValue);
				}
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
	}
?>