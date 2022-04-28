<?php
	$xp  = new XTemplate('views/contactus/contactus.html');

	
	
	$xp->parse('CONTACTUS');
	$acontent = $xp->text('CONTACTUS');