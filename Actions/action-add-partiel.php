<?php

session_start();
require_once('../Includes/conf.php');

$optsClass = [
    'http' => [
        'method'  => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
    ]
];

$context  = stream_context_create($optsClass);
$url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/?table_name=Partiel";
$partiels = file_get_contents($url, false, $context);
$partiels = json_decode($partiels)->rows[0];
print_r($partiels);
die();



$opts = array('http' =>
    array(
        'method' => 'POST',
        'header' => "Content-Type: application/json\r\n" .
            "Authorization: Token " . TOKEN . "\r\n",
            "Accept : application/json",
            "Content-type: application/json",
        'content' => '{
   "row": {
            "LibellePartiel" :"' . $_POST["LibellePartiel"] .'", 
            "CoefficientPrtiel" :"' . $_POST["CoefficientPartiel"] .'", 
            "DatePartiel" :"' . $_POST["DatePartiel"] .'",
            "Matiere" : "'.$_POST["matiere"].'" 
            
         },
   "table_name" : "Partiel"
}'
    )
);
$context = stream_context_create($opts);
$url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/" . UUID . "/rows/";
$result = file_get_contents($url, false, $context);

//curl -H 'Authorization: Token eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6IjFAMS5jb20iLCJkdGFibGVfdXVpZCI6IjYyMmYxZTZkMzM3NDQ5ZTQ5YjQyOWYyMjUzMDM3YTc2In0.3ytwzZsfZwzifAQtsLzn0AFMnEDSeHxkKlIgD6XKuIs' -H "Accept: application/json" -H "Content-type: application/json" -X POST -d '{"table_name": "Table1","other_table_name": "Table2","link_id": '1206'"table_row_id": "OkuYk0OWSIyi7zZKJ2NC4g","other_table_row_id": "eyuMiAwaQlSSr983O03oUA"}' https://cloud.seatable.io/dtable-server/api/v1/dtables/7f7dc9c7187a4d9fb6cfff5e5019a6d5/links/
//var_dump($result);

header("Location: ../Templates/matière.php");

