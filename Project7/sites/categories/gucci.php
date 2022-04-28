<?php
	$xp  = new XTemplate('views/categories/gucci.html');
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
			
		$xp->insert_loop('GLASSES.LIST_PD',array('LIST_PD'=>$row));
		
	 }
	$pagers = $function->getPagers($t,$l,$url);	
	$xp->assign('pagers',$pagers);	

	$xp->assign('url',$url);
	$xp->parse('GLASSES');
	$acontent = $xp->text('GLASSES');
	
	