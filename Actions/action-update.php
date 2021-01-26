<?php
session_start();
require_once ('../Includes/conf.php');


$opts = array('http' =>
    array(
        'method'  => 'PUT',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' => '{
   "row": {"Name": "'.$_POST['nameInput'].'",
        "Naissance": "'.$_POST['dateNaissInput'].'",
        "Email": "'.$_POST['mailInput'].'",
        "Telephone": "'.$_POST['phoneInput'].'",
        "Adresse": "'.$_POST['addressInput'].'",
        "CP": "'.$_POST['cpInput'].'",
        "Ville": "'.$_POST['villeInput'].'",
         },
   "table_name": "Eleve",
   "row_id": "'.$_POST['row_id'].'"
}'
    )
);
$context  = stream_context_create($opts);
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/";
$result = file_get_contents($url, false, $context);

//curl -H 'Authorization: Token eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6IjFAMS5jb20iLCJkdGFibGVfdXVpZCI6IjYyMmYxZTZkMzM3NDQ5ZTQ5YjQyOWYyMjUzMDM3YTc2In0.3ytwzZsfZwzifAQtsLzn0AFMnEDSeHxkKlIgD6XKuIs' -H "Accept: application/json" -H "Content-type: application/json" -X POST -d '{"table_name": "Table1","other_table_name": "Table2","link_id": '1206'"table_row_id": "OkuYk0OWSIyi7zZKJ2NC4g","other_table_row_id": "eyuMiAwaQlSSr983O03oUA"}' https://cloud.seatable.io/dtable-server/api/v1/dtables/7f7dc9c7187a4d9fb6cfff5e5019a6d5/links/
//var_dump($result);

header("Location: ../Templates/detail.php");
