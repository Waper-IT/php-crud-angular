<?php
	
	namespace com\project;

	class MyAPI extends \com\rest\API
	{
	    protected $User;

	    public function __construct($request, $origin) {
	        parent::__construct($request);

	        // Abstracted out for example
	        $APIKey = new APIKey();
	        $User = new User();

	        $headers = getallheaders(); //apache server
	        $apiKey = $headers['apiKey']; // could be $this->request['apiKey']
	        $apiToken = $headers['apiToken']; // could be $this->request['apiKey']
	        if($headers['wait']) sleep($headers['wait']); //testing

	        if( $this->endpoint !== 'session' && $this->endpoint !== 'login' ){
	        	$headers = getallheaders(); //apache server
		        $apiKey = $headers['apiKey']; // could be $this->request['apiKey']
		        $apiToken = $headers['apiToken']; // could be $this->request['apiKey']
		        if($headers['wait']) sleep($headers['wait']); //testing

		        if (!$apiKey) {
		            throw new \Exception('No API Key provided');
		        } else if (!$APIKey->verifyKey($apiKey, $origin)) {
		            throw new \Exception('Invalid API Key');
		        } else if ($apiToken && !$User->getToken($apiToken)) {
		            throw new \Exception('Invalid User Token');
		        }
	        }

	        $this->User = $User;
	    }

	    protected function session(){
	    	$response = array();
	    	$response['apiKey'] = 'my-super-key';
	    	return $response;
	    }
	    protected function login(){
	    	$response = array();
	    	$response['apiToken'] = 'my-super-token';
	    	return $response;
	    }

	    //creo un endpoint 'user'
		protected function user() {
			
			//por ejemplo user/1
			$entityId = $this->args[0];

			switch($this->method){
				case 'GET':
				return $entityId ? USER::get($entityId) : USER::getAll();	

				case 'PUT':
				return USER::update($this->request);

				case 'DELETE':
				return USER::delete($entityId);

				case 'POST':
				return USER::insert($this->request);
			}

		}

	 }

?>