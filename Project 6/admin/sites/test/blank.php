<?php
	require('../libs/session.php');

	$site = 'BLANK';
	$xpt = new XTemplate('views/test/blank.html');

	$xpt->parse($site);
	$admin_content = $xpt->text($site);
?>
