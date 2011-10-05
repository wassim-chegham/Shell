<?php

	class dbObject
	{
		private $server;
		private $user;
		private $password;
		private $dbname;
		private $dbh;
	
		public function __construct()
		{
			$this->server = 'db1830.1and1.fr';
			$this->user = 'dbo309568106';
			$this->password = 'lasemetibohacker';
			$this->dbname = 'db309568106';
	
			try {
	
				$this->dbh = new PDO('mysql:host='.$this->server.';dbname='.$this->dbname, $this->user , $this->password);
	
			}
			catch (Exception $e) {
	
					die('DB Connection Error : ' . $e->getMessage());
	
			}
	
		}
	
		public function query( $q )
		{
			$arr = array();
			$res = $this->dbh->query( $q );
			while( $data = $res->fetch() ) $arr[] = $data;
			$res->closeCursor();
	
			return $arr;
		}
	
		public function check_user_from_db( $login, $password )
		{
			$arr = $this->query('select * from app_shell where user="'.$login.'" and password="'.$password.'"');
			return count($arr);
		}
	
	
	}
	
?>