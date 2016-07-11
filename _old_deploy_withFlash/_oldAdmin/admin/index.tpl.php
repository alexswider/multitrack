<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php _p(QApplication::$EncodingType); ?>" />
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php _p(__VIRTUAL_DIRECTORY__ . __CSS__); ?>/styles.css"/>
</head><body>
<div id="menubar1">&nbsp;</div>
	<div id="accessform">
	<br />
	<?php $this->RenderBegin(); ?>
		<?php 
			$this->txtLogin->RenderWithName();
			$this->txtPass->RenderWithName();
			$this->btnButton->RenderWithName(); 
		?>
	<?php $this->RenderEnd(); ?>
	</div>
</body></html>
