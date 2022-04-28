<?php
	$xp  = new XTemplate('views/compare/compare.html');

	if(isset($_GET['cpe'])) {

		$prd_name = $_GET['prd'];
		$cpe_name = $_GET['cpe'];

		$sql = 'select * from tbl_products where name = "'.$prd_name.'"';
		$row = $db->fetchOne($sql);
		$xp -> assign('prd_id',$row['id']);
		$xp -> assign('prd_name',$row['name']);
		$xp -> assign('prd_price',$row['price']);
		$xp -> assign('prd_image',$row['image1']);
		$xp -> assign('prd_origin',$row['origin']);
		$xp -> assign('prd_material',$row['material']);
		$xp -> assign('prd_shape',$row['shape']);
		$xp -> assign('prd_size',$row['size']);
		$xp -> assign('prd_warranty',$row['warranty']);
		$xp -> assign('prd_gender',$row['gender']);
		$xp -> assign('prd_lenWidth',$row['len_width']);
		$xp -> assign('prd_lenHeight',$row['len_height']);
		$xp -> assign('prd_bridgeWidth',$row['bridge_width']);
		$xp -> assign('prd_templeLength',$row['temple_length']);


		$sql = 'select * from tbl_products where name = "'.$cpe_name.'"';
		$row = $db->fetchOne($sql);
		$xp -> assign('cpe_id',$row['id']);
		$xp -> assign('cpe_name',$row['name']);
		$xp -> assign('cpe_price',$row['price']);
		$xp -> assign('cpe_image',$row['image1']);
		$xp -> assign('cpe_origin',$row['origin']);
		$xp -> assign('cpe_material',$row['material']);
		$xp -> assign('cpe_shape',$row['shape']);
		$xp -> assign('cpe_size',$row['size']);
		$xp -> assign('cpe_warranty',$row['warranty']);
		$xp -> assign('cpe_gender',$row['gender']);
		$xp -> assign('cpe_lenWidth',$row['len_width']);
		$xp -> assign('cpe_lenHeight',$row['len_height']);
		$xp -> assign('cpe_bridgeWidth',$row['bridge_width']);
		$xp -> assign('cpe_templeLength',$row['temple_length']);


	
		$xp->parse('COMPARE');
		$acontent = $xp->text('COMPARE');
	} else {
		$condition = '1=1';
	
	// --------------- Markup checked --------------------------------------
	
	if(isset($_GET['shape'])) {
		if(strpos($_GET['shape'],'Square')!== false){
			$xp -> assign('Square_checked','checked = "true"');
		}
		if(strpos($_GET['shape'],'Rectangle')!== false){
			$xp -> assign('Rectangle_checked','checked = "true"');
		}
		if(strpos($_GET['shape'],'Oversize')!== false){
			$xp -> assign('Oversize_checked','checked = "true"');
		}
		if(strpos($_GET['shape'],'Oval')!== false){
			$xp -> assign('Oval_checked','checked = "true"');
		}
		if(strpos($_GET['shape'],'Wrap')!== false){
			$xp -> assign('Wrap_checked','checked = "true"');
		}
		if(strpos($_GET['shape'],'Aviator')!== false){
			$xp -> assign('Aviator_checked','checked = "true"');
		}
		if(strpos($_GET['shape'],'CatEye')!== false){
			$xp -> assign('CatEye_checked','checked = "true"');
		}
		if(strpos($_GET['shape'],'Round')!== false){
			$xp -> assign('Round_checked','checked = "true"');
		}
		if(strpos($_GET['shape'],'Browline')!== false){
			$xp -> assign('Browline_checked','checked = "true"');
		}
		if(strpos($_GET['shape'],'Geometric')!== false){
			$xp -> assign('Geometric_checked','checked = "true"');
		}	
		if(strpos($_GET['shape'],'Butterfly')!== false){
			$xp -> assign('Butterfly_checked','checked = "true"');
		}	

		//----------- FILTER DATA -------------------------------
		$shape = ' and (shape = "'.str_replace(',','" or shape = "',$_GET['shape']).'")' ;
		$condition.= $shape;	
	}	

	if(isset($_GET['size'])) {
		if(strpos($_GET['size'],'S') !== false){
			$xp -> assign('Small_checked','checked = "true"');
		}
		if(strpos($_GET['size'],'M') !== false){
			$xp -> assign('Medium_checked','checked = "true"');
		}
		if(strpos($_GET['size'],'L') !== false){
			$xp -> assign('Large_checked','checked = "true"');
		}
		if(strpos($_GET['size'],'XL') !== false){
			$xp -> assign('XL_checked','checked = "true"');
		}

		$size = ' and (size = "'.str_replace(',','" or size = "',$_GET['size']).'")' ;
		$condition.= $size;
	}

	if(isset($_GET['gender'])) {
		if(strpos($_GET['gender'],'0') !== false){
			$xp -> assign('Men_checked','checked = "true"');
		}
		if(strpos($_GET['gender'],'1') !== false){
			$xp -> assign('Women_checked','checked = "true"');
		}

		$gender = ' and (gender = "'.str_replace(',', '" or gender = "',$_GET['gender']).'")';
		$condition.= $gender;
	}


	$xp -> assign('select','Most Relative');
	$order_by = "id desc";
	if(isset($_GET['order'])){
		$xp -> assign('select',$_GET['order']);
		if($_GET['order'] == 'Name')
			$order_by = "name asc";
		if($_GET['order'] == 'Lowest-Price')
			$order_by = "price asc";
		if($_GET['order'] == 'Highest-Price')
			$order_by = 'price desc';
	}



	

	 $sql 	= "SELECT * FROM tbl_products 
	 			WHERE {$condition}
	 			ORDER BY ".$order_by;
				 // echo $sql;
	 $rs 	= $db->fetchAll($sql);

	$t =  count($rs);
	$l = 24;
	$p = (isset($_GET['p']))?$_GET['p']:1;
	$fs = ($p-1)*$l;
	$sql 	= "SELECT * FROM tbl_products 
				WHERE {$condition}
				ORDER BY ".$order_by." 
				LIMIT {$fs},{$l}";
	$rs 	= $db->fetchAll($sql);
		
	foreach($rs as $row){
			
		$xp->insert_loop('LISTPRODUCT.LIST_PD',array('LIST_PD'=>$row));
		
	 }
	$pagers = $function->getPagers($t,$l,$url);	
	$xp->assign('pagers',$pagers);	

	$xp->assign('url',$url);
	$xp->parse('LISTPRODUCT');
	$acontent = $xp->text('LISTPRODUCT');
	}
	
	