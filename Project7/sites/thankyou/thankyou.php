<?php
	$xp  = new XTemplate('views/thankyou/thankyou.html');

	if(isset($_SESSION['id'])){
	if(isset($_GET['acceptorder'])) {
		if($_GET['acceptorder'] == 'true'){
			$sql = 'update tbl_orders set stt = 1 where usr_id = '.$_SESSION['id'].' and stt = 0';
			
			$db-> execSQL($sql);
			}
		}
	}

	
	
	$xp->parse('THANKYOU');
	$acontent = $xp->text('THANKYOU');