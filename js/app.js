angular
	.module('TheApp', [])
	.constant('API', { 
		BASE: 'api.php?request=', // en la realidad seria 'api/v1/',
		RECREATE: 'db.test.php',
		HEADERS: {
			'apiKey': 'my-super-key',
			'apiToken': 'my-super-token',
			'wait': 1 //sends "wait 2 seconds" to PHP, testing loading bar
		}
	});