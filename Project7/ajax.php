<?php
	


include("libs/bootstrap.php");

// ----------------------------------List search-------------------------------------------------

		

	if(isset($_POST['search'])) {

		if($_POST['search'] != '') {
			$sql = 'select * from tbl_products where name like "%'.$_POST['search'].'%"';
			$row = $db -> fetchAll($sql);
			
			foreach ($row as $key) {
				# code...
				?>
				<link rel='stylesheet' src='css/layout.css'/>
				<a href='?m=product&a=product1&p=<?php echo $key['name'] ?>' class='list-search' >
					<img style='width: 30px;height: 20px;' src = "<?php echo $key['image1']; ?>" id = "pic"/>
					<span style=''><?php echo '&nbsp;&nbsp;&nbsp;'.$key['name']; ?></span>
					<hr/>
				</a>
					

				


				<?php
			}
		}
	}

//-----------------------------------SignUP --------------------------------------------------------
	
	if(isset($_POST['sgpEmail'])){
		
		$sgpEmail = $_POST['sgpEmail'];
		$sgpName = $_POST['sgpName'];
		$sgpPsd = $_POST['sgpPsd'];
		$cfPsd = $_POST['cfPsd'];
		$country = $_POST['country'];
		$city = $_POST['city'];
		$address = $_POST['address'];
		$phone_number = $_POST['phoneNumber'];

//------------------ validate form signup ---------------------
		if($sgpEmail == ''|| $sgpName == ''){
			echo 'Name and Email are required.';
		}
		else if(!$function->valid_email($sgpEmail)){
			echo "Email is not a valid email address.";
		}
		else if($sgpPsd == '') {
			echo 'The password can\'t be empty.';
		}
		else if(strlen($sgpPsd)<6) {
			echo "The minimum password length is 6. ";
		}
		else if($cfPsd != $sgpPsd){
			echo "The confirm password is not match.";
		} else if($country == '') {
			echo "The country must be selected.";
		} else if($city == '' || $address == '' || $phone_number ==''){
			echo "The City, Address and Phone Number can't be empty.";
		}
		else 
		{
			$sql = 'select * from tbl_users where mail = "'.$sgpEmail.'"';
			$row = $db->fetchAll($sql);
			if(count($row)==1) {
				echo "Email address already be used.";
			}
			else {
				$sql = 'insert into tbl_users(mail,pw,full_name,country,city,address,user_type) values("'.$sgpEmail.'","'.md5($sgpPsd).'","'.$sgpName.'","'.$country.'","'.$city.'","'.$address.'",3)';

				
				$db->execSQL($sql);
				$db->login($sgpEmail,$sgpPsd);
			}

		}
	}	

//-------------------------------------------------------LOGIN -----------------------------------------------------
	if(isset($_POST['lgnEmail'])) {
		$lgnEmail = $_POST['lgnEmail'];
		$lgnPsd = $_POST['lgnPsd'];

		if($lgnEmail == '' || $lgnPsd == ''){
			echo "Email and Password are required.";

		}
			else {
				if($db ->login($lgnEmail,$lgnPsd)){
					
				}
			}
		}
		
//--------------------------------------- Add to cart ---------------------------------------------
		if(isset($_POST['add_to_cart'])) {
	 
		 	if($_POST['user_id'] != '') {
		 		$sql = 'select * from tbl_orders where usr_id = '.$_POST['user_id'].' and stt = 0';
		 		// echo $sql;
		 		$rs = $db->fetchAll($sql);
		 		if(count($rs) == 0) {
		 			$sql = 'insert into tbl_orders(usr_id,stt) values ('.$_POST['user_id'].',0)';
		 			echo $sql;
		 			$db-> execSQL($sql);
		 		}

		 		$sql = 'select * from tbl_orders where usr_id = '.$_POST['user_id'].' and stt = 0';
			 	$row = $db -> fetchOne($sql);
			 	$order_id = $row['id'];
			 	
			 	$sql = 'select * from tbl_orderitem where order_id = '.$order_id.' and prd_id = '.$_POST['product_id'];
			 	
			 	$rs = $db->fetchAll($sql);
			 	if(count($rs)==0) {
			 		 $sql = 'insert into tbl_orderitem(order_id,prd_id,quantity) values('.$order_id.','.$_POST['product_id'].',1)';
			 		 
			 		 $db-> execSQL($sql);
			 	} else {
			 		$sql = 'update tbl_orderitem set quantity = quantity + 1 where order_id = '.$order_id.' and prd_id = '.$_POST['product_id'];
			 		
			 		$db->execSQL($sql);

			 	}
		 	} else {

		 		$sql = 'select * from tbl_products where id = '.$_POST['product_id'];
		 		$row = $db->fetchOne($sql);
		 		// $_SESSION['product_id'] = $_POST['product_id'];
		 		// $_SESSION['product_name'] = $row['name'];
		 		// $_SESSION['qty'] = 1;
		 		// $_SESSION['price'] = $_SESSION['qty']*$row['price'];
		 		$_SESSION['cart'] = '';
		 		
		 	} 
		 	
		 }

//----------------------------------------HANDLE CART------------------------------------------------------------------
		if(isset($_POST['qty'])) {
			 $sql = 'update tbl_orderitem set quantity = '.$_POST['qty'].' where id = '.$_POST['orderItemId'].'; update tbl_orderitem set totalprice = '.$_POST['qty'].' * price where id = '.$_POST['orderItemId'];
			 echo $sql;
			
			 $db -> execSQL($sql);
		}

//------------------------------------- FILTER DATA ----------------------------------------------------------------------------------
	// 	if(isset($_POST['filter'])) {
	// 		echo $_POST['id'];
	// 		echo $_POST['filter'];
	// }		

		
?>