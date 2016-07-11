<?php
	/**
	 * This is a MetaControl class, providing a QForm or QPanel access to event handlers
	 * and QControls to perform the Create, Edit, and Delete functionality
	 * of the SamplesData class.  This code-generated class
	 * contains all the basic elements to help a QPanel or QForm display an HTML form that can
	 * manipulate a single SamplesData object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QForm or QPanel which instantiates a SamplesDataMetaControl
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent
	 * code re-generation.
	 *
	 * @package My QCubed Application
	 * @subpackage MetaControls
	 * @property-read SamplesData $SamplesData the actual SamplesData data class being edited
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
	 * @property QTextBox $NewsletterControl
	 * @property-read QLabel $NewsletterLabel
	 * @property QIntegerTextBox $ScoreControl
	 * @property-read QLabel $ScoreLabel
	 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
	 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
	 */

	class SamplesDataMetaControlGen extends QBaseClass {
		// General Variables
		/**
		 * @var SamplesData objSamplesData
		 * @access protected
		 */
		protected $objSamplesData;
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

		// Controls that allow the editing of SamplesData's individual data fields
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
		/**
		 * @var QTextBox txtNewsletter
		 * @access protected
		 */
		protected $txtNewsletter;
		/**
		 * @var QIntegerTextBox txtScore
		 * @access protected
		 */
		protected $txtScore;

		// Controls that allow the viewing of SamplesData's individual data fields
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
		/**
		 * @var QLabel lblNewsletter
		 * @access protected
		 */
		protected $lblNewsletter;
		/**
		 * @var QLabel lblScore
		 * @access protected
		 */
		protected $lblScore;

		// QListBox Controls (if applicable) to edit Unique ReverseReferences and ManyToMany References

		// QLabel Controls (if applicable) to view Unique ReverseReferences and ManyToMany References


		/**
		 * Main constructor.  Constructor OR static create methods are designed to be called in either
		 * a parent QPanel or the main QForm when wanting to create a
		 * SamplesDataMetaControl to edit a single SamplesData object within the
		 * QPanel or QForm.
		 *
		 * This constructor takes in a single SamplesData object, while any of the static
		 * create methods below can be used to construct based off of individual PK ID(s).
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this SamplesDataMetaControl
		 * @param SamplesData $objSamplesData new or existing SamplesData object
		 */
		 public function __construct($objParentObject, SamplesData $objSamplesData) {
			// Setup Parent Object (e.g. QForm or QPanel which will be using this SamplesDataMetaControl)
			$this->objParentObject = $objParentObject;

			// Setup linked SamplesData object
			$this->objSamplesData = $objSamplesData;

			// Figure out if we're Editing or Creating New
			if ($this->objSamplesData->__Restored) {
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
		 * @param mixed $objParentObject QForm or QPanel which will be using this SamplesDataMetaControl
		 * @param integer $intId primary key value
		 * @param QMetaControlCreateType $intCreateType rules governing SamplesData object creation - defaults to CreateOrEdit
 		 * @return SamplesDataMetaControl
		 */
		public static function Create($objParentObject, $intId = null, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			// Attempt to Load from PK Arguments
			if (strlen($intId)) {
				$objSamplesData = SamplesData::Load($intId);

				// SamplesData was found -- return it!
				if ($objSamplesData)
					return new SamplesDataMetaControl($objParentObject, $objSamplesData);

				// If CreateOnRecordNotFound not specified, throw an exception
				else if ($intCreateType != QMetaControlCreateType::CreateOnRecordNotFound)
					throw new QCallerException('Could not find a SamplesData object with PK arguments: ' . $intId);

			// If EditOnly is specified, throw an exception
			} else if ($intCreateType == QMetaControlCreateType::EditOnly)
				throw new QCallerException('No PK arguments specified');

			// If we are here, then we need to create a new record
			return new SamplesDataMetaControl($objParentObject, new SamplesData());
		}

		/**
		 * Static Helper Method to Create using PathInfo arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this SamplesDataMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing SamplesData object creation - defaults to CreateOrEdit
		 * @return SamplesDataMetaControl
		 */
		public static function CreateFromPathInfo($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::PathInfo(0);
			return SamplesDataMetaControl::Create($objParentObject, $intId, $intCreateType);
		}

		/**
		 * Static Helper Method to Create using QueryString arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this SamplesDataMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing SamplesData object creation - defaults to CreateOrEdit
		 * @return SamplesDataMetaControl
		 */
		public static function CreateFromQueryString($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::QueryString('intId');
			return SamplesDataMetaControl::Create($objParentObject, $intId, $intCreateType);
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
				$this->lblId->Text = $this->objSamplesData->Id;
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
			$this->txtGuid->Text = $this->objSamplesData->Guid;
			$this->txtGuid->Required = true;
			$this->txtGuid->MaxLength = SamplesData::GuidMaxLength;
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
			$this->lblGuid->Text = $this->objSamplesData->Guid;
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
			$this->txtUserName->Text = $this->objSamplesData->UserName;
			$this->txtUserName->Required = true;
			$this->txtUserName->MaxLength = SamplesData::UserNameMaxLength;
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
			$this->lblUserName->Text = $this->objSamplesData->UserName;
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
				$this->lblSubmitDate->Text = $this->objSamplesData->SubmitDate;
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
			$this->txtEmail->Text = $this->objSamplesData->Email;
			$this->txtEmail->Required = true;
			$this->txtEmail->MaxLength = SamplesData::EmailMaxLength;
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
			$this->lblEmail->Text = $this->objSamplesData->Email;
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
			$this->txtSpeakText->Text = $this->objSamplesData->SpeakText;
			$this->txtSpeakText->Required = true;
			$this->txtSpeakText->MaxLength = SamplesData::SpeakTextMaxLength;
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
			$this->lblSpeakText->Text = $this->objSamplesData->SpeakText;
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
			$this->txtTranslation->Text = $this->objSamplesData->Translation;
			$this->txtTranslation->Required = true;
			$this->txtTranslation->MaxLength = SamplesData::TranslationMaxLength;
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
			$this->lblTranslation->Text = $this->objSamplesData->Translation;
			$this->lblTranslation->Required = true;
			return $this->lblTranslation;
		}

		/**
		 * Create and setup QTextBox txtNewsletter
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtNewsletter_Create($strControlId = null) {
			$this->txtNewsletter = new QTextBox($this->objParentObject, $strControlId);
			$this->txtNewsletter->Name = QApplication::Translate('Newsletter');
			$this->txtNewsletter->Text = $this->objSamplesData->Newsletter;
			$this->txtNewsletter->Required = true;
			$this->txtNewsletter->MaxLength = SamplesData::NewsletterMaxLength;
			return $this->txtNewsletter;
		}

		/**
		 * Create and setup QLabel lblNewsletter
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblNewsletter_Create($strControlId = null) {
			$this->lblNewsletter = new QLabel($this->objParentObject, $strControlId);
			$this->lblNewsletter->Name = QApplication::Translate('Newsletter');
			$this->lblNewsletter->Text = $this->objSamplesData->Newsletter;
			$this->lblNewsletter->Required = true;
			return $this->lblNewsletter;
		}

		/**
		 * Create and setup QIntegerTextBox txtScore
		 * @param string $strControlId optional ControlId to use
		 * @return QIntegerTextBox
		 */
		public function txtScore_Create($strControlId = null) {
			$this->txtScore = new QIntegerTextBox($this->objParentObject, $strControlId);
			$this->txtScore->Name = QApplication::Translate('Score');
			$this->txtScore->Text = $this->objSamplesData->Score;
			$this->txtScore->Required = true;
			return $this->txtScore;
		}

		/**
		 * Create and setup QLabel lblScore
		 * @param string $strControlId optional ControlId to use
		 * @param string $strFormat optional sprintf format to use
		 * @return QLabel
		 */
		public function lblScore_Create($strControlId = null, $strFormat = null) {
			$this->lblScore = new QLabel($this->objParentObject, $strControlId);
			$this->lblScore->Name = QApplication::Translate('Score');
			$this->lblScore->Text = $this->objSamplesData->Score;
			$this->lblScore->Required = true;
			$this->lblScore->Format = $strFormat;
			return $this->lblScore;
		}



		/**
		 * Refresh this MetaControl with Data from the local SamplesData object.
		 * @param boolean $blnReload reload SamplesData from the database
		 * @return void
		 */
		public function Refresh($blnReload = false) {
			if ($blnReload)
				$this->objSamplesData->Reload();

			if ($this->lblId) if ($this->blnEditMode) $this->lblId->Text = $this->objSamplesData->Id;

			if ($this->txtGuid) $this->txtGuid->Text = $this->objSamplesData->Guid;
			if ($this->lblGuid) $this->lblGuid->Text = $this->objSamplesData->Guid;

			if ($this->txtUserName) $this->txtUserName->Text = $this->objSamplesData->UserName;
			if ($this->lblUserName) $this->lblUserName->Text = $this->objSamplesData->UserName;

			if ($this->lblSubmitDate) if ($this->blnEditMode) $this->lblSubmitDate->Text = $this->objSamplesData->SubmitDate;

			if ($this->txtEmail) $this->txtEmail->Text = $this->objSamplesData->Email;
			if ($this->lblEmail) $this->lblEmail->Text = $this->objSamplesData->Email;

			if ($this->txtSpeakText) $this->txtSpeakText->Text = $this->objSamplesData->SpeakText;
			if ($this->lblSpeakText) $this->lblSpeakText->Text = $this->objSamplesData->SpeakText;

			if ($this->txtTranslation) $this->txtTranslation->Text = $this->objSamplesData->Translation;
			if ($this->lblTranslation) $this->lblTranslation->Text = $this->objSamplesData->Translation;

			if ($this->txtNewsletter) $this->txtNewsletter->Text = $this->objSamplesData->Newsletter;
			if ($this->lblNewsletter) $this->lblNewsletter->Text = $this->objSamplesData->Newsletter;

			if ($this->txtScore) $this->txtScore->Text = $this->objSamplesData->Score;
			if ($this->lblScore) $this->lblScore->Text = $this->objSamplesData->Score;

		}



		///////////////////////////////////////////////
		// PROTECTED UPDATE METHODS for ManyToManyReferences (if any)
		///////////////////////////////////////////////





		///////////////////////////////////////////////
		// PUBLIC SAMPLESDATA OBJECT MANIPULATORS
		///////////////////////////////////////////////

		/**
		 * This will save this object's SamplesData instance,
		 * updating only the fields which have had a control created for it.
		 */
		public function SaveSamplesData() {
			try {
				// Update any fields for controls that have been created
				if ($this->txtGuid) $this->objSamplesData->Guid = $this->txtGuid->Text;
				if ($this->txtUserName) $this->objSamplesData->UserName = $this->txtUserName->Text;
				if ($this->txtEmail) $this->objSamplesData->Email = $this->txtEmail->Text;
				if ($this->txtSpeakText) $this->objSamplesData->SpeakText = $this->txtSpeakText->Text;
				if ($this->txtTranslation) $this->objSamplesData->Translation = $this->txtTranslation->Text;
				if ($this->txtNewsletter) $this->objSamplesData->Newsletter = $this->txtNewsletter->Text;
				if ($this->txtScore) $this->objSamplesData->Score = $this->txtScore->Text;

				// Update any UniqueReverseReferences (if any) for controls that have been created for it

				// Save the SamplesData object
				$this->objSamplesData->Save();

				// Finally, update any ManyToManyReferences (if any)
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * This will DELETE this object's SamplesData instance from the database.
		 * It will also unassociate itself from any ManyToManyReferences.
		 */
		public function DeleteSamplesData() {
			$this->objSamplesData->Delete();
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
				case 'SamplesData': return $this->objSamplesData;
				case 'TitleVerb': return $this->strTitleVerb;
				case 'EditMode': return $this->blnEditMode;

				// Controls that point to SamplesData fields -- will be created dynamically if not yet created
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
				case 'NewsletterControl':
					if (!$this->txtNewsletter) return $this->txtNewsletter_Create();
					return $this->txtNewsletter;
				case 'NewsletterLabel':
					if (!$this->lblNewsletter) return $this->lblNewsletter_Create();
					return $this->lblNewsletter;
				case 'ScoreControl':
					if (!$this->txtScore) return $this->txtScore_Create();
					return $this->txtScore;
				case 'ScoreLabel':
					if (!$this->lblScore) return $this->lblScore_Create();
					return $this->lblScore;
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
					// Controls that point to SamplesData fields
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
					case 'NewsletterControl':
						return ($this->txtNewsletter = QType::Cast($mixValue, 'QControl'));
					case 'ScoreControl':
						return ($this->txtScore = QType::Cast($mixValue, 'QControl'));
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