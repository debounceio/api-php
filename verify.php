<?php
function debounce_api_call($email, $api) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, 'https://api.debounce.io/v1/?api='.$api.'&email='.strtolower($email));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

$api = 'APIKEY';
$email = 'test@example.com';
$json = json_decode(debounce_api_call($email, $api), true);
$success = $json['success'];
$result = $json['debounce'];
if($success!='0'){
	echo 'email '.$result['email'].' is '.$result['result'].' because it is '.$result['reason'].'. Result code is: '.$result['code'].'.';
}else{
	echo 'Error: '.$result['error'];
}
?>
