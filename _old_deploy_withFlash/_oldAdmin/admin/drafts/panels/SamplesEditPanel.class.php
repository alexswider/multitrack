<?php
	/**
	 * This is a quick-and-dirty draft QPanel object to do Create, Edit, and Delete functionality
	 * of the Samples class.  It uses the code-generated
	 * SamplesMetaControl class, which has meta-methods to help with
	 * easily creating/defining controls to modify the fields of a Samples columns.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 *
	 * NOTE: This file is overwritten on any code regenerations.  If you want to make
	 * permanent changes, it is STRONGLY RECOMMENDED to move both samples_edit.php AND
	 * samples_edit.tpl.php out of this Form Drafts directory.
	 *
	 * @package My QCubed Application
	 * @subpackage Drafts
	 */
	class SamplesEditPanel extends QPanel {
		// Local instance of the SamplesMetaControl
		/**
		 * @var SamplesMetaControl
		 */
		protected $mctSamples;

		// Controls for Samples's Data Fields
		public $lblId;
		public $txtGuid;
		public $txtUserName;
		public $lblSubmitDate;
		public $txtEmail;
		public $txtSpeakText;
		public $txtTranslation;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Other Controls
		/**
		 * @var QButton Save
		 */
		public $btnSave;
		/**
		 * @var QButton Delete
		 */
		public $btnDelete;
		/**
		 * @var QButton Cancel
		 */
		public $btnCancel;

		// Callback
		protected $strClosePanelMethod;

		public function __construct($objParentObject, $strClosePanelMethod, $intId = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Setup Callback and Template
			$this->strTemplate = __DOCROOT__ . __PANEL_DRAFTS__ . '/SamplesEditPanel.tpl.php';
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Construct the SamplesMetaControl
			// MAKE SURE we specify "$this" as the MetaControl's (and thus all subsequent controls') parent
			$this->mctSamples = SamplesMetaControl::Create($this, $intId);

			// Call MetaControl's methods to create qcontrols based on Samples's data fields
			$this->lblId = $this->mctSamples->lblId_Create();
			$this->txtGuid = $this->mctSamples->txtGuid_Create();
			$this->txtUserName = $this->mctSamples->txtUserName_Create();
			$this->lblSubmitDate = $this->mctSamples->lblSubmitDate_Create();
			$this->txtEmail = $this->mctSamples->txtEmail_Create();
			$this->txtSpeakText = $this->mctSamples->txtSpeakText_Create();
			$this->txtTranslation = $this->mctSamples->txtTranslation_Create();

			// Create Buttons and Actions on this Form
			$this->btnSave = new QButton($this);
			$this->btnSave->Text = QApplication::Translate('Save');
			$this->btnSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
			$this->btnSave->CausesValidation = $this;

			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCancel_Click'));

			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'),  QApplication::Translate('Samples'))));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->Visible = $this->mctSamples->EditMode;
		}

		// Control AjaxAction Event Handlers
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			// Delegate "Save" processing to the SamplesMetaControl
			$this->mctSamples->SaveSamples();
			$this->CloseSelf(true);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {
			// Delegate "Delete" processing to the SamplesMetaControl
			$this->mctSamples->DeleteSamples();
			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		// Close Myself and Call ClosePanelMethod Callback
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}

		// Check for records that may violate Unique Clauses
		public function Validate() {
			$blnToReturn = true;
			if (($objSamples = Samples::LoadByGuid($this->txtGuid->Text)) && ($objSamples->Id != $this->mctSamples->Samples->Id )){
				$blnToReturn = false;
				$this->txtGuid->Warning = QApplication::Translate("Already in Use");
			}
	return $blnToReturn;
		}

	}
?>