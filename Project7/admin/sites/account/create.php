<?php
	require('../libs/session.php');

	$site_func = '<li class="breadcrumb-item">Root access</li><li class="breadcrumb-item">Create account</li>';
	$xpt_home->assign('function', $site_func);

	$user_type = $_SESSION['user_type'];

	if ($user_type != 1)
		$function->destroy_Session($baseUrl, "You have no permission on this site");
	else
	{
		$site = 'USER_CREATE';
		$xpt = new XTemplate('views/account/create.html');
		
		if (isset($_POST['owner_create_save']))
		{
			$cols = NULL; $vals = NULL;
			$column_Arr = array('mail', 'pw', 'full_name', 'phone_num', 'user_type');
			$value_Arr = array("{$_POST['owner_create_mail']}", sha1(123456789), "{$_POST['owner_create_name']}", "{$_POST['owner_create_phone']}", "{$_POST['owner_create_type']}");
			
			if (sizeof($value_Arr) == sizeof($column_Arr))
			{
				for ($i=0; $i<sizeof($column_Arr); $i++)
				{
					$cols .= "{$column_Arr[$i]}".",";
					$vals .= "'{$value_Arr[$i]}',";
					
					if ($i==(sizeof($column_Arr)-1)) $cols = substr("{$cols}",0 ,-1);
					if ($i==(sizeof($value_Arr)-1)) $vals = substr("{$vals}",0 ,-1);
				}
			}

			$db->tblUpdate_AddItem('tbl_users', $cols, $vals);
			$function->redir("{$baseUrl}/admin/?mod=account&act=list");
		}

		$xpt->parse($site);
		$admin_content = $xpt->text($site);
	}
?>
