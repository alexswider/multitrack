<?php
	/**
	 * This is a MetaControl class, providing a QForm or QPanel access to event handlers
	 * and QControls to perform the Create, Edit, and Delete functionality
	 * of the Rooms class.  This code-generated class
	 * contains all the basic elements to help a QPanel or QForm display an HTML form that can
	 * manipulate a single Rooms object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QForm or QPanel which instantiates a RoomsMetaControl
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent
	 * code re-generation.
	 *
	 * @package My QCubed Application
	 * @subpackage MetaControls
	 * @property-read Rooms $Rooms the actual Rooms data class being edited
	 * @property QLabel $IdControl
	 * @property-read QLabel $IdLabel
	 * @property QIntegerTextBox $HostIDControl
	 * @property-read QLabel $HostIDLabel
	 * @property QIntegerTextBox $UnlockedTracksControl
	 * @property-read QLabel $UnlockedTracksLabel
	 * @property QLabel $CreatedTimeControl
	 * @property-read QLabel $CreatedTimeLabel
	 * @property QTextBox $UrkControl
	 * @property-read QLabel $UrkLabel
	 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
	 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
	 */

	class RoomsMetaControlGen extends QBaseClass {
		// General Variables
		/**
		 * @var Rooms objRooms
		 * @access protected
		 */
		protected $objRooms;
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

		// Controls that allow the editing of Rooms's individual data fields
		/**
		 * @var QLabel lblId
		 * @access protected
		 */
		protected $lblId;
		/**
		 * @var QIntegerTextBox txtHostID
		 * @access protected
		 */
		protected $txtHostID;
		/**
		 * @var QIntegerTextBox txtUnlockedTracks
		 * @access protected
		 */
		protected $txtUnlockedTracks;
		/**
		 * @var QLabel lblCreatedTime
		 * @access protected
		 */
		protected $lblCreatedTime;
		/**
		 * @var QTextBox txtUrk
		 * @access protected
		 */
		protected $txtUrk;

		// Controls that allow the viewing of Rooms's individual data fields
		/**
		 * @var QLabel lblHostID
		 * @access protected
		 */
		protected $lblHostID;
		/**
		 * @var QLabel lblUnlockedTracks
		 * @access protected
		 */
		protected $lblUnlockedTracks;
		/**
		 * @var QLabel lblUrk
		 * @access protected
		 */
		protected $lblUrk;

		// QListBox Controls (if applicable) to edit Unique ReverseReferences and ManyToMany References

		// QLabel Controls (if applicable) to view Unique ReverseReferences and ManyToMany References


		/**
		 * Main constructor.  Constructor OR static create methods are designed to be called in either
		 * a parent QPanel or the main QForm when wanting to create a
		 * RoomsMetaControl to edit a single Rooms object within the
		 * QPanel or QForm.
		 *
		 * This constructor takes in a single Rooms object, while any of the static
		 * create methods below can be used to construct based off of individual PK ID(s).
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this RoomsMetaControl
		 * @param Rooms $objRooms new or existing Rooms object
		 */
		 public function __construct($objParentObject, Rooms $objRooms) {
			// Setup Parent Object (e.g. QForm or QPanel which will be using this RoomsMetaControl)
			$this->objParentObject = $objParentObject;

			// Setup linked Rooms object
			$this->objRooms = $objRooms;

			// Figure out if we're Editing or Creating New
			if ($this->objRooms->__Restored) {
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
		 * @param mixed $objParentObject QForm or QPanel which will be using this RoomsMetaControl
		 * @param integer $intId primary key value
		 * @param QMetaControlCreateType $intCreateType rules governing Rooms object creation - defaults to CreateOrEdit
 		 * @return RoomsMetaControl
		 */
		public static function Create($objParentObject, $intId = null, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			// Attempt to Load from PK Arguments
			if (strlen($intId)) {
				$objRooms = Rooms::Load($intId);

				// Rooms was found -- return it!
				if ($objRooms)
					return new RoomsMetaControl($objParentObject, $objRooms);

				// If CreateOnRecordNotFound not specified, throw an exception
				else if ($intCreateType != QMetaControlCreateType::CreateOnRecordNotFound)
					throw new QCallerException('Could not find a Rooms object with PK arguments: ' . $intId);

			// If EditOnly is specified, throw an exception
			} else if ($intCreateType == QMetaControlCreateType::EditOnly)
				throw new QCallerException('No PK arguments specified');

			// If we are here, then we need to create a new record
			return new RoomsMetaControl($objParentObject, new Rooms());
		}

		/**
		 * Static Helper Method to Create using PathInfo arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this RoomsMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing Rooms object creation - defaults to CreateOrEdit
		 * @return RoomsMetaControl
		 */
		public static function CreateFromPathInfo($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::PathInfo(0);
			return RoomsMetaControl::Create($objParentObject, $intId, $intCreateType);
		}

		/**
		 * Static Helper Method to Create using QueryString arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this RoomsMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing Rooms object creation - defaults to CreateOrEdit
		 * @return RoomsMetaControl
		 */
		public static function CreateFromQueryString($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::QueryString('intId');
			return RoomsMetaControl::Create($objParentObject, $intId, $intCreateType);
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
				$this->lblId->Text = $this->objRooms->Id;
			else
				$this->lblId->Text = 'N/A';
			return $this->lblId;
		}

		/**
		 * Create and setup QIntegerTextBox txtHostID
		 * @param string $strControlId optional ControlId to use
		 * @return QIntegerTextBox
		 */
		public function txtHostID_Create($strControlId = null) {
			$this->txtHostID = new QIntegerTextBox($this->objParentObject, $strControlId);
			$this->txtHostID->Name = QApplication::Translate('Host I D');
			$this->txtHostID->Text = $this->objRooms->HostID;
			$this->txtHostID->Required = true;
			return $this->txtHostID;
		}

		/**
		 * Create and setup QLabel lblHostID
		 * @param string $strControlId optional ControlId to use
		 * @param string $strFormat optional sprintf format to use
		 * @return QLabel
		 */
		public function lblHostID_Create($strControlId = null, $strFormat = null) {
			$this->lblHostID = new QLabel($this->objParentObject, $strControlId);
			$this->lblHostID->Name = QApplication::Translate('Host I D');
			$this->lblHostID->Text = $this->objRooms->HostID;
			$this->lblHostID->Required = true;
			$this->lblHostID->Format = $strFormat;
			return $this->lblHostID;
		}

		/**
		 * Create and setup QIntegerTextBox txtUnlockedTracks
		 * @param string $strControlId optional ControlId to use
		 * @return QIntegerTextBox
		 */
		public function txtUnlockedTracks_Create($strControlId = null) {
			$this->txtUnlockedTracks = new QIntegerTextBox($this->objParentObject, $strControlId);
			$this->txtUnlockedTracks->Name = QApplication::Translate('Unlocked Tracks');
			$this->txtUnlockedTracks->Text = $this->objRooms->UnlockedTracks;
			$this->txtUnlockedTracks->Required = true;
			return $this->txtUnlockedTracks;
		}

		/**
		 * Create and setup QLabel lblUnlockedTracks
		 * @param string $strControlId optional ControlId to use
		 * @param string $strFormat optional sprintf format to use
		 * @return QLabel
		 */
		public function lblUnlockedTracks_Create($strControlId = null, $strFormat = null) {
			$this->lblUnlockedTracks = new QLabel($this->objParentObject, $strControlId);
			$this->lblUnlockedTracks->Name = QApplication::Translate('Unlocked Tracks');
			$this->lblUnlockedTracks->Text = $this->objRooms->UnlockedTracks;
			$this->lblUnlockedTracks->Required = true;
			$this->lblUnlockedTracks->Format = $strFormat;
			return $this->lblUnlockedTracks;
		}

		/**
		 * Create and setup QLabel lblCreatedTime
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblCreatedTime_Create($strControlId = null) {
			$this->lblCreatedTime = new QLabel($this->objParentObject, $strControlId);
			$this->lblCreatedTime->Name = QApplication::Translate('Created Time');
			if ($this->blnEditMode)
				$this->lblCreatedTime->Text = $this->objRooms->CreatedTime;
			else
				$this->lblCreatedTime->Text = 'N/A';
			return $this->lblCreatedTime;
		}

		/**
		 * Create and setup QTextBox txtUrk
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtUrk_Create($strControlId = null) {
			$this->txtUrk = new QTextBox($this->objParentObject, $strControlId);
			$this->txtUrk->Name = QApplication::Translate('Urk');
			$this->txtUrk->Text = $this->objRooms->Urk;
			$this->txtUrk->Required = true;
			$this->txtUrk->MaxLength = Rooms::UrkMaxLength;
			return $this->txtUrk;
		}

		/**
		 * Create and setup QLabel lblUrk
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblUrk_Create($strControlId = null) {
			$this->lblUrk = new QLabel($this->objParentObject, $strControlId);
			$this->lblUrk->Name = QApplication::Translate('Urk');
			$this->lblUrk->Text = $this->objRooms->Urk;
			$this->lblUrk->Required = true;
			return $this->lblUrk;
		}



		/**
		 * Refresh this MetaControl with Data from the local Rooms object.
		 * @param boolean $blnReload reload Rooms from the database
		 * @return void
		 */
		public function Refresh($blnReload = false) {
			if ($blnReload)
				$this->objRooms->Reload();

			if ($this->lblId) if ($this->blnEditMode) $this->lblId->Text = $this->objRooms->Id;

			if ($this->txtHostID) $this->txtHostID->Text = $this->objRooms->HostID;
			if ($this->lblHostID) $this->lblHostID->Text = $this->objRooms->HostID;

			if ($this->txtUnlockedTracks) $this->txtUnlockedTracks->Text = $this->objRooms->UnlockedTracks;
			if ($this->lblUnlockedTracks) $this->lblUnlockedTracks->Text = $this->objRooms->UnlockedTracks;

			if ($this->lblCreatedTime) if ($this->blnEditMode) $this->lblCreatedTime->Text = $this->objRooms->CreatedTime;

			if ($this->txtUrk) $this->txtUrk->Text = $this->objRooms->Urk;
			if ($this->lblUrk) $this->lblUrk->Text = $this->objRooms->Urk;

		}



		///////////////////////////////////////////////
		// PROTECTED UPDATE METHODS for ManyToManyReferences (if any)
		///////////////////////////////////////////////





		///////////////////////////////////////////////
		// PUBLIC ROOMS OBJECT MANIPULATORS
		///////////////////////////////////////////////

		/**
		 * This will save this object's Rooms instance,
		 * updating only the fields which have had a control created for it.
		 */
		public function SaveRooms() {
			try {
				// Update any fields for controls that have been created
				if ($this->txtHostID) $this->objRooms->HostID = $this->txtHostID->Text;
				if ($this->txtUnlockedTracks) $this->objRooms->UnlockedTracks = $this->txtUnlockedTracks->Text;
				if ($this->txtUrk) $this->objRooms->Urk = $this->txtUrk->Text;

				// Update any UniqueReverseReferences (if any) for controls that have been created for it

				// Save the Rooms object
				$this->objRooms->Save();

				// Finally, update any ManyToManyReferences (if any)
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * This will DELETE this object's Rooms instance from the database.
		 * It will also unassociate itself from any ManyToManyReferences.
		 */
		public function DeleteRooms() {
			$this->objRooms->Delete();
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
				case 'Rooms': return $this->objRooms;
				case 'TitleVerb': return $this->strTitleVerb;
				case 'EditMode': return $this->blnEditMode;

				// Controls that point to Rooms fields -- will be created dynamically if not yet created
				case 'IdControl':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'IdLabel':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'HostIDControl':
					if (!$this->txtHostID) return $this->txtHostID_Create();
					return $this->txtHostID;
				case 'HostIDLabel':
					if (!$this->lblHostID) return $this->lblHostID_Create();
					return $this->lblHostID;
				case 'UnlockedTracksControl':
					if (!$this->txtUnlockedTracks) return $this->txtUnlockedTracks_Create();
					return $this->txtUnlockedTracks;
				case 'UnlockedTracksLabel':
					if (!$this->lblUnlockedTracks) return $this->lblUnlockedTracks_Create();
					return $this->lblUnlockedTracks;
				case 'CreatedTimeControl':
					if (!$this->lblCreatedTime) return $this->lblCreatedTime_Create();
					return $this->lblCreatedTime;
				case 'CreatedTimeLabel':
					if (!$this->lblCreatedTime) return $this->lblCreatedTime_Create();
					return $this->lblCreatedTime;
				case 'UrkControl':
					if (!$this->txtUrk) return $this->txtUrk_Create();
					return $this->txtUrk;
				case 'UrkLabel':
					if (!$this->lblUrk) return $this->lblUrk_Create();
					return $this->lblUrk;
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
					// Controls that point to Rooms fields
					case 'IdControl':
						return ($this->lblId = QType::Cast($mixValue, 'QControl'));
					case 'HostIDControl':
						return ($this->txtHostID = QType::Cast($mixValue, 'QControl'));
					case 'UnlockedTracksControl':
						return ($this->txtUnlockedTracks = QType::Cast($mixValue, 'QControl'));
					case 'CreatedTimeControl':
						return ($this->lblCreatedTime = QType::Cast($mixValue, 'QControl'));
					case 'UrkControl':
						return ($this->txtUrk = QType::Cast($mixValue, 'QControl'));
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