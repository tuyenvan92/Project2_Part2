<?php
	error_reporting(0); 
	$xp  = new XTemplate('views/category/contact.html');
	
	$condition = '1=1';
	
	$sql 	= "SELECT * FROM tbl_products 
	 			WHERE {$condition}
	 			ORDER BY ID DESC";
				 // echo $sql;
				 
	 $rs 	= $db->fetchAll($sql);
	 
	 foreach($rs as $row){
			
		$xp->insert_loop('CONTACT.LIST_PD',array('LIST_PD'=>$row));
		
	 }
	$xp->parse('CONTACT');
	$acontent = $xp->text('CONTACT');
	
	// $xp->parse('CONTACT');
	// $acontent = $xp->text('CONTACT');
	
	