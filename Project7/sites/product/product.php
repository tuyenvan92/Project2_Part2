<?php
	$xp  = new XTemplate('views/product/product.html');

	$name = $_GET['name'];
	 $sql = 'select * from tbl_products where name = "'.$name.'"';
	 // echo $sql;
	 $rs = $db -> fetchAll($sql);

	 foreach ($rs as $row) {
	 	// echo $row['image1'];
	 	$xp -> assign('product_id',$row['id']);
	 	$xp -> assign('image1',$row['image1']);
	 	$xp -> assign('image2',$row['image2']);
	 	$xp -> assign('image3',$row['image3']);
	 	$xp -> assign('info',$row['description']);
	 }

	 
	 
	
	$xp -> assign('product_name',$name);
	$xp->parse('PRODUCT');
	$acontent = $xp->text('PRODUCT');
	
	