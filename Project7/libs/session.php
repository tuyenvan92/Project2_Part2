<?php
	//Check if session is false
	if (!$function->check_Session())
	{
		$db = NULL; //disconnect the database
		$function->redir("{$baseUrl}/admin"); //redirect to index.php
	}

	//logout button set -> delete the current session
	if (isset($_POST['Logout']))
		$function->destroy_Session($baseUrl);
?>
