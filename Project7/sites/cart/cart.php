<?php
	$xp  = new XTemplate('views/cart/cart.html');
	
	if(isset($_SESSION['id'])){
		$sql = 'SELECT tbl_products.name,tbl_orderitem.quantity,tbl_orderitem.id,tbl_products.price,tbl_products.image1 FROM tbl_orderitem inner join tbl_orders on tbl_orderitem.order_id = tbl_orders.id inner join tbl_products on tbl_orderitem.prd_id = tbl_products.id where tbl_orders.usr_id = "'.$_SESSION['id'].'" and tbl_orders.stt = 0 ';
		$rs = $db-> fetchAll($sql);
		if(count($rs) == 0){
			$xp->assign('baseUrl',$baseUrl);
			$xp->parse('EMPTYCART');
			$acontent = $xp->text('EMPTYCART');
		}
		else{
			$i = 0;
			foreach ($rs as $row) {
				$i++;
				$row['i'] = $i;
				$xp->insert_loop('CART.LIST',array('LIST' => $row));
			}		
			$sql = 'select * from tbl_orders where usr_id = '.$_SESSION['id'].' and stt = 0';
			$order = $db -> fetchOne($sql);
			// echo $order['id'];
			$sql = 'select * from vw_ordermanage_admin where id = '.$order['id'];
			$total_cost = $db->fetchOne($sql);
			// echo $total_cost['total_cost'];

			$xp -> assign('total_cost',$total_cost['total_cost']);
			$xp->assign('baseUrl',$baseUrl);
			$xp->parse('CART');
			$acontent = $xp->text('CART');
		}
		
	
		// //-------------------- CART HANDLE -----------------------
		// if(isset($_POST['qty'])) {
		// 	 $sql = 'update tbl_orderitem set quantity = '.$_POST['qty'].' where id = '.$_POST['orderItemId'].' where id = '.$_POST['orderItemId'];
			
		// 	 $db -> execSQL($sql);
		// }
	}
	else {
			$xp->assign('baseUrl',$baseUrl);
			$xp->parse('EMPTYCART');
			$acontent = $xp->text('EMPTYCART');
		}


	
	
	
	