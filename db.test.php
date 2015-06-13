<pre>
<?php
function Alert($subject,$do){
	if($do){
		echo "$subject -> done \r\n";
	}else{
		echo "$subject -> skipped/failed \r\n";
	}
}

$db = new SQLite3('mydb.sqlite');

//Drop Table
$do=$db->exec('DROP TABLE IF EXISTS `users`');
Alert('DROP TABLE',$do);
unset($do);

//Create Table
$do=$db->exec('CREATE TABLE `users` (`id` INTEGER PRIMARY KEY, `name` VARCHAR(128), `email` VARCHAR (128))');
Alert('CREATE TABLE',$do);
unset($do);

//Insert Row 1
$do=$db->exec('INSERT INTO `users` (`name`, `email`) VALUES ("Albert Einstein", "einstein@example.com")');
Alert('INSERT',$do);
unset($do);

//Insert Row 2
$do=$db->exec('INSERT INTO `users` (`name`, `email`) VALUES ("Stephen Chow", "chow@example.com")');
Alert('INSERT',$do);
unset($do);

$do=$db->exec('INSERT INTO `users` (`name`, `email`) VALUES ("Faul McCartney", "faul@example.com")');
Alert('INSERT',$do);
unset($do);

$do=$db->exec('INSERT INTO `users` (`name`, `email`) VALUES ("John Lennon", "john@example.com")');
Alert('INSERT',$do);
unset($do);

$do=$db->exec('INSERT INTO `users` (`name`, `email`) VALUES ("George Harrison", "george@example.com")');
Alert('INSERT',$do);
unset($do);

$do=$db->exec('INSERT INTO `users` (`name`, `email`) VALUES ("Ringo Start", "ringo@example.com")');
Alert('INSERT',$do);
unset($do);

function print_all(){
	global $db;
	$res=$db->query('SELECT * FROM users');
	while($row=$res->fetchArray()){
		$id=$row['id'];
		$name=$row['name'];
		$email=$row['email'];
		echo "$name: $email \r\n";
	}
	echo "\r\n";
}

//Fetch Array
echo "Result:\r\n";
print_all();

//Update Row
$do=$db->exec("UPDATE `users` SET `name`='Stephen Hawking', `email`='hawking@example.com' WHERE `id`=2");
Alert('UPDATE',$do);
unset($do);

//Fetch Array update #1
echo "Result (update #1):\r\n";
print_all();

//Delete Row
$do=$db->exec("DELETE FROM `users` WHERE `id`=2");
Alert('DELETE',$do);
unset($do);

//Fetch Array update #2
echo "Result (update #1):\r\n";
print_all();

$db->close();
?>
</pre>