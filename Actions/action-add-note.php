<?php
session_start();
require_once ('../Includes/conf.php');


$partielId = $_POST['partielId'];
var_dump($_POST);
if (($key = array_search($partielId, $_POST)) !== false) {
    unset($_POST[$key]);
}
var_dump($_POST);

foreach ($_POST as $key => $item){
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
                    "filter_term": "'.$partielId.'",
                    "filter_term_modifier": ""	
		        },
		        {
		            "column_name": "Eleve",
                    "filter_predicate": "contains",
                    "filter_term": "'.$key.'",
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
        $rep = json_decode($result);
        $note = $rep;

        var_dump($note);

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => "Content-Type: application/json\r\n".
                    "Authorization: Token ".TOKEN."\r\n",
                'content' => "{ \n  \"table_name\": \"Note\", \n  \"other_table_name\": \"Partiel\", \n  \"link_id\": \"'pLZP'\", \n  \"table_row_id\": \"".$note->_id."\", \n  \"other_table_row_id\": \"".$partielId."\" \n}"
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
                'content' => "{ \n  \"table_name\": \"Note\", \n  \"other_table_name\": \"Eleve\", \n  \"link_id\": \"'rjhC'\", \n  \"table_row_id\": \"".$note->_id."\", \n  \"other_table_row_id\": \"".$key."\" \n}"
            )
        );
        $context  = stream_context_create($opts);
        $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/". UUID."/links/";
        $result = file_get_contents($url, false, $context);
    }
}


