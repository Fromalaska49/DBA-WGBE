<?php
/*
$db = mysqli_connect('localhost', 'root', 'bitnami', 'wgbe', '8080');
if(!$db){
	echo(mysqli_connect_error());
	die();
}
*/
require('connect.php');

// Delete all email records where no email exists
mysqli_query($db, 'DELETE FROM `email` WHERE `EMAILADDRESS`=\'\';');

$sql = 
	'SELECT *
	FROM `person`
	INNER JOIN `personemailmap`
	ON `person`.`PERSONID`=`personemailmap`.`PERSONID`
	INNER JOIN `email`
	ON `personemailmap`.`EMAILID` = `email`.`EMAILID`
	INNER JOIN `phone`
	ON ``
	WHERE `person`.`recordtype` = \'1\'
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


/*
//ID
0	user_login			`users`.`userName`
1	user_pass			null
2	user_nicename		null // WP Codex is unclear about whether this will be automatically geneterated
3	User_email			`person`.`PERSONID` = `personaemailmap`.`PERSONID`, `personemailmap`.`EMAILID` = `email`.`EMAILID`, `email`.`EMAILADDRESS`
4	user_url			`person`.`url`
5	user_registered		date('Y-m-d H:i:s', time());// YYYY-MM-DD HH:MM:SS
6	user_activation_key	
7	user_status			0
8	display_name		
*/

$insert_wp_users = 'INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (\'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\')';
for($i = 0; $i < ; $i++){
	$insert_wp_users .= ', (\''..'\', \''..'\', \''..'\', \''..'\', \''..'\', \''..'\', \''..'\', \''..'\', \''..'\', \''..'\')';
}

/*
//	WP User Metadata
0	nickname								
1	first_name								// First Name of login
2	last_name								// Last Name of login
3	description								
4	rich_editing							
5	comment_shortcuts						
6	admin_color								
7	use_ssl									
8	show_admin_bar_font						
9	wp_capabilities							
10	wp_user_level							
11	dismissed_wp_pointers					
12	show_welcome_panel						
13	wp_dashboard_quick_press_last_post_id	
*/

$insert_wp_user_meta = 'INSERT INTO `wp_user_meta` (`user_id`, `meta_key`, `meta_value`) VALUES (\'\', \'\', \'\')';
for($user_id = $num_users; $user_id < $num_users + $num_new_users; $user_id++){
	for($i = 0; $i < $num_keys; $i++){
		$insert_wp_user_meta .= ', (\''.$user_id.'\', \''.$keys[$i].'\', \''.$values[$user_id - $num_users][$i].'\')';
	}
}

?>




