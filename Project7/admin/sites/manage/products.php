<?php
	require('../libs/session.php');

	$site_func = '<li class="breadcrumb-item">Manage</li><li class="breadcrumb-item">Products</li>';
	$xpt_home->assign('function', $site_func);
	
	$site = 'PRODUCT_LIST'; $content = 'PRODUCT_INFO';
	$xpt = new XTemplate('views/manage/products.html');

	// ==========================================================
	$condition = "1";
	$query = "SELECT * FROM tbl_brands WHERE 1";
	$result = $db->fetchAll($query);
	foreach ($result as $row)
	{
		htmlspecialchars($xpt->insert_loop("{$site}.FILTER_BRAND", array('FILTER_BRAND' => $row)));
	}
	// ==========================================================
	$result = $db->fetchAll("SELECT * FROM tbl_products WHERE {$condition}");

	if (isset($_POST['filter_btn']))
	{
		$result = $db->fetchAll("SELECT * FROM tbl_products WHERE gender='{$_POST['tbl_options_sex']}' AND brand_id='{$_POST['tbl_options_brand']}' AND category_id='{$_POST['tbl_options_cat']}'");
	}
	
	foreach ($result as $row)
	{
		htmlspecialchars($xpt->insert_loop("{$site}.{$content}", array($content => $row)));

		$item_id = $row['id'];
		if (isset($_POST["tbl_product_status_{$item_id}"]))
		{
			$prd_stt = $_POST["tbl_product_status_{$item_id}"];
			$db->execSQL("UPDATE tbl_products SET instock_stt={$prd_stt} WHERE id={$item_id}");
			$function->pageRefresh();
		}
	}
	// ==========================================================
	if (isset($_POST['product_edit_save']))
	{
		$condition = "id='{$_GET['itemid']}'";
		$product = array();

		if (strlen($_POST['product_edit_name']))
			$product = array_merge($product, array('name' => $_POST['product_edit_name']));
		if (strlen($_POST['product_edit_origin']))
			$product = array_merge($product, array('origin' => $_POST['product_edit_origin']));
		if (strlen($_POST['product_edit_material']))
			$product = array_merge($product, array('material' => $_POST['product_edit_material']));
		if (strlen($_POST['product_edit_descr']))
			$product = array_merge($product, array('description' => $_POST['product_edit_descr']));
		if (strlen($_POST['product_edit_warranty']))
			$product = array_merge($product, array('warranty' => $_POST['product_edit_warranty']));
		if (strlen($_POST['product_edit_price']))
			$product = array_merge($product, array('price' => $_POST['product_edit_price']));
		if (strlen($_POST['product_edit_size']))
			$product = array_merge($product, array('size' => $_POST['product_edit_size']));
		if (strlen($_POST['product_edit_shape']))
			$product = array_merge($product, array('shape' => $_POST['product_edit_shape']));
		if (strlen($_POST['product_edit_color']))
			$product = array_merge($product, array('color' => $_POST['product_edit_color']));
		if (strlen($_POST['product_edit_sex']))
			$product = array_merge($product, array('gender' => $_POST['product_edit_sex']));
		if (strlen($_POST['product_edit_cat']))
			$product = array_merge($product, array('category_id' => $_POST['product_edit_cat']));
		if (strlen($_POST['product_edit_brand']))
			$product = array_merge($product, array('brand_id' => $_POST['product_edit_brand']));
		if (strlen($_POST['product_edit_lwidth']))
			$product = array_merge($product, array('len_width' => $_POST['product_edit_lwidth']));
		if (strlen($_POST['product_edit_lheight']))
			$product = array_merge($product, array('len_height' => $_POST['product_edit_lheight']));
		if (strlen($_POST['product_edit_bwidth']))
			$product = array_merge($product, array('bridge_width' => $_POST['product_edit_bwidth']));
		if (strlen($_POST['product_edit_tlen']))
			$product = array_merge($product, array('temple_length' => $_POST['product_edit_tlen']));
			
		if (sizeof($product)>0)
			foreach ($product as $col => $val)
			{
				$val = str_replace("'", "&apos;", $val);
				$db->tblUpdate_EditInfo('tbl_products', $col, $val, $condition);
			}
		
		$function->redir("{$baseUrl}/admin/?mod=manage&act=products");
	}
	// ==========================================================
	if (isset($_POST['product_delete']))
	{
		$condition = "id='{$_GET['itemid']}'";
		$db->tblUpdate_DeleteItem('tbl_products', $condition);

		$function->redir("{$baseUrl}/admin/?mod=manage&act=products");
	}
	// ==========================================================
	if (isset($_POST['product_add_save']))
	{
		$cols = NULL; $vals = NULL;
		$column_Arr = array(
			'name',			'gender',	'origin',	'material', 
			'description',	'warranty',	'price',		'instock_stt',
			'size',			'color',		'shape',		'len_width',
			'len_height',	'bridge_width',	'temple_length',
			'brand_id',	'category_id');
		
		$value_Arr = array(
			"{$_POST['product_add_name']}",		"{$_GET['gender']}", 
			"{$_POST['product_add_origin']}",	"{$_POST['product_add_material']}", 
			"{$_POST['product_add_descr']}",		"{$_POST['product_add_warranty']}", 
			"{$_POST['product_add_price']}",		"{$_POST['product_add_stt']}",
			"{$_POST['product_add_size']}",		"{$_POST['product_add_color']}", "{$_POST['product_add_shape']}",
			"{$_POST['product_add_lwidth']}",		"{$_POST['product_add_lheight']}",
			"{$_POST['product_add_bwidth']}",		"{$_POST['product_add_tlen']}",
			"{$_GET['brand']}",						"{$_GET['category']}");
		
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
		
		$db->tblUpdate_AddItem('tbl_products', $cols, $vals);
		$function->redir("{$baseUrl}/admin/?mod=manage&act=products");
	}

	$xpt->parse($site);
	$admin_content = $xpt->text($site);
?>
