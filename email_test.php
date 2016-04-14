<?php
require('connect.php');
$sql = 'SELECT * FROM `email`';
$result = mysqli_query($db, $sql);
$email_count = 0;
$valid_email_count = 0;
$invalid_email_count = 0;
$overpacked_email_count = 0;
$empty_email_count = 0;
$pattern = '/[\w-_\.]+@[\w-_\.]+\.\w\w+/';
?>
<html>
	<head>
		<style type="text/css">
			body{
				font-family:arial;
			}
		</style>
	</head>
	<body>
	<?php
	$matches;
	while($record = mysqli_fetch_array($result)){
		$email = $record['EMAILADDRESS'];
		$email_count++;
		if(preg_match($pattern, $email, $matches)){
			$valid_email_count += sizeof($matches);
			if(sizeof($matches) > 1){
				$overpacked_email_count++;
			}
			for($i = 0; $i < sizeof($matches); $i++){
				//echo($matches[$i].'; ');
			}
			//echo('<br />');
		}
		else{
			if(strlen($email) == 0 || $email == ''){
				$empty_email_count++;
			}
			else{
				$invalid_email_count++;
				var_dump($email);
				echo('<br />');
			}
		}
	}
	unset($result);
	unset($matches);
	echo('<div style="padding:20px;margin:20px;background-color:#CCCCCC;border-radius:20px;"><p>'.number_format($valid_email_count,0,'.',',').' valid email addresses were found ( '.number_format(100*$valid_email_count/$email_count, 2,'.',',').'% )</p><p>'.number_format($invalid_email_count,0,'.',',').' invalid email addresses were found ( '.number_format(100*$invalid_email_count/$email_count, 2,'.',',').'% )</p><p>'.number_format($overpacked_email_count,0,'.',',').' records held more than one email address ( '.number_format(100*$overpacked_email_count/$email_count, 2,'.',',').'% )</p><p>'.number_format($empty_email_count,0,'.',',').' records held empty email addresses ( '.number_format(100*$empty_email_count/$email_count, 2,'.',',').'% )</p></div>');
	?>
	</body>
</html>