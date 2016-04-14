<?php

$db = mysqli_connect('localhost', 'root', 'bitnami', 'wgbe', '8080');
if(!$db){
	echo(mysqli_connect_error());
	die();
}
$sql = 'SELECT *
	FROM `person`
	INNER JOIN `email`
	ON `person`.`PERSONID`=`personemailmap`.`PERSONID`
	INNER JOIN `personemailmap`.`EMAILID`=`email`.`EMAILID`
	WHERE `recordtype` = \'1\'
';
$result = mysqli_query($db, $sql);
if(!$result){
	echo('Error: no records fetched from database<br />');
	die();
}
while($record = mysqli_fetch_array($result)){
	$display_name = $record['LASTNAME'];
	$website = $record['url'];
	$first_name = '';
	$last_name = '';
	$email = $record['EMAILADDRESS'];
}
?>