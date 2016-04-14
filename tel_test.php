<?php
require('connect.php');
$sql = 'SELECT * FROM `phone`';
$result = mysqli_query($db, $sql);
$tel_count = 0;
$valid_tel_count = 0;
$invalid_tel_count = 0;
$overpacked_tel_count = 0;
$empty_tel_count = 0;
$pattern = '/\d{3}?(?:\s*[\-\.]?\s*)\d{3}(?:\s*[\-\.]?\s*)\d{4}$/';
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
		$tel = $record['PHONENUMBER'];
		$tel_count++;
		if(strlen($tel) >= 7){
			preg_match_all($pattern, $tel, $matches);
			$valid_tel_count += sizeof($matches);
			if(sizeof($matches) > 1){
				$overpacked_tel_count++;
				//print_r($matches);
				//echo('<br />');
			}
			for($i = 0; $i < sizeof($matches) && $valid_tel_count < 100; $i++){
				//echo('<div>'.$matches.'</div>');
				print_r($matches);
				echo('<br />');
			}
			//echo('<br />');
		}
		else{
			$invalid_tel_count++;
			if(strlen($tel) == 0 || $tel == ''){
				$empty_tel_count++;
			}
			else{
				var_dump($tel);
				echo('<br />');
			}
		}
	}
	unset($result);
	unset($matches);
	echo('<div style="padding:20px;margin:20px;background-color:#CCCCCC;border-radius:20px;"><p>'.number_format($valid_tel_count,0,'.',',').' valid phone numbers were found ( '.number_format(100*$valid_tel_count/$tel_count, 2,'.',',').'% )</p><p>'.number_format($invalid_tel_count,0,'.',',').' invalid phone numbers were found ( '.number_format(100*$invalid_tel_count/$tel_count, 2,'.',',').'% )</p><p>'.number_format($overpacked_tel_count,0,'.',',').' records held more than one phone number ( '.number_format(100*$overpacked_tel_count/$tel_count, 2,'.',',').'% )</p><p>'.number_format($empty_tel_count,0,'.',',').' records held empty phone numbers ( '.number_format(100*$empty_tel_count/$tel_count, 2,'.',',').'% )</p></div>');
	?>
	</body>
</html>