<?php
	//Don't write any code above this line
	session_start();

	require_once("../libs/bootstrap.php");

	$xpt_home = new XTemplate("views/layout.html");
	$xpt_home->assign('baseUrl', $baseUrl);
	$site_path = 'Home';

	$xpt_home->assign('path', $site_path);

	//other pages
	if (isset($_GET['mod'], $_GET['act']))
	{
		$module = $_GET['mod']; $action = $_GET['act'];
		$source = "sites/{$module}/{$action}.php";

		if (file_exists($source)) include($source);
		else echo "404 NOT FOUND";

		if (($_GET['act'] != 'login') && $function->check_Session())
		{
			$xpt_home->assign('admin_content', $admin_content);
			$xpt_home->assign('user_name', $_SESSION['user_name']);
			$xpt_home->parse('LAYOUT');
			$xpt_home->out('LAYOUT');
		}
		else
		{
			$xpt_home->parse('LOGIN');
			$xpt_home->out('LOGIN');
		}
	}
	//redirect to login page if not logged in
	else if (!$function->check_Session())
		$function->redir("{$baseUrl}/admin/?mod=account&act=login");
	else $function->redir("{$baseUrl}/admin/?mod=test&act=blank");
?>
