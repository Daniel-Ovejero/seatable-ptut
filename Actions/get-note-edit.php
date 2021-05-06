<?php
require_once '../Includes/conf.php';
session_start();

$id = $_GET['id'];

$notes = [];

$opts = [
    'http' => [
        'method' => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' =>  '{
            "filters":[                                                 
		        {
                    "column_name": "Id",
                    "filter_predicate": "contains",
                    "filter_term": "'.$id.'",
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

$partiel = $rep->rows[0];


$opts = [
    'http' => [
        'method' => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
    ]
];

$context  = stream_context_create($opts);
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/".$partiel->Classe[0]."/?table_id=188J&convert=true";
$result = file_get_contents($url, false, $context);
$classe = json_decode($result);


foreach ($classe->Eleve as $eleve){
    $opts = [
        'http' => [
            'method' => 'GET',
            'header'  => "Content-Type: application/json\r\n".
                "Authorization: Token ".TOKEN."\r\n",
        ]
    ];

    $context  = stream_context_create($opts);
    $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/".$eleve."/?table_id=0000&convert=true";
    $result = file_get_contents($url, false, $context);
    $eleve= json_decode($result);

    $ele = $eleve->Nom . " " . $eleve->Prenom;

    $opts = [
        'http' => [
            'method' => 'GET',
            'header'  => "Content-Type: application/json\r\n".
                "Authorization: Token ".TOKEN."\r\n",
            'content' =>  '{
            "filters":[                                                 
		        {
                    "column_name": "Partiel",
                    "filter_predicate": "contains",
                    "filter_term": "'.$partiel->Id.'",
                    "filter_term_modifier": ""	
		        },
		        {
		            "column_name": "Eleve",
                    "filter_predicate": "contains",
                    "filter_term": "'.$eleve->Id.'",
                    "filter_term_modifier": ""	
		        }
		    ],
		    "filter_conjunction": "And"
	    }'
        ]
    ];

    $context  = stream_context_create($opts);
    $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/filtered-rows/?table_name=Note";
    $result = file_get_contents($url, false, $context);
    $rep = json_decode($result);

    if(!empty($rep->rows)){
        $notes[] = ["eleve" => $ele, 'note' => $rep->rows[0]->Note, "eleveId" => $eleve->Id, 'eleveRowId' => $eleve->_id];
    }
    else{
        $notes[] = ["eleve" => $ele, 'note' => '', "eleveId" => $eleve->Id, 'eleveRowId' => $eleve->_id];
    }
}


