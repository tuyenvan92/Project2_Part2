<?php
	require('../libs/session.php');
	
	$site_func = '<li class="breadcrumb-item">Manage</li><li class="breadcrumb-item">Orders</li>';
	$xpt_home->assign('function', $site_func);
	
	$site = 'ORDER_LIST'; $content = 'ORDER_INFO';
	$xpt = new XTemplate('views/manage/orders.html');

	$result = $db->fetchAll("SELECT * FROM vw_ordermanage_admin WHERE 1=1");

	if (isset($_POST['filter_btn']))
	{
		$result = $db->fetchAll("SELECT * FROM vw_ordermanage_admin WHERE 1=1");
	}

	foreach ($result as $row)
	{
		$row['product'] = str_replace('(newline)', '<br>', $row['product']);
		$row['quantity'] = str_replace('(newline)', '<br>', $row['quantity']);
		$row['price'] = str_replace('(newline)', '<br>', $row['price']);
		
		htmlspecialchars($xpt->insert_loop("{$site}.{$content}", array($content => $row)));

		$item_id = $row['id'];
		if (isset($_POST["tbl_order_status_{$item_id}"]))
		{
			$stt = $_POST["tbl_order_status_{$item_id}"];
			$db->execSQL("UPDATE tbl_orders SET stt={$stt} WHERE id={$item_id}");
			$function->pageRefresh();
		}
	}

	$xpt->parse($site);
	$admin_content = $xpt->text($site);
?>
