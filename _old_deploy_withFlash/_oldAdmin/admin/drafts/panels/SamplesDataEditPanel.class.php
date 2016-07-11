<?php
	/**
	 * This is a quick-and-dirty draft QPanel object to do Create, Edit, and Delete functionality
	 * of the SamplesData class.  It uses the code-generated
	 * SamplesDataMetaControl class, which has meta-methods to help with
	 * easily creating/defining controls to modify the fields of a SamplesData columns.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 *
	 * NOTE: This file is overwritten on any code regenerations.  If you want to make
	 * permanent changes, it is STRONGLY RECOMMENDED to move both samples_data_edit.php AND
	 * samples_data_edit.tpl.php out of this Form Drafts directory.
	 *
	 * @package My QCubed Application
	 * @subpackage Drafts
	 */
	class SamplesDataEditPanel extends QPanel {
		// Local instance of the SamplesDataMetaControl
		/**
		 * @var SamplesDataMetaControl
		 */
		protected $mctSamplesData;

		// Controls for SamplesData's Data Fields
		public $lblId;
		public $txtGuid;
		public $txtUserName;
		public $lblSubmitDate;
		public $txtEmail;
		public $txtSpeakText;
		public $txtTranslation;
		public $txtNewsletter;
		public $txtScore;

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
			$this->strTemplate = __DOCROOT__ . __PANEL_DRAFTS__ . '/SamplesDataEditPanel.tpl.php';
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Construct the SamplesDataMetaControl
			// MAKE SURE we specify "$this" as the MetaControl's (and thus all subsequent controls') parent
			$this->mctSamplesData = SamplesDataMetaControl::Create($this, $intId);

			// Call MetaControl's methods to create qcontrols based on SamplesData's data fields
			$this->lblId = $this->mctSamplesData->lblId_Create();
			$this->txtGuid = $this->mctSamplesData->txtGuid_Create();
			$this->txtUserName = $this->mctSamplesData->txtUserName_Create();
			$this->lblSubmitDate = $this->mctSamplesData->lblSubmitDate_Create();
			$this->txtEmail = $this->mctSamplesData->txtEmail_Create();
			$this->txtSpeakText = $this->mctSamplesData->txtSpeakText_Create();
			$this->txtTranslation = $this->mctSamplesData->txtTranslation_Create();
			$this->txtNewsletter = $this->mctSamplesData->txtNewsletter_Create();
			$this->txtScore = $this->mctSamplesData->txtScore_Create();

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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'),  QApplication::Translate('SamplesData'))));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->Visible = $this->mctSamplesData->EditMode;
		}

		// Control AjaxAction Event Handlers
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			// Delegate "Save" processing to the SamplesDataMetaControl
			$this->mctSamplesData->SaveSamplesData();
			$this->CloseSelf(true);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {
			// Delegate "Delete" processing to the SamplesDataMetaControl
			$this->mctSamplesData->DeleteSamplesData();
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

		
	}
?>