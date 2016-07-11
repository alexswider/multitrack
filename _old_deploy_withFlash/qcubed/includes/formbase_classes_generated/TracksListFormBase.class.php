<?php
	/**
	 * This is a quick-and-dirty draft QForm object to do the List All functionality
	 * of the Tracks class.  It uses the code-generated
	 * TracksDataGrid control which has meta-methods to help with
	 * easily creating/defining Tracks columns.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 * 
	 * NOTE: This file is overwritten on any code regenerations.  If you want to make
	 * permanent changes, it is STRONGLY RECOMMENDED to move both tracks_list.php AND
	 * tracks_list.tpl.php out of this Form Drafts directory.
	 *
	 * @package My QCubed Application
	 * @subpackage FormBaseObjects
	 */
	abstract class TracksListFormBase extends QForm {
		// Local instance of the Meta DataGrid to list Trackses
		/**
		 * @var TracksDataGrid dtgTrackses
		 */
		protected $dtgTrackses;

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
			$this->dtgTrackses = new TracksDataGrid($this);

			// Style the DataGrid (if desired)
			$this->dtgTrackses->CssClass = 'datagrid';
			$this->dtgTrackses->AlternateRowStyle->CssClass = 'alternate';

			// Add Pagination (if desired)
			$this->dtgTrackses->Paginator = new QPaginator($this->dtgTrackses);
			$this->dtgTrackses->ItemsPerPage = __FORM_DRAFTS_FORM_LIST_ITEMS_PER_PAGE__;

			// Use the MetaDataGrid functionality to add Columns for this datagrid

			// Create an Edit Column
			$strEditPageUrl = __VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__ . '/tracks_edit.php';
			$this->dtgTrackses->MetaAddEditLinkColumn($strEditPageUrl, 'Edit', 'Edit');

			// Create the Other Columns (note that you can use strings for tracks's properties, or you
			// can traverse down QQN::tracks() to display fields that are down the hierarchy)
			$this->dtgTrackses->MetaAddColumn('Id');
			$this->dtgTrackses->MetaAddColumn('RoomId');
			$this->dtgTrackses->MetaAddColumn('UserId');
			$this->dtgTrackses->MetaAddColumn('TrackNumber');
		}
	}
?>
