<?php

include_once "../Includes/conf.php";
session_start();

/*
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/metadata/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json; charset=utf-8; indent=4",
        "Authorization: Token ".TOKEN
    ),
));

$response = curl_exec($curl);
$response = json_decode($response);

curl_close($curl);

*/

$optsClass = [
    'http' => [
        'method'  => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
    ]
];

$context  = stream_context_create($optsClass);
$url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/metadata/";
$response = file_get_contents($url, false, $context);
$response = json_decode($response);

$tables = [];
foreach ($response->metadata->tables as $table) {
    $tables [] = $table;

}
