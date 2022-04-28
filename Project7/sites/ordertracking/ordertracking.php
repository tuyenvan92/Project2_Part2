<?php
	$xp  = new XTemplate('views/ordertracking/ordertracking.html');
	//$sql 	= "SELECT * FROM users WHERE 1=1";
	//$rs 	= $db->fetchAll($sql);	
	//print_r($rs);
//	$i = 1;
//	foreach($rs as $row){
//		$row['Nbr'] = $i;
//		$xp->insert_loop('LIST.LS',array('LS'=>$row));
//		$i++;
//	}
	
	
	$xp->parse('ORDERTRACKING');
	$acontent = $xp->text('ORDERTRACKING');
	
	