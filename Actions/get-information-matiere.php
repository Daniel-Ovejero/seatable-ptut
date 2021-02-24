<?php
require_once '../Includes/conf.php';
session_start();

if (!isset($_SESSION['row_id'])) { header('Location: index.php'); }

$opts = [
    'http' => [
        'method' => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' =>  '{
            "filters":[                                                 
		        {
                    "column_name": "Professeur",
                    "filter_predicate": "contains",
                    "filter_term": "'.$_SESSION["row_id"].'",
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


$matieres = [];
foreach ($rep->rows as $matiere){
    $matieres[] = $matiere;
}


$partiels = [];
foreach ($matieres as $matiere){

    $opts = [
        'http' => [
            'method' => 'GET',
            'header'  => "Content-Type: application/json\r\n".
                "Authorization: Token ".TOKEN."\r\n",
            'content' =>  '{
            "filters":[                                                 
		        {
                    "column_name": "Matiere",
                    "filter_predicate": "contains",
                    "filter_term": "'.$matiere->LibelleMatiere.'",
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

    foreach ($rep->rows as $partiel){
        $partiels [] = $partiel;
    }

}