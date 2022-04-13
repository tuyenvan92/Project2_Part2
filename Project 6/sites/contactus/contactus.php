<?php
	$xp  = new XTemplate('views/contactus/contactus.html');

	$query = "SELECT * FROM tbl_siteinf";
	$result = $db->fetchAll($query);
	foreach ($result as $row)
	{
		$xp->assign('mail', $row['mail']);
		$xp->assign('phone', $row['phone']);
		$xp->assign('phone_international', $row['phone_international']);
	}
	
	$xp->parse('CONTACTUS');
	$acontent = $xp->text('CONTACTUS');
?>