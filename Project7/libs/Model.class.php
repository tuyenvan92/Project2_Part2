<?php
	class Model extends PDO
	{
		public $_user;
		public $_pwd;
		public $_dbName;
		public $_db;

		

		public function __construct($usr,$pwd,$dbName)
		{
			$this->_user = $usr;
			$this->_pwd = $pwd;
			$this->_dbName = $dbName;
			$dsn = "mysql:dbname=$dbName;host=localhost";
			try
			{
				$this->_db = new PDO($dsn,$usr,$pwd);
				$this->_db->query("SET NAMES 'utf8'");
			}
			catch(PDOException $e)
			{
				echo "Not connected to database <br>".$e->getMessage();
			}
		}
		public function execSQL($sql)
		{
			$var=$this->_db->prepare($sql);
			$var->execute();
			return $var;
		}
		public function fetchAll($sql)
		{
			$dbh = $this->execSQL($sql);
			return $dbh->fetchAll(PDO::FETCH_ASSOC);
		}
		public function fetchOne($sql)
		{
			$dbh = $this->execSQL($sql);
			return $dbh->fetch(PDO::FETCH_ASSOC);
		}
		public function tblUpdate_EditInfo($tblName, $column, $value, $condition)
		{
			$query = "UPDATE {$tblName} SET {$column}='{$value}' WHERE {$condition}";
			return $this->execSQL($query);
		}
		public function tblUpdate_DeleteItem($tblName, $condition)
		{
			$query = "DELETE FROM {$tblName} WHERE {$condition}";
			return $this->execSQL($query);
		}
		public function tblUpdate_AddItem($tblName, $column=array(), $value=array())
		{
			$query = "INSERT INTO {$tblName}({$column}) VALUES ({$value})";
			return $this->execSQL($query);
		}

		public function login($email,$psd) {
				$sql = 'select * from tbl_users where mail = "'.$email.'" and pw = "'.md5($psd).'" and user_type = 3';
				$row = $this->fetchAll($sql);
				if(count($row)==0){
					echo "Invalid Email or Password<br>(check your CAPS LOCK key)";
					return 0;
				}
				else {
					session_start();
					$_SESSION['email'] = $email;
					foreach ($row as $key) {
						$_SESSION['id'] = $key['id'];
						// echo $_SESSION['id'];
					}					
				return 1;
			}
		}
	}
?>
