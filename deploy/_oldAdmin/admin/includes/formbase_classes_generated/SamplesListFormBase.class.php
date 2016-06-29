<?php
	/**
	 * This is a quick-and-dirty draft QForm object to do the List All functionality
	 * of the Samples class.  It uses the code-generated
	 * SamplesDataGrid control which has meta-methods to help with
	 * easily creating/defining Samples columns.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 * 
	 * NOTE: This file is overwritten on any code regenerations.  If you want to make
	 * permanent changes, it is STRONGLY RECOMMENDED to move both samples_list.php AND
	 * samples_list.tpl.php out of this Form Drafts directory.
	 *
	 * @package My QCubed Application
	 * @subpackage FormBaseObjects
	 */
	abstract class SamplesListFormBase extends QForm {
		// Local instance of the Meta DataGrid to list Sampleses
		/**
		 * @var SamplesDataGrid dtgSampleses
		 */
		protected $dtgSampleses;

		// Create QForm Event Handlers as Needed

//		protected function Form_Exit() {}
//		protected function Form_Load() {}
//		protected function Form_PreRender() {}
//		protected function Form_Validate() {}

		protected function Form_Run() {
			parent::Form_Run();
		}

		protected function Form_Create() {
			parent::Form_Create();

			// Instantiate the Meta DataGrid
			$this->dtgSampleses = new SamplesDataGrid($this);

			// Style the DataGrid (if desired)
			$this->dtgSampleses->CssClass = 'datagrid';
			$this->dtgSampleses->AlternateRowStyle->CssClass = 'alternate';

			// Add Pagination (if desired)
			$this->dtgSampleses->Paginator = new QPaginator($this->dtgSampleses);
			$this->dtgSampleses->ItemsPerPage = __FORM_DRAFTS_FORM_LIST_ITEMS_PER_PAGE__;

			// Use the MetaDataGrid functionality to add Columns for this datagrid

			// Create an Edit Column
			$strEditPageUrl = __VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__ . '/samples_edit.php';
			$this->dtgSampleses->MetaAddEditLinkColumn($strEditPageUrl, 'Edit', 'Edit');

			// Create the Other Columns (note that you can use strings for samples's properties, or you
			// can traverse down QQN::samples() to display fields that are down the hierarchy)
			$this->dtgSampleses->MetaAddColumn('Id');
			$this->dtgSampleses->MetaAddColumn('Guid');
			$this->dtgSampleses->MetaAddColumn('UserName');
			$this->dtgSampleses->MetaAddColumn('SubmitDate');
			$this->dtgSampleses->MetaAddColumn('Email');
			$this->dtgSampleses->MetaAddColumn('SpeakText');
			$this->dtgSampleses->MetaAddColumn('Translation');
		}
	}
?>
