<?php
	/**
	 * This is a MetaControl class, providing a QForm or QPanel access to event handlers
	 * and QControls to perform the Create, Edit, and Delete functionality
	 * of the Users class.  This code-generated class
	 * contains all the basic elements to help a QPanel or QForm display an HTML form that can
	 * manipulate a single Users object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QForm or QPanel which instantiates a UsersMetaControl
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent
	 * code re-generation.
	 *
	 * @package My QCubed Application
	 * @subpackage MetaControls
	 * @property-read Users $Users the actual Users data class being edited
	 * @property QLabel $IdControl
	 * @property-read QLabel $IdLabel
	 * @property QTextBox $NameControl
	 * @property-read QLabel $NameLabel
	 * @property QTextBox $FbIdControl
	 * @property-read QLabel $FbIdLabel
	 * @property QTextBox $IpControl
	 * @property-read QLabel $IpLabel
	 * @property QTextBox $AvatarControl
	 * @property-read QLabel $AvatarLabel
	 * @property QLabel $LastLoggedControl
	 * @property-read QLabel $LastLoggedLabel
	 * @property-read string $TitleVerb a verb indicating whether or not this is being edited or created
	 * @property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
	 */

	class UsersMetaControlGen extends QBaseClass {
		// General Variables
		/**
		 * @var Users objUsers
		 * @access protected
		 */
		protected $objUsers;
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

		// Controls that allow the editing of Users's individual data fields
		/**
		 * @var QLabel lblId
		 * @access protected
		 */
		protected $lblId;
		/**
		 * @var QTextBox txtName
		 * @access protected
		 */
		protected $txtName;
		/**
		 * @var QTextBox txtFbId
		 * @access protected
		 */
		protected $txtFbId;
		/**
		 * @var QTextBox txtIp
		 * @access protected
		 */
		protected $txtIp;
		/**
		 * @var QTextBox txtAvatar
		 * @access protected
		 */
		protected $txtAvatar;
		/**
		 * @var QLabel lblLastLogged
		 * @access protected
		 */
		protected $lblLastLogged;

		// Controls that allow the viewing of Users's individual data fields
		/**
		 * @var QLabel lblName
		 * @access protected
		 */
		protected $lblName;
		/**
		 * @var QLabel lblFbId
		 * @access protected
		 */
		protected $lblFbId;
		/**
		 * @var QLabel lblIp
		 * @access protected
		 */
		protected $lblIp;
		/**
		 * @var QLabel lblAvatar
		 * @access protected
		 */
		protected $lblAvatar;

		// QListBox Controls (if applicable) to edit Unique ReverseReferences and ManyToMany References

		// QLabel Controls (if applicable) to view Unique ReverseReferences and ManyToMany References


		/**
		 * Main constructor.  Constructor OR static create methods are designed to be called in either
		 * a parent QPanel or the main QForm when wanting to create a
		 * UsersMetaControl to edit a single Users object within the
		 * QPanel or QForm.
		 *
		 * This constructor takes in a single Users object, while any of the static
		 * create methods below can be used to construct based off of individual PK ID(s).
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this UsersMetaControl
		 * @param Users $objUsers new or existing Users object
		 */
		 public function __construct($objParentObject, Users $objUsers) {
			// Setup Parent Object (e.g. QForm or QPanel which will be using this UsersMetaControl)
			$this->objParentObject = $objParentObject;

			// Setup linked Users object
			$this->objUsers = $objUsers;

			// Figure out if we're Editing or Creating New
			if ($this->objUsers->__Restored) {
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
		 * @param mixed $objParentObject QForm or QPanel which will be using this UsersMetaControl
		 * @param integer $intId primary key value
		 * @param QMetaControlCreateType $intCreateType rules governing Users object creation - defaults to CreateOrEdit
 		 * @return UsersMetaControl
		 */
		public static function Create($objParentObject, $intId = null, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			// Attempt to Load from PK Arguments
			if (strlen($intId)) {
				$objUsers = Users::Load($intId);

				// Users was found -- return it!
				if ($objUsers)
					return new UsersMetaControl($objParentObject, $objUsers);

				// If CreateOnRecordNotFound not specified, throw an exception
				else if ($intCreateType != QMetaControlCreateType::CreateOnRecordNotFound)
					throw new QCallerException('Could not find a Users object with PK arguments: ' . $intId);

			// If EditOnly is specified, throw an exception
			} else if ($intCreateType == QMetaControlCreateType::EditOnly)
				throw new QCallerException('No PK arguments specified');

			// If we are here, then we need to create a new record
			return new UsersMetaControl($objParentObject, new Users());
		}

		/**
		 * Static Helper Method to Create using PathInfo arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this UsersMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing Users object creation - defaults to CreateOrEdit
		 * @return UsersMetaControl
		 */
		public static function CreateFromPathInfo($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::PathInfo(0);
			return UsersMetaControl::Create($objParentObject, $intId, $intCreateType);
		}

		/**
		 * Static Helper Method to Create using QueryString arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this UsersMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing Users object creation - defaults to CreateOrEdit
		 * @return UsersMetaControl
		 */
		public static function CreateFromQueryString($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::QueryString('intId');
			return UsersMetaControl::Create($objParentObject, $intId, $intCreateType);
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
				$this->lblId->Text = $this->objUsers->Id;
			else
				$this->lblId->Text = 'N/A';
			return $this->lblId;
		}

		/**
		 * Create and setup QTextBox txtName
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtName_Create($strControlId = null) {
			$this->txtName = new QTextBox($this->objParentObject, $strControlId);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objUsers->Name;
			$this->txtName->Required = true;
			$this->txtName->MaxLength = Users::NameMaxLength;
			return $this->txtName;
		}

		/**
		 * Create and setup QLabel lblName
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblName_Create($strControlId = null) {
			$this->lblName = new QLabel($this->objParentObject, $strControlId);
			$this->lblName->Name = QApplication::Translate('Name');
			$this->lblName->Text = $this->objUsers->Name;
			$this->lblName->Required = true;
			return $this->lblName;
		}

		/**
		 * Create and setup QTextBox txtFbId
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtFbId_Create($strControlId = null) {
			$this->txtFbId = new QTextBox($this->objParentObject, $strControlId);
			$this->txtFbId->Name = QApplication::Translate('Fb Id');
			$this->txtFbId->Text = $this->objUsers->FbId;
			$this->txtFbId->Required = true;
			$this->txtFbId->MaxLength = Users::FbIdMaxLength;
			return $this->txtFbId;
		}

		/**
		 * Create and setup QLabel lblFbId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblFbId_Create($strControlId = null) {
			$this->lblFbId = new QLabel($this->objParentObject, $strControlId);
			$this->lblFbId->Name = QApplication::Translate('Fb Id');
			$this->lblFbId->Text = $this->objUsers->FbId;
			$this->lblFbId->Required = true;
			return $this->lblFbId;
		}

		/**
		 * Create and setup QTextBox txtIp
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtIp_Create($strControlId = null) {
			$this->txtIp = new QTextBox($this->objParentObject, $strControlId);
			$this->txtIp->Name = QApplication::Translate('Ip');
			$this->txtIp->Text = $this->objUsers->Ip;
			$this->txtIp->Required = true;
			$this->txtIp->MaxLength = Users::IpMaxLength;
			return $this->txtIp;
		}

		/**
		 * Create and setup QLabel lblIp
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblIp_Create($strControlId = null) {
			$this->lblIp = new QLabel($this->objParentObject, $strControlId);
			$this->lblIp->Name = QApplication::Translate('Ip');
			$this->lblIp->Text = $this->objUsers->Ip;
			$this->lblIp->Required = true;
			return $this->lblIp;
		}

		/**
		 * Create and setup QTextBox txtAvatar
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtAvatar_Create($strControlId = null) {
			$this->txtAvatar = new QTextBox($this->objParentObject, $strControlId);
			$this->txtAvatar->Name = QApplication::Translate('Avatar');
			$this->txtAvatar->Text = $this->objUsers->Avatar;
			$this->txtAvatar->Required = true;
			$this->txtAvatar->MaxLength = Users::AvatarMaxLength;
			return $this->txtAvatar;
		}

		/**
		 * Create and setup QLabel lblAvatar
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblAvatar_Create($strControlId = null) {
			$this->lblAvatar = new QLabel($this->objParentObject, $strControlId);
			$this->lblAvatar->Name = QApplication::Translate('Avatar');
			$this->lblAvatar->Text = $this->objUsers->Avatar;
			$this->lblAvatar->Required = true;
			return $this->lblAvatar;
		}

		/**
		 * Create and setup QLabel lblLastLogged
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblLastLogged_Create($strControlId = null) {
			$this->lblLastLogged = new QLabel($this->objParentObject, $strControlId);
			$this->lblLastLogged->Name = QApplication::Translate('Last Logged');
			if ($this->blnEditMode)
				$this->lblLastLogged->Text = $this->objUsers->LastLogged;
			else
				$this->lblLastLogged->Text = 'N/A';
			return $this->lblLastLogged;
		}



		/**
		 * Refresh this MetaControl with Data from the local Users object.
		 * @param boolean $blnReload reload Users from the database
		 * @return void
		 */
		public function Refresh($blnReload = false) {
			if ($blnReload)
				$this->objUsers->Reload();

			if ($this->lblId) if ($this->blnEditMode) $this->lblId->Text = $this->objUsers->Id;

			if ($this->txtName) $this->txtName->Text = $this->objUsers->Name;
			if ($this->lblName) $this->lblName->Text = $this->objUsers->Name;

			if ($this->txtFbId) $this->txtFbId->Text = $this->objUsers->FbId;
			if ($this->lblFbId) $this->lblFbId->Text = $this->objUsers->FbId;

			if ($this->txtIp) $this->txtIp->Text = $this->objUsers->Ip;
			if ($this->lblIp) $this->lblIp->Text = $this->objUsers->Ip;

			if ($this->txtAvatar) $this->txtAvatar->Text = $this->objUsers->Avatar;
			if ($this->lblAvatar) $this->lblAvatar->Text = $this->objUsers->Avatar;

			if ($this->lblLastLogged) if ($this->blnEditMode) $this->lblLastLogged->Text = $this->objUsers->LastLogged;

		}



		///////////////////////////////////////////////
		// PROTECTED UPDATE METHODS for ManyToManyReferences (if any)
		///////////////////////////////////////////////





		///////////////////////////////////////////////
		// PUBLIC USERS OBJECT MANIPULATORS
		///////////////////////////////////////////////

		/**
		 * This will save this object's Users instance,
		 * updating only the fields which have had a control created for it.
		 */
		public function SaveUsers() {
			try {
				// Update any fields for controls that have been created
				if ($this->txtName) $this->objUsers->Name = $this->txtName->Text;
				if ($this->txtFbId) $this->objUsers->FbId = $this->txtFbId->Text;
				if ($this->txtIp) $this->objUsers->Ip = $this->txtIp->Text;
				if ($this->txtAvatar) $this->objUsers->Avatar = $this->txtAvatar->Text;

				// Update any UniqueReverseReferences (if any) for controls that have been created for it

				// Save the Users object
				$this->objUsers->Save();

				// Finally, update any ManyToManyReferences (if any)
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * This will DELETE this object's Users instance from the database.
		 * It will also unassociate itself from any ManyToManyReferences.
		 */
		public function DeleteUsers() {
			$this->objUsers->Delete();
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
				case 'Users': return $this->objUsers;
				case 'TitleVerb': return $this->strTitleVerb;
				case 'EditMode': return $this->blnEditMode;

				// Controls that point to Users fields -- will be created dynamically if not yet created
				case 'IdControl':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'IdLabel':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'NameControl':
					if (!$this->txtName) return $this->txtName_Create();
					return $this->txtName;
				case 'NameLabel':
					if (!$this->lblName) return $this->lblName_Create();
					return $this->lblName;
				case 'FbIdControl':
					if (!$this->txtFbId) return $this->txtFbId_Create();
					return $this->txtFbId;
				case 'FbIdLabel':
					if (!$this->lblFbId) return $this->lblFbId_Create();
					return $this->lblFbId;
				case 'IpControl':
					if (!$this->txtIp) return $this->txtIp_Create();
					return $this->txtIp;
				case 'IpLabel':
					if (!$this->lblIp) return $this->lblIp_Create();
					return $this->lblIp;
				case 'AvatarControl':
					if (!$this->txtAvatar) return $this->txtAvatar_Create();
					return $this->txtAvatar;
				case 'AvatarLabel':
					if (!$this->lblAvatar) return $this->lblAvatar_Create();
					return $this->lblAvatar;
				case 'LastLoggedControl':
					if (!$this->lblLastLogged) return $this->lblLastLogged_Create();
					return $this->lblLastLogged;
				case 'LastLoggedLabel':
					if (!$this->lblLastLogged) return $this->lblLastLogged_Create();
					return $this->lblLastLogged;
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
					// Controls that point to Users fields
					case 'IdControl':
						return ($this->lblId = QType::Cast($mixValue, 'QControl'));
					case 'NameControl':
						return ($this->txtName = QType::Cast($mixValue, 'QControl'));
					case 'FbIdControl':
						return ($this->txtFbId = QType::Cast($mixValue, 'QControl'));
					case 'IpControl':
						return ($this->txtIp = QType::Cast($mixValue, 'QControl'));
					case 'AvatarControl':
						return ($this->txtAvatar = QType::Cast($mixValue, 'QControl'));
					case 'LastLoggedControl':
						return ($this->lblLastLogged = QType::Cast($mixValue, 'QControl'));
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