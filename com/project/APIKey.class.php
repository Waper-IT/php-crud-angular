<?php
	
	

	class APIKey {

		public function verifyKey($key, $origin){
			return $key === 'my-super-key';
		}

	}

?>