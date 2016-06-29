<?php
	// ClassPaths for the Newsletter class
		QApplicationBase::$ClassFile['newsletter'] = __MODEL__ . '/Newsletter.class.php';
		QApplicationBase::$ClassFile['qqnodenewsletter'] = __MODEL__ . '/Newsletter.class.php';
		QApplicationBase::$ClassFile['qqreversereferencenodenewsletter'] = __MODEL__ . '/Newsletter.class.php';
		QApplicationBase::$ClassFile['newslettermetacontrol'] = __META_CONTROLS__ . '/NewsletterMetaControl.class.php';
		QApplicationBase::$ClassFile['newsletterdatagrid'] = __META_CONTROLS__ . '/NewsletterDataGrid.class.php';

	// ClassPaths for the SamplesData class
		QApplicationBase::$ClassFile['samplesdata'] = __MODEL__ . '/SamplesData.class.php';
		QApplicationBase::$ClassFile['qqnodesamplesdata'] = __MODEL__ . '/SamplesData.class.php';
		QApplicationBase::$ClassFile['qqreversereferencenodesamplesdata'] = __MODEL__ . '/SamplesData.class.php';
		QApplicationBase::$ClassFile['samplesdatametacontrol'] = __META_CONTROLS__ . '/SamplesDataMetaControl.class.php';
		QApplicationBase::$ClassFile['samplesdatadatagrid'] = __META_CONTROLS__ . '/SamplesDataDataGrid.class.php';

?>