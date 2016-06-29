<?php
	// ClassPaths for the Rooms class
		QApplicationBase::$ClassFile['rooms'] = __MODEL__ . '/Rooms.class.php';
		QApplicationBase::$ClassFile['qqnoderooms'] = __MODEL__ . '/Rooms.class.php';
		QApplicationBase::$ClassFile['qqreversereferencenoderooms'] = __MODEL__ . '/Rooms.class.php';
		QApplicationBase::$ClassFile['roomsmetacontrol'] = __META_CONTROLS__ . '/RoomsMetaControl.class.php';
		QApplicationBase::$ClassFile['roomsdatagrid'] = __META_CONTROLS__ . '/RoomsDataGrid.class.php';

	// ClassPaths for the Tracks class
		QApplicationBase::$ClassFile['tracks'] = __MODEL__ . '/Tracks.class.php';
		QApplicationBase::$ClassFile['qqnodetracks'] = __MODEL__ . '/Tracks.class.php';
		QApplicationBase::$ClassFile['qqreversereferencenodetracks'] = __MODEL__ . '/Tracks.class.php';
		QApplicationBase::$ClassFile['tracksmetacontrol'] = __META_CONTROLS__ . '/TracksMetaControl.class.php';
		QApplicationBase::$ClassFile['tracksdatagrid'] = __META_CONTROLS__ . '/TracksDataGrid.class.php';

	// ClassPaths for the Users class
		QApplicationBase::$ClassFile['users'] = __MODEL__ . '/Users.class.php';
		QApplicationBase::$ClassFile['qqnodeusers'] = __MODEL__ . '/Users.class.php';
		QApplicationBase::$ClassFile['qqreversereferencenodeusers'] = __MODEL__ . '/Users.class.php';
		QApplicationBase::$ClassFile['usersmetacontrol'] = __META_CONTROLS__ . '/UsersMetaControl.class.php';
		QApplicationBase::$ClassFile['usersdatagrid'] = __META_CONTROLS__ . '/UsersDataGrid.class.php';

?>