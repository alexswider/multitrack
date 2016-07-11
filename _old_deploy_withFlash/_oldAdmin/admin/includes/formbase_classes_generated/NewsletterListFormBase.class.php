<?php
	/**
	 * This is a quick-and-dirty draft QForm object to do the List All functionality
	 * of the Newsletter class.  It uses the code-generated
	 * NewsletterDataGrid control which has meta-methods to help with
	 * easily creating/defining Newsletter columns.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 * 
	 * NOTE: This file is overwritten on any code regenerations.  If you want to make
	 * permanent changes, it is STRONGLY RECOMMENDED to move both newsletter_list.php AND
	 * newsletter_list.tpl.php out of this Form Drafts directory.
	 *
	 * @package My QCubed Application
	 * @subpackage FormBaseObjects
	 */
	abstract class NewsletterListFormBase extends QForm {
		// Local instance of the Meta DataGrid to list Newsletters
		/**
		 * @var NewsletterDataGrid dtgNewsletters
		 */
		protected $dtgNewsletters;

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
			$this->dtgNewsletters = new NewsletterDataGrid($this);

			// Style the DataGrid (if desired)
			$this->dtgNewsletters->CssClass = 'datagrid';
			$this->dtgNewsletters->AlternateRowStyle->CssClass = 'alternate';

			// Add Pagination (if desired)
			$this->dtgNewsletters->Paginator = new QPaginator($this->dtgNewsletters);
			$this->dtgNewsletters->ItemsPerPage = __FORM_DRAFTS_FORM_LIST_ITEMS_PER_PAGE__;

			// Use the MetaDataGrid functionality to add Columns for this datagrid

			// Create an Edit Column
			$strEditPageUrl = __VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__ . '/newsletter_edit.php';
			$this->dtgNewsletters->MetaAddEditLinkColumn($strEditPageUrl, 'Edit', 'Edit');

			// Create the Other Columns (note that you can use strings for newsletter's properties, or you
			// can traverse down QQN::newsletter() to display fields that are down the hierarchy)
			$this->dtgNewsletters->MetaAddColumn('Id');
			$this->dtgNewsletters->MetaAddColumn('UserName');
			$this->dtgNewsletters->MetaAddColumn('Email');
		}
	}
?>
