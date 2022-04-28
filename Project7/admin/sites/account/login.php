<?php
	if ($function->check_Session())
	{
		if ($_SESSION['user_type'] != 3)
			$function->redir("{$baseUrl}/admin/");
		else
			$function->destroy_Session($baseUrl, NULL);
	}

	$_login = 1;

	if ($_POST)
	{
		ob_start();

		$info = array
		(
			'account' => $db->_db->quote($_POST['admin_acc']),
			'password' => sha1($_POST['admin_pw'])
		);

		if (empty($_POST['admin_pw']) || empty($_POST['admin_acc']))
		{
			$function->debug_AlertMsg("Fill out both username and password");
			$_login = 0;
		}
		
		if ($_login)
		{
			$debug_result = $db->fetchAll("SELECT * FROM tbl_users WHERE mail={$info['account']};");
			$check = $db->execSQL("SELECT * FROM tbl_users WHERE mail={$info['account']};");
			//2 step verify password
			if ($check->rowCount() != 1)
			{
				$function->debug_AlertMsg("Wrong username or password...");
				$db = NULL;
			}
			else
			{
				foreach ($debug_result as $col)
				{
					if ($col['user_type'] == 3)
						$function->destroy_Session($baseUrl, "You have no permission on this site");
					else 
					{
						//hashes the sha1 string
						$pw_hash = password_hash($col['pw'], PASSWORD_DEFAULT);
						//verify the plain-sha1 with the hash
						if (!password_verify($info['password'], $pw_hash))
						{
							$function->debug_AlertMsg("Wrong username or password...");
							$db = NULL;
						}
						else
						{
							$_SESSION['user_id'] = $col['id'];
							$_SESSION['user_name'] = $col['full_name'];
							$_SESSION['user_type'] = $col['user_type'];
							
							$function->redir("{$baseUrl}/admin/");
						}
					}
				}
			}
		}

		ob_end_flush();
	}
?>
