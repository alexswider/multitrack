<?php
	/**
	 * This is a quick-and-dirty draft QForm object to do the List All functionality
	 * of the SamplesData class.  It uses the code-generated
	 * SamplesDataDataGrid control which has meta-methods to help with
	 * easily creating/defining SamplesData columns.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 * 
	 * NOTE: This file is overwritten on any code regenerations.  If you want to make
	 * permanent changes, it is STRONGLY RECOMMENDED to move both samples_data_list.php AND
	 * samples_data_list.tpl.php out of this Form Drafts directory.
	 *
	 * @package My QCubed Application
	 * @subpackage FormBaseObjects
	 */
	abstract class SamplesDataListFormBase extends QForm {
		// Local instance of the Meta DataGrid to list SamplesDatas
		/**
		 * @var SamplesDataDataGrid dtgSamplesDatas
		 */
		protected $dtgSamplesDatas;

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
			$this->dtgSamplesDatas = new SamplesDataDataGrid($this);

			// Style the DataGrid (if desired)
			$this->dtgSamplesDatas->CssClass = 'datagrid';
			$this->dtgSamplesDatas->AlternateRowStyle->CssClass = 'alternate';

			// Add Pagination (if desired)
			$this->dtgSamplesDatas->Paginator = new QPaginator($this->dtgSamplesDatas);
			$this->dtgSamplesDatas->ItemsPerPage = __FORM_DRAFTS_FORM_LIST_ITEMS_PER_PAGE__;

			// Use the MetaDataGrid functionality to add Columns for this datagrid

			// Create an Edit Column
			$strEditPageUrl = __VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__ . '/samplesdata_edit.php';
			$this->dtgSamplesDatas->MetaAddEditLinkColumn($strEditPageUrl, 'Edit', 'Edit');

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
		}
	}
?>
