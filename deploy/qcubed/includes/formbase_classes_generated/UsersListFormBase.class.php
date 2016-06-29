<?php
	/**
	 * This is a quick-and-dirty draft QForm object to do the List All functionality
	 * of the Users class.  It uses the code-generated
	 * UsersDataGrid control which has meta-methods to help with
	 * easily creating/defining Users columns.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 * 
	 * NOTE: This file is overwritten on any code regenerations.  If you want to make
	 * permanent changes, it is STRONGLY RECOMMENDED to move both users_list.php AND
	 * users_list.tpl.php out of this Form Drafts directory.
	 *
	 * @package My QCubed Application
	 * @subpackage FormBaseObjects
	 */
	abstract class UsersListFormBase extends QForm {
		// Local instance of the Meta DataGrid to list Userses
		/**
		 * @var UsersDataGrid dtgUserses
		 */
		protected $dtgUserses;

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
			$this->dtgUserses = new UsersDataGrid($this);

			// Style the DataGrid (if desired)
			$this->dtgUserses->CssClass = 'datagrid';
			$this->dtgUserses->AlternateRowStyle->CssClass = 'alternate';

			// Add Pagination (if desired)
			$this->dtgUserses->Paginator = new QPaginator($this->dtgUserses);
			$this->dtgUserses->ItemsPerPage = __FORM_DRAFTS_FORM_LIST_ITEMS_PER_PAGE__;

			// Use the MetaDataGrid functionality to add Columns for this datagrid

			// Create an Edit Column
			$strEditPageUrl = __VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__ . '/users_edit.php';
			$this->dtgUserses->MetaAddEditLinkColumn($strEditPageUrl, 'Edit', 'Edit');

			// Create the Other Columns (note that you can use strings for users's properties, or you
			// can traverse down QQN::users() to display fields that are down the hierarchy)
			$this->dtgUserses->MetaAddColumn('Id');
			$this->dtgUserses->MetaAddColumn('Name');
			$this->dtgUserses->MetaAddColumn('FbId');
			$this->dtgUserses->MetaAddColumn('Ip');
			$this->dtgUserses->MetaAddColumn('Avatar');
			$this->dtgUserses->MetaAddColumn('LastLogged');
		}
	}
?>
