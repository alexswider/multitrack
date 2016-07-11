<?php
	/**
	 * This is a quick-and-dirty draft QForm object to do the List All functionality
	 * of the Rooms class.  It uses the code-generated
	 * RoomsDataGrid control which has meta-methods to help with
	 * easily creating/defining Rooms columns.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 * 
	 * NOTE: This file is overwritten on any code regenerations.  If you want to make
	 * permanent changes, it is STRONGLY RECOMMENDED to move both rooms_list.php AND
	 * rooms_list.tpl.php out of this Form Drafts directory.
	 *
	 * @package My QCubed Application
	 * @subpackage FormBaseObjects
	 */
	abstract class RoomsListFormBase extends QForm {
		// Local instance of the Meta DataGrid to list Roomses
		/**
		 * @var RoomsDataGrid dtgRoomses
		 */
		protected $dtgRoomses;

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
			$this->dtgRoomses = new RoomsDataGrid($this);

			// Style the DataGrid (if desired)
			$this->dtgRoomses->CssClass = 'datagrid';
			$this->dtgRoomses->AlternateRowStyle->CssClass = 'alternate';

			// Add Pagination (if desired)
			$this->dtgRoomses->Paginator = new QPaginator($this->dtgRoomses);
			$this->dtgRoomses->ItemsPerPage = __FORM_DRAFTS_FORM_LIST_ITEMS_PER_PAGE__;

			// Use the MetaDataGrid functionality to add Columns for this datagrid

			// Create an Edit Column
			$strEditPageUrl = __VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__ . '/rooms_edit.php';
			$this->dtgRoomses->MetaAddEditLinkColumn($strEditPageUrl, 'Edit', 'Edit');

			// Create the Other Columns (note that you can use strings for rooms's properties, or you
			// can traverse down QQN::rooms() to display fields that are down the hierarchy)
			$this->dtgRoomses->MetaAddColumn('Id');
			$this->dtgRoomses->MetaAddColumn('HostID');
			$this->dtgRoomses->MetaAddColumn('UnlockedTracks');
			$this->dtgRoomses->MetaAddColumn('CreatedTime');
			$this->dtgRoomses->MetaAddColumn('Urk');
		}
	}
?>
