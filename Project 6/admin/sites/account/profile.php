<?php
	require('../libs/session.php');

	$site_func = '<li class="breadcrumb-item">Settings</li><li class="breadcrumb-item">Edit profile</li>';
	$xpt_home->assign('function', $site_func);

	$site = 'ADMIN_PROFILE'; $content = 'PROFILE_INFO';
	$xpt = new XTemplate('views/account/profile.html');

	$result = $db->fetchAll("SELECT * FROM tbl_users WHERE id='{$_SESSION['user_id']}'");
	foreach ($result as $col)
	{
		$xpt->assign('prf_id', $col['id']);
		htmlspecialchars($xpt->insert_loop("{$site}.{$content}", array($content => $col)));
	}

	if (isset($_POST['prf_save']))
	{
		$condition = "id='{$_SESSION['user_id']}'";
		$account = array();

		if (strlen($_POST['prf_name']))
		{
			$account = array_merge($account, array('full_name' => $_POST['prf_name']));
			$account['full_name'] = $_SESSION['user_name'];
		}
		if (strlen($_POST['prf_phone']))
			$account = array_merge($account, array('phone_num' => $_POST['prf_phone']));

		if (sizeof($account)>0)
			foreach ($account as $col => $val)
			{
				$db->tblUpdate_EditInfo('tbl_users', $col, $val, $condition);
			}
		
		$function->pageRefresh();
	}

	$xpt->parse($site);
	$admin_content = $xpt->text($site);
?>
