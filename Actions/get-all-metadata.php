<?php

include_once "../Includes/conf.php";
session_start();

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

$tables = [];
foreach ($response->metadata->tables as $table) {
    $tables [] = $table;

    /*
    echo "<strong>".$table->name."</strong>";
    echo "<br>";
    foreach ($table->columns as $col) {
        echo $col->name;
        echo "<br>";
        var_dump($col);
    }
    */
}
