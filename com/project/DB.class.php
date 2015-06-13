<?php
	

	class DB {

		private static $instance;
		public static function getInstance(){
			if(!self::$instance) self::$instance = new self();
			return self::$instance;
		}
		
		private $db;
		private function __construct(){
			$this->db = new SQLite3('mydb.sqlite');
		}
		public function query($sql){
			return $this->db->query($sql);
		}
		public function lastInsertRowID(){
			return $this->db->lastInsertRowID();
		}

	}

?>