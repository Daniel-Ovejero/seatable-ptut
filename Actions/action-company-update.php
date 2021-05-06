<?php
include './get-information.php';

$row = '';

foreach ($_POST as $key => $value) {
    if ($key !== "row_id" && $key !== "RechercheEmploi") {
        $row .= '"'.$key.'": "'.$value.'"';

        if ($key !== array_key_last($_POST)) { $row .= ','; }
    }
}

if ($_POST['row_id'] == 'new') {
    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => "Content-Type: application/json\r\n".
                "Authorization: Token ".TOKEN."\r\n",
            'content' => '{
   "row": {
            '.$row.'
         },
   "table_name": "Entreprise"
}'
        )
    );
} else {
    $opts = array('http' =>
        array(
            'method'  => 'PUT',
            'header'  => "Content-Type: application/json\r\n".
                "Authorization: Token ".TOKEN."\r\n",
            'content' => '{
   "row": {
            '.$row.'
         },
   "table_name": "Entreprise",
   "row_id": "'.$_POST['row_id'].'"
}'
        )
    );
}


$context  = stream_context_create($opts);
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/";
$result = file_get_contents($url, false, $context);
$company = json_decode($result);

if ($_POST['row_id'] == 'new') {
    $optLink = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/json\r\n".
                "Authorization: Token ".TOKEN."\r\n",
            'content' => '{
            "table_name": "Entreprise",
            "other_table_name": "Anciens",
            "link_id": "cpZ9",
            "table_row_id": "'.$company->_id.'",
            "other_table_row_id": "'.$object['_id'].'"
        }'
        ]
    ];

    $contextLink  = stream_context_create($optLink);
    $resultLink = file_get_contents("https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/links/", false, $contextLink);
}

//curl -H 'Authorization: Token eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6IjFAMS5jb20iLCJkdGFibGVfdXVpZCI6IjYyMmYxZTZkMzM3NDQ5ZTQ5YjQyOWYyMjUzMDM3YTc2In0.3ytwzZsfZwzifAQtsLzn0AFMnEDSeHxkKlIgD6XKuIs' -H "Accept: application/json" -H "Content-type: application/json" -X POST -d '{"table_name": "Table1","other_table_name": "Table2","link_id": '1206'"table_row_id": "OkuYk0OWSIyi7zZKJ2NC4g","other_table_row_id": "eyuMiAwaQlSSr983O03oUA"}' https://cloud.seatable.io/dtable-server/api/v1/dtables/7f7dc9c7187a4d9fb6cfff5e5019a6d5/links/
//var_dump($result);

header("Location: ../Templates/entreprise.php");
