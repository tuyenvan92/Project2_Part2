<?php
	require('../libs/session.php');
	
	$site_func = '<li class="breadcrumb-item">Root access</li><li class="breadcrumb-item">User list</li>';
	$xpt_home->assign('function', $site_func);

	$user_type = $_SESSION['user_type'];

	if ($user_type != 1)
		$function->destroy_Session($baseUrl, "You have no permission on this site");
	else
	{
		$site = 'USER_LIST'; $content = 'USER_INFO';
		$xpt = new XTemplate('views/account/list.html');
		
		$result = $db->fetchAll("SELECT * FROM tbl_users WHERE 1=1");

		if (isset($_POST['tbl_usr_filter']))
		{
			$filter_type = $_POST['tbl_usr_filter'];
			if ($filter_type != 0)
				$result = $db->fetchAll("SELECT * FROM tbl_users WHERE user_type='{$filter_type}'");
		}

		foreach ($result as $row)
		{
			$id = $row['id'];
			$condition = "id='{$id}'";

			htmlspecialchars($xpt->insert_loop("{$site}.{$content}", array($content => $row)));
			
			if (isset($_POST["tbl_user_type_{$id}"]))
			{
				$type = $_POST["tbl_user_type_{$id}"];
				$db->execSQL("UPDATE tbl_users SET user_type={$type} WHERE {$condition}");
				$function->pageRefresh();
			}
		}
		
		if (isset($_POST['owner_create_save']))
		{
			$cols = NULL; $vals = NULL;
			$column_Arr = array('mail', 'pw', 'full_name', 'phone_num', 'user_type', 'address', 'city', 'country');
			$value_Arr = array(
				"{$_POST['owner_create_mail']}", 
				sha1(123456), 
				"{$_POST['owner_create_name']}", 
				"{$_POST['owner_create_phone']}", 
				"{$_POST['owner_create_type']}",
				"{$_POST['owner_create_address']}", 
				"{$_POST['owner_create_city']}", 
				"{$_POST['owner_create_country']}"
			);
			
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

		if (isset($_POST['owner_del_save']))
		{
			$condition = "id='{$_GET['usrid']}'";
			$db->tblUpdate_DeleteItem('tbl_users', $condition);

			$function->redir("{$baseUrl}/admin/?mod=account&act=list");
		}

		if (isset($_POST['owner_edit_save']))
		{
			$condition = "id='{$_GET['usrid']}'";
			$account = array();

			if (strlen($_POST['owner_edit_mail']))
				$account = array_merge($account, array('mail' => $_POST['owner_edit_mail']));
			if (strlen($_POST['owner_edit_name']))
				$account = array_merge($account, array('full_name' => $_POST['owner_edit_name']));
			if (strlen($_POST['owner_edit_phone']))
				$account = array_merge($account, array('phone_num' => $_POST['owner_edit_phone']));
			if (strlen($_POST['owner_edit_address']))
				$account = array_merge($account, array('address' => $_POST['owner_edit_address']));
			if (strlen($_POST['owner_edit_city']))
				$account = array_merge($account, array('city' => $_POST['owner_edit_city']));
			if (strlen($_POST['owner_edit_country']))
				$account = array_merge($account, array('country' => $_POST['owner_edit_country']));

			if (sizeof($account)>0)
				foreach ($account as $col => $val)
				{
					$db->tblUpdate_EditInfo('tbl_users', $col, $val, $condition);
				}
			
			$function->redir("{$baseUrl}/admin/?mod=account&act=list");
		}

		$xpt->parse($site);
		$admin_content = $xpt->text($site);
	}
?>
