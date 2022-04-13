<?php
	$xp  = new XTemplate('views/category/contact.html');
	// =====================================================
	$site = 'CONTACT';
	// =====================================================
	$condition = "1=1";
	// =====================================================
	$filter = array('');
	$nhactung = array('brand' => 'CL_BRAND', 'type' => 'CL_TYPE', 'manufacturer' => 'CL_MANUF', 'inbox_qty' => 'CL_IBQTY');
	foreach ($nhactung as $title => $looper)
	{
		$query = "SELECT DISTINCT({$title}) FROM tbl_contact_lense WHERE {$condition} ORDER BY {$title} ASC";
		$result = $db->fetchAll($query);
		foreach ($result as $row)
		{
			$row['temp'] = strtolower(str_replace(' ', '_', $row[$title]));
			$xp->insert_loop("{$site}.{$looper}",array($looper=>$row));
		}
	}
	// =====================================================
	$t = count($result); $l = 24; $p = (isset($_GET['p']))?$_GET['p']:1;
	$fs = ($p-1)*$l;
	$order_by = 'id';
	// =====================================================
	$nhactung = array('brand', 'type', 'manufacturer', 'inbox_qty');
	for ($i=0; $i<sizeof($nhactung); $i++)
	{
		if(isset($_GET[$nhactung[$i]]))
		{
			$query = "SELECT DISTINCT({$nhactung[$i]}) FROM tbl_contact_lense WHERE {$condition}";
			$result = $db->fetchAll($query);
			foreach ($result as $row => $col)
			{
				foreach ($col as $value)
				{
					if(strpos($_GET[$nhactung[$i]], $value) !== false)
						$temp = strtolower(str_replace(' ', '_', $_GET[$nhactung[$i]]));
				}
			}
			${$nhactung[$i]} = " AND {$nhactung[$i]} = '" . str_replace(',', "' OR {$nhactung[$i]} = '", $_GET[$nhactung[$i]]) . "'" ;
			$condition .= ${$nhactung[$i]};
		}
	}
	// =====================================================
	if (isset($_GET['order']))
		switch ($_GET['order'])
		{
			case 'Name':
				$order_by = 'name';
				$xp->assign('name_selected', 'selected');
				$xp->assign('lprice_selected', '');
				$xp->assign('hprice_selected', '');
				break;
			case 'Lowest-Price':
				$order_by = 'price ASC';
				$xp->assign('name_selected', '');
				$xp->assign('lprice_selected', 'selected');
				$xp->assign('hprice_selected', '');
				break;
			case 'Highest-Price':
				$order_by = 'price DESC';
				$xp->assign('name_selected', '');
				$xp->assign('lprice_selected', '');
				$xp->assign('hprice_selected', 'selected');
				break;
			default:
				$order_by = 'id';
				$xp->assign('name_selected', '');
				$xp->assign('lprice_selected', '');
				$xp->assign('hprice_selected', '');
				break;
		}

	$query = "SELECT * FROM tbl_contact_lense 
				WHERE {$condition}
				ORDER BY $order_by 
				LIMIT {$fs},{$l}";
	$result = $db->fetchAll($query);
	
	foreach ($result as $row)
	{
		$row['temp_name'] = strtolower(str_replace(' ', '-', $row['name']));
		$xp->insert_loop("{$site}.CL_INFO",array('CL_INFO'=>$row));
	}
	$pagers = $function->getPagers($t,$l,$url);	
	$xp->assign('pagers',$pagers);
	$xp->assign('url',$url);
	// =====================================================
	$xp->parse('CONTACT');
	$acontent = $xp->text('CONTACT');
?>