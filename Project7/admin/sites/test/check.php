<?php
	require('../libs/session.php');

	$site = 'PAGECHECK';
	$xpt = new XTemplate('views/test/check.html');

	$xpt->parse($site);
	$admin_content = $xpt->text($site);
?>
