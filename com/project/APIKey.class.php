<?php
	
	namespace com\project;

	class APIKey {

		public function verifyKey($key, $origin){
			return $key === 'my-super-key';
		}

	}

?>