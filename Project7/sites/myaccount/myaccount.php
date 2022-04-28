<?php
	 
	$xp  = new XTemplate('views/user/user.html');
	
	$xp->parse('USER');
	$acontent = $xp->text('USER'); 