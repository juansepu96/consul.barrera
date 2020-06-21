<?php

/* Pueba SMS MASIVOS

print("Respuesta: " . $smsrespuesta);
*/


$curl = curl_init();
$options = array(
CURLOPT_URL => "https://api.notimation.com/api/v1/sms",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => json_encode(array(
'recipient' => '2932611874',
'message' => 'Testeo app',
'ignore_banned' => 1,
)),
CURLOPT_HTTPHEADER => array(
"Content-Type: application/json",
"Accept: application/json",
"Authorization: Bearer 6E0EJLSB5IZ729LLQ81ZFMJK5KVCHE"
),
);
curl_setopt_array($curl, $options);
$response = curl_exec($curl);
curl_close($curl);
print_r(json_decode($response, true));
echo "</pre>";


?>