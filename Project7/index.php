<?php
	// Search box	
	
	// ----------------

	include("libs/bootstrap.php");
	session_start();
	$xpt = new XTemplate('views/layout.html');
	$m = 0;
	$a = 0;
	$url = $baseUrl;
	if(isset($_GET['m'])) {
		$m = $_GET['m'];
		$a = $_GET['a']; 
	}
	if(file_exists("sites/{$m}/{$a}.php")){
		$url.= '/?m='.$_GET['m'].'&a='.$_GET['a'];
		include("sites/{$m}/{$a}.php");		
		// echo $url;
	}else{
		if($m==0 && $a==0){
			include("sites/home/home.php");
		}

	}

// ----------------------------------  Login status ------------------------------------------------
	$login_status = '';
	$my_account = '#modal';
	$my_account_page = '#';
	$modal = 'modal';
	$session_id = '';
	$user_id ='';
	if(isset($_SESSION['id'])) {
		$my_account = '';
		$login_status = '( Log out )';
		$my_account_page = $baseUrl."/?m=myaccount&a=myaccount";
		$modal = '';
		$user_id = $_SESSION['id'];
		$xpt -> assign('user_id',$user_id);
	}
//------------------------------------Log Out ------------------------------------------------

	if(isset($_POST['logOut'])){
		$function->destroy_Session();
	}

//---------------------------------- cart_stt ------------------------------------------------
if(isset($_SESSION['id'])){
		$sql = 'SELECT tbl_products.name,tbl_orderitem.quantity,tbl_products.price FROM tbl_orderitem inner join tbl_orders on tbl_orderitem.order_id = tbl_orders.id inner join tbl_products on tbl_orderitem.prd_id = tbl_products.id where tbl_orders.usr_id = '.$_SESSION['id'].' and stt = 0';
		
		$rs = $db-> fetchAll($sql);
		$cart_stt = 0;
		foreach ($rs as $row) {
			$cart_stt += $row['quantity'];
		}
		$xpt->assign('cart_stt',$cart_stt);
		}	

	$xpt->assign('modal',$modal);
	$xpt->assign('my_account_page',$my_account_page);
	$xpt->assign('my_account',$my_account);
	$xpt->assign('login_status',$login_status);
	$xpt->assign('baseUrl',$baseUrl);	
	$xpt->assign('acontent',$acontent);
	$xpt->parse('LAYOUT');
	$xpt->out('LAYOUT');



	