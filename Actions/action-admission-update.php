<?php
session_start();
require_once ('../Includes/conf.php');

$opts = [
    'http' => [
        'method' => 'PUT',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' => '{
            "row": {
                "Avis": "'.$_POST['avis'].'",
                "Commentaire": "'.$_POST['commentaire'].'"
            },
            "table_name": "Admission",
            "row_id": "'.$_POST['rowId'].'"
        }'
    ]
];

$context  = stream_context_create($opts);
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/";
$result = file_get_contents($url, false, $context);
