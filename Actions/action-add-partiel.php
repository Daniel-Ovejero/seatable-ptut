<?php

session_start();
require_once('../Includes/conf.php');
$link = "0VcV";

$opts = [
    'http' => [
        'method' => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' =>  '{
            "filters":[                                                 
		        {
                    "column_name": "LibelleMatiere",
                    "filter_predicate": "contains",
                    "filter_term": "'.$_POST["matiere"].'",
                    "filter_term_modifier": ""	
		        }
		    ],
		    "filter_conjunction": "And"
	    }'
    ]
];

$context  = stream_context_create($opts);
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/filtered-rows/?table_name=Matiere";
$result = file_get_contents($url, false, $context);
$rep = json_decode($result);
$object = $rep->rows[0];

$id2 = $object->_id;

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

$opts = [
    'http' => [
        'method' => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' =>  '{
            "filters":[                                                 
		        {
                    "column_name": "LibellePartiel",
                    "filter_predicate": "contains",
                    "filter_term": "'.$_POST["LibellePartiel"].'",
                    "filter_term_modifier": ""	
		        },
		        {
		            "column_name": "DatePartiel",
                    "filter_predicate": "contains",
                    "filter_term": "'.$_POST["DatePartiel"].'",
                    "filter_term_modifier": ""	
		        }
		    ],
		    "filter_conjunction": "And"
	    }'
    ]
];

$context  = stream_context_create($opts);
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/filtered-rows/?table_name=Partiel";
$result = file_get_contents($url, false, $context);
$rep = json_decode($result);
$object = $rep->rows[0];

$id1 = $object->_id;

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/". UUID."/links/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>"{ \n  \"table_name\": \"Partiel\", \n  \"other_table_name\": \"Matiere\", \n  \"link_id\": \"".$link."\", \n  \"table_row_id\": \"".$id1."\", \n  \"other_table_row_id\": \"".$id2."\" \n}",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Token ".TOKEN,
        "Accept: application/json",
        "Content-type: application/json"
    ),
));

$response = curl_exec($curl);

curl_close($curl);

var_dump($response);
die();

//curl -H 'Authorization: Token eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6IjFAMS5jb20iLCJkdGFibGVfdXVpZCI6IjYyMmYxZTZkMzM3NDQ5ZTQ5YjQyOWYyMjUzMDM3YTc2In0.3ytwzZsfZwzifAQtsLzn0AFMnEDSeHxkKlIgD6XKuIs' -H "Accept: application/json" -H "Content-type: application/json" -X POST -d '{"table_name": "Table1","other_table_name": "Table2","link_id": '1206'"table_row_id": "OkuYk0OWSIyi7zZKJ2NC4g","other_table_row_id": "eyuMiAwaQlSSr983O03oUA"}' https://cloud.seatable.io/dtable-server/api/v1/dtables/7f7dc9c7187a4d9fb6cfff5e5019a6d5/links/
//var_dump($result);

header("Location: ../Templates/matière.php");

