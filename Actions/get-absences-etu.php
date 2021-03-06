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
                    "column_name": "Eleve",
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
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/filtered-rows/?table_name=Classe";
$result = file_get_contents($url, false, $context);
$rep = json_decode($result);
$object = $rep->rows[0];

$idClasse = $object->LibelleClasse;


$opts = [
    'http' => [
        'method' => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' =>  '{
            "filters":[                                                 
		        {
                    "column_name": "Classe",
                    "filter_predicate": "contains",
                    "filter_term": "'.$idClasse.'",
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

$opts = [
    'http' => [
        'method' => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' =>  '{
            "filters":[                                                 
		        {
                    "column_name": "Eleve",
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
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/filtered-rows/?table_name=Absence";
$result = file_get_contents($url, false, $context);
$rep = json_decode($result);

$absences = [];
foreach ($rep->rows as $absence){
    $absences[] = $absence;
}

//var_dump($absences);





