<?php
$db = mysqli_connect('localhost','root','bitnami','wgbe','8080');
if(!$db){
	error_log(mysqli_connect_error());
	die();
}
?>