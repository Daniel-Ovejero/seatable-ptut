<?php
session_start();
require_once ('../Includes/conf.php');

$partielReturn = null;

$partielId = $_POST['partielId'];
if (($key = array_search($partielId, $_POST)) !== false) {
    unset($_POST[$key]);
}

foreach ($_POST as $key => $item){
    $opts = [
        'http' => [
            'method' => 'GET',
            'header'  => "Content-Type: application/json\r\n".
                "Authorization: Token ".TOKEN."\r\n",
        ]
    ];

    $context  = stream_context_create($opts);
    $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/".$key."/?table_id=0000&convert=true";
    $result = file_get_contents($url, false, $context);
    $eleve = json_decode($result);

    $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/".$partielId."/?table_id=aJ7v&convert=true";
    $result = file_get_contents($url, false, $context);
    $partiel = json_decode($result);

    $partielReturn = $partiel;

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

    if(!empty($rep->rows[0])){
        $opts = array('http' =>
            array(
                'method'  => 'PUT',
                'header'  => "Content-Type: application/json\r\n".
                    "Authorization: Token ".TOKEN."\r\n",
                'content' => '{
               "row": {
                        "Note": '.$item.'
                     },
               "table_name": "Note",
               "row_id": "'.$rep->rows[0]->_id.'"
            }'
            )
        );
        $context  = stream_context_create($opts);
        $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/";
        $result = file_get_contents($url, false, $context);
        $note = $rep;
    }
    else{
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n" .
                    "Authorization: Token " . TOKEN . "\r\n",
                "Accept : application/json",
                "Content-type: application/json",
                'content' => '{
                   "row": {
                        "Note": '.$item.'
                   },
                   "table_name" : "Note"
                }'
            )
        );
        $context = stream_context_create($opts);
        $url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/" . UUID . "/rows/";
        $result = file_get_contents($url, false, $context);
        $note = json_decode($result);

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => "Content-Type: application/json\r\n".
                    "Authorization: Token ".TOKEN."\r\n",
                'content' => '{
                    "table_name": "Note",
                    "other_table_name": "Partiel",
                    "link_id": "pLZP",
                    "table_row_id": "'.$note->_id.'",
                    "other_table_row_id": "'.$partielId.'"
                }'
            )
        );
        $context  = stream_context_create($opts);
        $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/". UUID."/links/";
        $result = file_get_contents($url, false, $context);

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => "Content-Type: application/json\r\n".
                    "Authorization: Token ".TOKEN."\r\n",
                'content' => '{
            "table_name": "Note",
            "other_table_name": "Eleve",
            "link_id": "rjhC",
            "table_row_id": "'.$note->_id.'",
            "other_table_row_id": "'.$key.'"
        }'
            )
        );
        $context  = stream_context_create($opts);
        $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/". UUID."/links/";
        $result = file_get_contents($url, false, $context);
    }
}

header("Location: ../Templates/note-edit.php?id=".$partielReturn->Id);

