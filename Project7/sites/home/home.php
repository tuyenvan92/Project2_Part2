<?php
	$xp  = new XTemplate('views/home/home.html');

	$sql = 'select * from tbl_products order by rand() LIMIT 4';
	$rs = $db->fetchAll($sql);
	
	foreach ($rs as $row ) {
		$xp->insert_loop('HOME.LIST',array('LIST'=>$row));
	}
	
	$xp->parse('HOME');
	$acontent = $xp->text('HOME');
	
	