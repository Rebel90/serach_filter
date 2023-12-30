<?php
session_start();
 
$url = 'https://jsonplaceholder.typicode.com/users';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$curl_response = curl_exec($curl);
curl_close($curl);

$json_objekat = json_decode(json_encode($curl_response),true); 

$_SESSION['apiData'] = $json_objekat; 

if (isset($_SESSION['apiData'])) {
    $apiData = $_SESSION['apiData'];
    echo json_encode(['success' => true, 'apiData' => $apiData]);
} else {
    echo json_encode(['success' => false, 'message' => 'Session data not found']);
}
?>