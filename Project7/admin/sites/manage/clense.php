<?php
	require('../libs/session.php');

	$site_func = '<li class="breadcrumb-item">Manage</li><li class="breadcrumb-item">Contact Lenses</li>';
	$xpt_home->assign('function', $site_func);
	
	$site = 'CL_LIST'; $content = 'CL_INFO';
	$xpt = new XTemplate('views/manage/contact_lense.html');
	// ==========================================================
	$condition = "1";
	$query = "SELECT * FROM tbl_contact_lense WHERE {$condition}";
	$result = $db->fetchAll($query);

	foreach ($result as $row)
	{
		htmlspecialchars($xpt->insert_loop("{$site}.{$content}", array($content => $row)));
	}
	// ==========================================================
	if (isset($_POST['cl_delete']))
	{
		$condition = "id='{$_GET['itemid']}'";
		$db->tblUpdate_DeleteItem('tbl_contact_lense', $condition);

		$function->redir("{$baseUrl}/admin/?mod=manage&act=clense");
	}
	// ==========================================================
	if (isset($_POST['cl_edit_save']))
	{
		$condition = "id='{$_GET['itemid']}'";
		$product = array();

		if (strlen($_POST['cl_edit_name']))
			$product = array_merge($product, array('name' => $_POST['cl_edit_name']));
		if (strlen($_POST['cl_edit_manf']))
			$product = array_merge($product, array('manufacturer' => $_POST['cl_edit_manf']));
		if (strlen($_POST['cl_edit_brand']))
			$product = array_merge($product, array('brand' => $_POST['cl_edit_brand']));
		if (strlen($_POST['cl_edit_descr']))
			$product = array_merge($product, array('description' => $_POST['cl_edit_descr']));
		if (strlen($_POST['cl_edit_ibqty']))
			$product = array_merge($product, array('inbox_qty' => $_POST['cl_edit_ibqty']));
		if (strlen($_POST['cl_edit_price']))
			$product = array_merge($product, array('price' => $_POST['cl_edit_price']));
		if (strlen($_POST['cl_edit_type']))
			$product = array_merge($product, array('type' => $_POST['cl_edit_type']));
		if (strlen($_POST['cl_edit_img1']))
			$product = array_merge($product, array('image1' => $_POST['cl_edit_img1']));
		if (strlen($_POST['cl_edit_img2']))
			$product = array_merge($product, array('image2' => $_POST['cl_edit_img2']));
			
		if (sizeof($product)>0)
			foreach ($product as $col => $val)
			{
				$val = str_replace("'", "&apos;", $val);
				$db->tblUpdate_EditInfo('tbl_contact_lense', $col, $val, $condition);
			}
		
		$function->redir("{$baseUrl}/admin/?mod=manage&act=clense");
	}
	// ==========================================================
	if (isset($_POST['cl_add_save']))
	{
		$cols = NULL; $vals = NULL;
		$column_Arr = array(
			'name',			'manufacturer',	'brand',	'description', 
			'inbox_qty',	'price',				'type',	'image1',		'image2');
		
		$value_Arr = array(
			"{$_POST['cl_add_name']}",
			"{$_POST['cl_add_manufacturer']}",	"{$_POST['cl_add_image1']}", 
			"{$_POST['cl_add_brand']}",		"{$_POST['cl_add_image2']}", 
			"{$_POST['cl_add_price']}",
			"{$_POST['cl_add_descr']}",
			"{$_POST['cl_add_inbox_qty']}",
			"{$_POST['cl_add_type']}");
		
		if (sizeof($value_Arr) == sizeof($column_Arr))
		{
			for ($i=0; $i<sizeof($column_Arr); $i++)
			{
				$column_Arr[$i] = str_replace("'", "&apos;", $column_Arr[$i]);
				$cols .= "{$column_Arr[$i]}".",";
				$value_Arr[$i] = str_replace("'", "&apos;", $value_Arr[$i]);
				$vals .= "'{$value_Arr[$i]}',";
				
				if ($i==(sizeof($column_Arr)-1)) $cols = substr("{$cols}",0 ,-1);
				if ($i==(sizeof($value_Arr)-1)) $vals = substr("{$vals}",0 ,-1);
			}
		}
		
		$db->tblUpdate_AddItem('tbl_contact_lense', $cols, $vals);
		$function->redir("{$baseUrl}/admin/?mod=manage&act=clense");
	}
	// ==========================================================
	$xpt->parse($site);
	$admin_content = $xpt->text($site);
?>
