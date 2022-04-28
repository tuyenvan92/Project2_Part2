<?php

	class Func
	{
		public function debug_AlertMsg($msg)
		{
			echo "<script type='text/javascript'>alert('{$msg}');</script>";
		}
		public function redir($url)
		{
			return header("Location:$url");
		}
		public function pageRefresh()
		{
			echo "<meta http-equiv='refresh' content='0'>";
		}
		public function check_Session()
		{
			if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['user_id'], $_SESSION['user_type']))
				return true;
			else return false;
		}
		public function destroy_Session()
		{
			$db = NULL;
			session_destroy();
			unset($_SESSION);
			// $this->redir("{$redirect_url}/admin");
		}
		public function valid_email($mail) {
			if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
     			 return false;
    		}
    		return true;
		}
		public function getPagers($totalRecords,$limit,$url){
			$pager = '';
			$totalPager =ceil($totalRecords/$limit);
			for($pi = 1; $pi<=$totalPager; $pi++){
				$pager .= "<a href='{$url}&p={$pi}'>{$pi}</a>";
			}	
			return $pager;
		}
		
	
}
?>
