<?php
	
	require('com/project/DB.class.php');

	class User {

		public static function getAll(){
			$res=DB::getInstance()->query('SELECT * FROM users');
			$all=[];
			while($row=$res->fetchArray(SQLITE3_ASSOC)){
				$all[]=$row;
			}
			return $all;
		}
		public static function get($id){
			$res=DB::getInstance()->query("SELECT * FROM users WHERE id = $id");
			return $res->fetchArray(SQLITE3_ASSOC);
		}
		public static function insert($obj){
			$res=DB::getInstance()->query("INSERT INTO users (name, email) VALUES ('{$obj->name}', '{$obj->email}')");
			$obj->id = DB::getInstance()->lastInsertRowID();
			return $obj;
		}
		public static function update($obj){
			$res=DB::getInstance()->query("UPDATE users SET name = '{$obj->name}', email = '{$obj->email}' WHERE id = {$obj->id}");
			return $obj;
		}
		public static function delete($id){
			return DB::getInstance()->query("DELETE FROM users WHERE id = $id");
		}

		public function getToken($token){
			return $token === 'my-super-token';
		}

	}
?>