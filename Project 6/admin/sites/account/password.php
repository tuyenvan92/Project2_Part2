<?php
	require('../libs/session.php');

	$site_func = '<li class="breadcrumb-item">Settings</li><li class="breadcrumb-item">Change password</li>';
	$xpt_home->assign('function', $site_func);

	$site = 'PW_CHANGE'; $content = NULL;
	$xpt = new XTemplate('views/account/password.html');
	$xpt->assign('pwc_id', $_SESSION['user_id']);

	$_change = true; $report = NULL;

	if (isset($_POST['pwc_save']))
	{
		$condition = "id='{$_SESSION['user_id']}'";
		$account = array();

		if (empty($_POST['pwc_pw_old']) || empty($_POST['pwc_pw']) || empty($_POST['pwc_pw_repeat']))
		{
			$_change = false;
			$report = "Fill out all field";
		}
		else
		{
			$password_old = sha1($_POST['pwc_pw_old']);
			$password_new = sha1($_POST['pwc_pw']);
			$password_repeat = sha1($_POST['pwc_pw_repeat']);

			$debug_result = $db->fetchAll("SELECT * FROM tbl_users WHERE id={$_SESSION['user_id']};");
			foreach ($debug_result as $col)
			{
				$pw_hash = password_hash($col['pw'], PASSWORD_DEFAULT);
				if (!password_verify($password_old, $pw_hash))
				{
					$report = "Old password does not match your account \n";
					$_change = false;
				}
			}
			if ($password_new !== $password_repeat)
			{
				$report .= "New password does not match";
				$_change = false;
			}
		}
		
		if ($_change)
		{
			$report = NULL;
			$db->tblUpdate_EditInfo('tbl_users', 'pw', $password_repeat, $condition);
			$function->destroy_Session($baseUrl, NULL);
		}
	}

	$xpt->assign('pwc_report', nl2br($report));
	$xpt->parse($site);
	$admin_content = $xpt->text($site);
?>
