<?php
require_once '../Includes/conf.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }

function getCurrentUser() {
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
    $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/filtered-rows/?table_name=".$_SESSION['statut'];
    $result = file_get_contents($url, false, $context);

    return json_decode($result)->rows[0];
}