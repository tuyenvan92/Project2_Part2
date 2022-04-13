<?php
	$xp  = new XTemplate('views/home/home.html');
	//$sql 	= "SELECT * FROM users WHERE 1=1";
	//$rs 	= $db->fetchAll($sql);	
	//print_r($rs);
//	$i = 1;
//	foreach($rs as $row){
//		$row['Nbr'] = $i;
//		$xp->insert_loop('LIST.LS',array('LS'=>$row));
//		$i++;
//	}
	
	
	$xp->parse('HOME');
	$acontent = $xp->text('HOME');
	
	