<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Samples class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Samples objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this SamplesListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 *
	 * @package My QCubed Application
	 * @subpackage Drafts
	 *
	 */
	class SamplesListPanel extends QPanel {
		// Local instance of the Meta DataGrid to list Sampleses
		/**
		 * @var SamplesDataGrid
		 */
		public $dtgSampleses;

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
			$this->Template = __DOCROOT__ . __PANEL_DRAFTS__ . '/SamplesListPanel.tpl.php';

			// Instantiate the Meta DataGrid
			$this->dtgSampleses = new SamplesDataGrid($this);

			// Style the DataGrid (if desired)
			$this->dtgSampleses->CssClass = 'datagrid';
			$this->dtgSampleses->AlternateRowStyle->CssClass = 'alternate';

			// Add Pagination (if desired)
			$this->dtgSampleses->Paginator = new QPaginator($this->dtgSampleses);
			$this->dtgSampleses->ItemsPerPage = __FORM_DRAFTS_PANEL_LIST_ITEMS_PER_PAGE__;

			// Use the MetaDataGrid functionality to add Columns for this datagrid

			// Create an Edit Column
			$this->pxyEdit = new QControlProxy($this);
			$this->pxyEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'pxyEdit_Click'));
			$this->dtgSampleses->MetaAddEditProxyColumn($this->pxyEdit, 'Edit', 'Edit');

			// Create the Other Columns (note that you can use strings for samples's properties, or you
			// can traverse down QQN::samples() to display fields that are down the hierarchy)
			$this->dtgSampleses->MetaAddColumn('Id');
			$this->dtgSampleses->MetaAddColumn('Guid');
			$this->dtgSampleses->MetaAddColumn('UserName');
			$this->dtgSampleses->MetaAddColumn('SubmitDate');
			$this->dtgSampleses->MetaAddColumn('Email');
			$this->dtgSampleses->MetaAddColumn('SpeakText');
			$this->dtgSampleses->MetaAddColumn('Translation');

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Samples');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function pxyEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objEditPanel = new SamplesEditPanel($this, $this->strCloseEditPanelMethod, $strParameterArray[0]);

			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new SamplesEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}
	}
?>