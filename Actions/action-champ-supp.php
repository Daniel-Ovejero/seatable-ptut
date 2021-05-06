<?php

session_start();

include_once("../Includes/conf.php");

// Fait une recherche en fonction du $_POST["table"] dans la table ChampSupp > Table
// Supprime toute les lignes correspondante.

$opts = array('http' =>
    array(
        'method'  => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",

        'content' =>  '{
        "filters":[
		{
			"column_name": "Table",

			"filter_predicate": "is",

			"filter_term": "'.$_POST["table"].'",

			"filter_term_modifier": ""	
		}
		],
		"filter_conjunction": "And"
	}'
    )
);

$context  = stream_context_create($opts);
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/filtered-rows/?table_name=ListeChamps";
$result = file_get_contents($url, false, $context);
$rep = json_decode($result, true);
$rep = $rep["rows"];
foreach ($rep as $key=>$row){

    /*
    $curl = curl_init();


    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_POSTFIELDS =>"{\n\t\"table_name\": \"ListeChamps\", \n    \"row_id\": \"".$row["_id"]."\"\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Token ".TOKEN ,
            "Accept: application/json",
            "Content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    */
    $opts = array('http' =>
        array(
            'method'  => 'DELETE',
            'header'  => "Content-Type: application/json\r\n".
                "Authorization: Token ".TOKEN."\r\n",
            'content' => "
{\n\t\"table_name\": \"ListeChamps\", \n    \"row_id\": \"".$row["_id"]."\"\n}
"
        )
    );
    $context  = stream_context_create($opts);
    $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/";
    $result = file_get_contents($url, false, $context);
}

/*
 * Pour chaque $_POST autre que "table",
 * creer une row dans la table ChampSupp avec Table = $_POST["table"] et Colonne = $_POST[$i]
 */
foreach ($_POST as $key=>$value) {

    if($key != "table") {
        /*
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{ \n\t\"row\": {\n        \"Table\": \"".$_POST["table"]."\",\n        \"Colonne\": \"".$value."\"\n   }, \n\t\"table_name\": \"ListeChamps\" \n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Token ".TOKEN."",
                "Accept: application/json",
                "Content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        */
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => "Content-Type: application/json\r\n".
                    "Authorization: Token ".TOKEN."\r\n",
                'content' => "
{ \n\t\"row\": {\n        \"Table\": \"".$_POST["table"]."\",\n        \"Colonne\": \"".$value."\"\n   }, \n\t\"table_name\": \"ListeChamps\" \n}"
            )
        );
        $context  = stream_context_create($opts);
        $url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/";
        $result = file_get_contents($url, false, $context);
    }
}
