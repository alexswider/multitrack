<?php
	/**
	 * This is a MetaControl class, providing a QForm or QPanel access to event handlers
	 * and QControls to perform the Create, Edit, and Delete functionality
	 * of the Tracks class.  This code-generated class
	 * contains all the basic elements to help a QPanel or QForm display an HTML form that can
	 * manipulate a single Tracks object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QForm or QPanel which instantiates a TracksMetaControl
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent
	 * code re-generation.
	 *
	 * @package My QCubed Application
	 * @subpackage MetaControls
	 * @property-read Tracks $Tracks the actual Tracks data class being edited
	 * @property QLabel $IdControl
	 * @property-read QLabel $IdLabel
	 * @property QIntegerTextBox $RoomIdControl
	 * @property-read QLabel $RoomIdLabel
	 * @property QIntegerTextBox $UserIdControl
	 * @property-read QLabel $UserIdLabel
	 * @property QIntegerTextBox $TrackNumberControl
	 * @property-read QLabel $TrackNumberLabel
	 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
	 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
	 */

	class TracksMetaControlGen extends QBaseClass {
		// General Variables
		/**
		 * @var Tracks objTracks
		 * @access protected
		 */
		protected $objTracks;
		/**
		 * @var QForm|QControl objParentObject
		 * @access protected
		 */
		protected $objParentObject;
		/**
		 * @var string strTitleVerb
		 * @access protected
		 */
		protected $strTitleVerb;
		/**
		 * @var boolean blnEditMode
		 * @access protected
		 */
		protected $blnEditMode;

		// Controls that allow the editing of Tracks's individual data fields
		/**
		 * @var QLabel lblId
		 * @access protected
		 */
		protected $lblId;
		/**
		 * @var QIntegerTextBox txtRoomId
		 * @access protected
		 */
		protected $txtRoomId;
		/**
		 * @var QIntegerTextBox txtUserId
		 * @access protected
		 */
		protected $txtUserId;
		/**
		 * @var QIntegerTextBox txtTrackNumber
		 * @access protected
		 */
		protected $txtTrackNumber;

		// Controls that allow the viewing of Tracks's individual data fields
		/**
		 * @var QLabel lblRoomId
		 * @access protected
		 */
		protected $lblRoomId;
		/**
		 * @var QLabel lblUserId
		 * @access protected
		 */
		protected $lblUserId;
		/**
		 * @var QLabel lblTrackNumber
		 * @access protected
		 */
		protected $lblTrackNumber;

		// QListBox Controls (if applicable) to edit Unique ReverseReferences and ManyToMany References

		// QLabel Controls (if applicable) to view Unique ReverseReferences and ManyToMany References


		/**
		 * Main constructor.  Constructor OR static create methods are designed to be called in either
		 * a parent QPanel or the main QForm when wanting to create a
		 * TracksMetaControl to edit a single Tracks object within the
		 * QPanel or QForm.
		 *
		 * This constructor takes in a single Tracks object, while any of the static
		 * create methods below can be used to construct based off of individual PK ID(s).
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this TracksMetaControl
		 * @param Tracks $objTracks new or existing Tracks object
		 */
		 public function __construct($objParentObject, Tracks $objTracks) {
			// Setup Parent Object (e.g. QForm or QPanel which will be using this TracksMetaControl)
			$this->objParentObject = $objParentObject;

			// Setup linked Tracks object
			$this->objTracks = $objTracks;

			// Figure out if we're Editing or Creating New
			if ($this->objTracks->__Restored) {
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		 }

		/**
		 * Static Helper Method to Create using PK arguments
		 * You must pass in the PK arguments on an object to load, or leave it blank to create a new one.
		 * If you want to load via QueryString or PathInfo, use the CreateFromQueryString or CreateFromPathInfo
		 * static helper methods.  Finally, specify a CreateType to define whether or not we are only allowed to
		 * edit, or if we are also allowed to create a new one, etc.
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this TracksMetaControl
		 * @param integer $intId primary key value
		 * @param QMetaControlCreateType $intCreateType rules governing Tracks object creation - defaults to CreateOrEdit
 		 * @return TracksMetaControl
		 */
		public static function Create($objParentObject, $intId = null, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			// Attempt to Load from PK Arguments
			if (strlen($intId)) {
				$objTracks = Tracks::Load($intId);

				// Tracks was found -- return it!
				if ($objTracks)
					return new TracksMetaControl($objParentObject, $objTracks);

				// If CreateOnRecordNotFound not specified, throw an exception
				else if ($intCreateType != QMetaControlCreateType::CreateOnRecordNotFound)
					throw new QCallerException('Could not find a Tracks object with PK arguments: ' . $intId);

			// If EditOnly is specified, throw an exception
			} else if ($intCreateType == QMetaControlCreateType::EditOnly)
				throw new QCallerException('No PK arguments specified');

			// If we are here, then we need to create a new record
			return new TracksMetaControl($objParentObject, new Tracks());
		}

		/**
		 * Static Helper Method to Create using PathInfo arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this TracksMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing Tracks object creation - defaults to CreateOrEdit
		 * @return TracksMetaControl
		 */
		public static function CreateFromPathInfo($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::PathInfo(0);
			return TracksMetaControl::Create($objParentObject, $intId, $intCreateType);
		}

		/**
		 * Static Helper Method to Create using QueryString arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this TracksMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing Tracks object creation - defaults to CreateOrEdit
		 * @return TracksMetaControl
		 */
		public static function CreateFromQueryString($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::QueryString('intId');
			return TracksMetaControl::Create($objParentObject, $intId, $intCreateType);
		}



		///////////////////////////////////////////////
		// PUBLIC CREATE and REFRESH METHODS
		///////////////////////////////////////////////

		/**
		 * Create and setup QLabel lblId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblId_Create($strControlId = null) {
			$this->lblId = new QLabel($this->objParentObject, $strControlId);
			$this->lblId->Name = QApplication::Translate('Id');
			if ($this->blnEditMode)
				$this->lblId->Text = $this->objTracks->Id;
			else
				$this->lblId->Text = 'N/A';
			return $this->lblId;
		}

		/**
		 * Create and setup QIntegerTextBox txtRoomId
		 * @param string $strControlId optional ControlId to use
		 * @return QIntegerTextBox
		 */
		public function txtRoomId_Create($strControlId = null) {
			$this->txtRoomId = new QIntegerTextBox($this->objParentObject, $strControlId);
			$this->txtRoomId->Name = QApplication::Translate('Room Id');
			$this->txtRoomId->Text = $this->objTracks->RoomId;
			$this->txtRoomId->Required = true;
			return $this->txtRoomId;
		}

		/**
		 * Create and setup QLabel lblRoomId
		 * @param string $strControlId optional ControlId to use
		 * @param string $strFormat optional sprintf format to use
		 * @return QLabel
		 */
		public function lblRoomId_Create($strControlId = null, $strFormat = null) {
			$this->lblRoomId = new QLabel($this->objParentObject, $strControlId);
			$this->lblRoomId->Name = QApplication::Translate('Room Id');
			$this->lblRoomId->Text = $this->objTracks->RoomId;
			$this->lblRoomId->Required = true;
			$this->lblRoomId->Format = $strFormat;
			return $this->lblRoomId;
		}

		/**
		 * Create and setup QIntegerTextBox txtUserId
		 * @param string $strControlId optional ControlId to use
		 * @return QIntegerTextBox
		 */
		public function txtUserId_Create($strControlId = null) {
			$this->txtUserId = new QIntegerTextBox($this->objParentObject, $strControlId);
			$this->txtUserId->Name = QApplication::Translate('User Id');
			$this->txtUserId->Text = $this->objTracks->UserId;
			$this->txtUserId->Required = true;
			return $this->txtUserId;
		}

		/**
		 * Create and setup QLabel lblUserId
		 * @param string $strControlId optional ControlId to use
		 * @param string $strFormat optional sprintf format to use
		 * @return QLabel
		 */
		public function lblUserId_Create($strControlId = null, $strFormat = null) {
			$this->lblUserId = new QLabel($this->objParentObject, $strControlId);
			$this->lblUserId->Name = QApplication::Translate('User Id');
			$this->lblUserId->Text = $this->objTracks->UserId;
			$this->lblUserId->Required = true;
			$this->lblUserId->Format = $strFormat;
			return $this->lblUserId;
		}

		/**
		 * Create and setup QIntegerTextBox txtTrackNumber
		 * @param string $strControlId optional ControlId to use
		 * @return QIntegerTextBox
		 */
		public function txtTrackNumber_Create($strControlId = null) {
			$this->txtTrackNumber = new QIntegerTextBox($this->objParentObject, $strControlId);
			$this->txtTrackNumber->Name = QApplication::Translate('Track Number');
			$this->txtTrackNumber->Text = $this->objTracks->TrackNumber;
			$this->txtTrackNumber->Required = true;
			return $this->txtTrackNumber;
		}

		/**
		 * Create and setup QLabel lblTrackNumber
		 * @param string $strControlId optional ControlId to use
		 * @param string $strFormat optional sprintf format to use
		 * @return QLabel
		 */
		public function lblTrackNumber_Create($strControlId = null, $strFormat = null) {
			$this->lblTrackNumber = new QLabel($this->objParentObject, $strControlId);
			$this->lblTrackNumber->Name = QApplication::Translate('Track Number');
			$this->lblTrackNumber->Text = $this->objTracks->TrackNumber;
			$this->lblTrackNumber->Required = true;
			$this->lblTrackNumber->Format = $strFormat;
			return $this->lblTrackNumber;
		}



		/**
		 * Refresh this MetaControl with Data from the local Tracks object.
		 * @param boolean $blnReload reload Tracks from the database
		 * @return void
		 */
		public function Refresh($blnReload = false) {
			if ($blnReload)
				$this->objTracks->Reload();

			if ($this->lblId) if ($this->blnEditMode) $this->lblId->Text = $this->objTracks->Id;

			if ($this->txtRoomId) $this->txtRoomId->Text = $this->objTracks->RoomId;
			if ($this->lblRoomId) $this->lblRoomId->Text = $this->objTracks->RoomId;

			if ($this->txtUserId) $this->txtUserId->Text = $this->objTracks->UserId;
			if ($this->lblUserId) $this->lblUserId->Text = $this->objTracks->UserId;

			if ($this->txtTrackNumber) $this->txtTrackNumber->Text = $this->objTracks->TrackNumber;
			if ($this->lblTrackNumber) $this->lblTrackNumber->Text = $this->objTracks->TrackNumber;

		}



		///////////////////////////////////////////////
		// PROTECTED UPDATE METHODS for ManyToManyReferences (if any)
		///////////////////////////////////////////////





		///////////////////////////////////////////////
		// PUBLIC TRACKS OBJECT MANIPULATORS
		///////////////////////////////////////////////

		/**
		 * This will save this object's Tracks instance,
		 * updating only the fields which have had a control created for it.
		 */
		public function SaveTracks() {
			try {
				// Update any fields for controls that have been created
				if ($this->txtRoomId) $this->objTracks->RoomId = $this->txtRoomId->Text;
				if ($this->txtUserId) $this->objTracks->UserId = $this->txtUserId->Text;
				if ($this->txtTrackNumber) $this->objTracks->TrackNumber = $this->txtTrackNumber->Text;

				// Update any UniqueReverseReferences (if any) for controls that have been created for it

				// Save the Tracks object
				$this->objTracks->Save();

				// Finally, update any ManyToManyReferences (if any)
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * This will DELETE this object's Tracks instance from the database.
		 * It will also unassociate itself from any ManyToManyReferences.
		 */
		public function DeleteTracks() {
			$this->objTracks->Delete();
		}



		///////////////////////////////////////////////
		// PUBLIC GETTERS and SETTERS
		///////////////////////////////////////////////

		/**
		 * Override method to perform a property "Get"
		 * This will get the value of $strName
		 *
		 * @param string $strName Name of the property to get
		 * @return mixed
		 */
		public function __get($strName) {
			switch ($strName) {
				// General MetaControlVariables
				case 'Tracks': return $this->objTracks;
				case 'TitleVerb': return $this->strTitleVerb;
				case 'EditMode': return $this->blnEditMode;

				// Controls that point to Tracks fields -- will be created dynamically if not yet created
				case 'IdControl':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'IdLabel':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'RoomIdControl':
					if (!$this->txtRoomId) return $this->txtRoomId_Create();
					return $this->txtRoomId;
				case 'RoomIdLabel':
					if (!$this->lblRoomId) return $this->lblRoomId_Create();
					return $this->lblRoomId;
				case 'UserIdControl':
					if (!$this->txtUserId) return $this->txtUserId_Create();
					return $this->txtUserId;
				case 'UserIdLabel':
					if (!$this->lblUserId) return $this->lblUserId_Create();
					return $this->lblUserId;
				case 'TrackNumberControl':
					if (!$this->txtTrackNumber) return $this->txtTrackNumber_Create();
					return $this->txtTrackNumber;
				case 'TrackNumberLabel':
					if (!$this->lblTrackNumber) return $this->lblTrackNumber_Create();
					return $this->lblTrackNumber;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/**
		 * Override method to perform a property "Set"
		 * This will set the property $strName to be $mixValue
		 *
		 * @param string $strName Name of the property to set
		 * @param string $mixValue New value of the property
		 * @return mixed
		 */
		public function __set($strName, $mixValue) {
			try {
				switch ($strName) {
					// Controls that point to Tracks fields
					case 'IdControl':
						return ($this->lblId = QType::Cast($mixValue, 'QControl'));
					case 'RoomIdControl':
						return ($this->txtRoomId = QType::Cast($mixValue, 'QControl'));
					case 'UserIdControl':
						return ($this->txtUserId = QType::Cast($mixValue, 'QControl'));
					case 'TrackNumberControl':
						return ($this->txtTrackNumber = QType::Cast($mixValue, 'QControl'));
					default:
						return parent::__set($strName, $mixValue);
				}
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
	}
?>