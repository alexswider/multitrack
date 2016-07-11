<?php
	// This is the HTML template include file (.tpl.php) for samples_dataEditPanel.
	// Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the drafts/dashboard subdirectory before modifying to ensure that subsequent
	// code re-generations do not overwrite your changes.
?>
	<div id="formControls">
		<?php $_CONTROL->lblId->RenderWithName(); ?>

		<?php $_CONTROL->txtGuid->RenderWithName(); ?>

		<?php $_CONTROL->txtUserName->RenderWithName(); ?>

		<?php $_CONTROL->lblSubmitDate->RenderWithName(); ?>

		<?php $_CONTROL->txtEmail->RenderWithName(); ?>

		<?php $_CONTROL->txtSpeakText->RenderWithName(); ?>

		<?php $_CONTROL->txtTranslation->RenderWithName(); ?>

		<?php $_CONTROL->txtNewsletter->RenderWithName(); ?>

		<?php $_CONTROL->txtScore->RenderWithName(); ?>

	</div>

	<div id="formActions">
		<div id="save"><?php $_CONTROL->btnSave->Render(); ?></div>
		<div id="cancel"><?php $_CONTROL->btnCancel->Render(); ?></div>
		<div id="delete"><?php $_CONTROL->btnDelete->Render(); ?></div>
	</div>
