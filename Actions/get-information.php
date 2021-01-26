<?php
require_once '../Includes/conf.php';
session_start();
$_SESSION["row_id"] = '20210126-00007';
//if (!isset($_SESSION['Name'])) { header('Location: index.php'); }
$opts = [
    'http' => [
        'method' => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' =>  '{
            "filters":[
		        {
                    "column_name": "Id",
                    "filter_predicate": "is",
                    "filter_term": "'.$_SESSION["row_id"].'",
                    "filter_term_modifier": ""	
		        }
		    ],
		    "filter_conjunction": "And"
	    }'
    ]
];

$context  = stream_context_create($opts);
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/filtered-rows/?table_name=Eleve";
$result = file_get_contents($url, false, $context);
$rep = json_decode($result);

$object = $rep->rows[0];
