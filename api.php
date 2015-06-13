<?php
	
	error_reporting( E_ALL - E_NOTICE );

	spl_autoload_extensions('.class.php,.interface.php'); // comma-separated list
    spl_autoload_register();

	// Requests from the same server don't have a HTTP_ORIGIN header
	if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
	    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
	}

	header('content-type: application/json');	
	try {
	    $API = new \com\project\MyAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
	    echo $API->processAPI();
	} catch (Exception $e) {
	    echo json_encode( ['error' => $e->getMessage()] );
	}
	
?>