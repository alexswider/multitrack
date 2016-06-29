<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the SamplesData class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of SamplesData objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this SamplesDataListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 *
	 * @package My QCubed Application
	 * @subpackage Drafts
	 *
	 */
	class SamplesDataListPanel extends QPanel {
		// Local instance of the Meta DataGrid to list SamplesDatas
		/**
		 * @var SamplesDataDataGrid
		 */
		public $dtgSamplesDatas;

		// Other public QControls in this panel
		/**
		 * @var QButton CreateNew
		 */
		public $btnCreateNew;
		/**
		 * @var QControlProxy ProxyEdit
		 */
		public $pxyEdit;

		// Callback Method Names
		/**
		 * @var string SetEditPanelMethod
		 */
		protected $strSetEditPanelMethod;
		/**
		 * @var string CloseEditPanelMethod
		 */
		protected $strCloseEditPanelMethod;

		public function __construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Record Method Callbacks
			$this->strSetEditPanelMethod = $strSetEditPanelMethod;
			$this->strCloseEditPanelMethod = $strCloseEditPanelMethod;

			// Setup the Template
			$this->Template = __DOCROOT__ . __PANEL_DRAFTS__ . '/SamplesDataListPanel.tpl.php';

			// Instantiate the Meta DataGrid
			$this->dtgSamplesDatas = new SamplesDataDataGrid($this);

			// Style the DataGrid (if desired)
			$this->dtgSamplesDatas->CssClass = 'datagrid';
			$this->dtgSamplesDatas->AlternateRowStyle->CssClass = 'alternate';

			// Add Pagination (if desired)
			$this->dtgSamplesDatas->Paginator = new QPaginator($this->dtgSamplesDatas);
			$this->dtgSamplesDatas->ItemsPerPage = __FORM_DRAFTS_PANEL_LIST_ITEMS_PER_PAGE__;

			// Use the MetaDataGrid functionality to add Columns for this datagrid

			// Create an Edit Column
			$this->pxyEdit = new QControlProxy($this);
			$this->pxyEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'pxyEdit_Click'));
			$this->dtgSamplesDatas->MetaAddEditProxyColumn($this->pxyEdit, 'Edit', 'Edit');

			// Create the Other Columns (note that you can use strings for samplesData's properties, or you
			// can traverse down QQN::samplesData() to display fields that are down the hierarchy)
			$this->dtgSamplesDatas->MetaAddColumn('Id');
			$this->dtgSamplesDatas->MetaAddColumn('Guid');
			$this->dtgSamplesDatas->MetaAddColumn('UserName');
			$this->dtgSamplesDatas->MetaAddColumn('SubmitDate');
			$this->dtgSamplesDatas->MetaAddColumn('Email');
			$this->dtgSamplesDatas->MetaAddColumn('SpeakText');
			$this->dtgSamplesDatas->MetaAddColumn('Translation');
			$this->dtgSamplesDatas->MetaAddColumn('Newsletter');
			$this->dtgSamplesDatas->MetaAddColumn('Score');

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('SamplesData');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function pxyEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objEditPanel = new SamplesDataEditPanel($this, $this->strCloseEditPanelMethod, $strParameterArray[0]);

			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new SamplesDataEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}
	}
?>