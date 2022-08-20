<?php

$host = "localhost:8000";

$ch = curl_init("http://" . $host . "/");
$data = [
    "jsonrpc" => "2.0", 
    "method" => "get_current_UNIX_time",
    "params" => [],
    "id" => 123
];

$json_string = json_encode($data);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

curl_setopt( $ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);

curl_close($ch);

echo $resp;
?>