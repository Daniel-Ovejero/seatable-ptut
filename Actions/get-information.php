<?php
require_once '../Includes/conf.php';
session_start();

$banColumn = ['Id', 'Nom', 'Prenom', 'MotDePasse', 'Code'];
$fields = [];

if (!isset($_SESSION['row_id'])) { header('Location: index.php'); }

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

$opts1 = [
    'http' => [
        'method'  => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
    ]
];

$context  = stream_context_create($opts);
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/filtered-rows/?table_name=Eleve";
$result = file_get_contents($url, false, $context);
$rep = json_decode($result, true);

$context1  = stream_context_create($opts1);
$url1 =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/columns/?table_name=".$_SESSION['statut'];
$result1 = file_get_contents($url1, false, $context1);
$result1 = json_decode($result1);

foreach ($result1->columns as $column) {
    if ($column->type !== "link" && !in_array($column->name, $banColumn)) {
        $fields[] = $column;
    }
}

$object = $rep["rows"][0];
