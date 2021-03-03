<?php
session_start();
require_once ('../Includes/conf.php');


$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/links/";

if (isset($_POST["lastProf"]) && $_POST['lastProf'] != '') {
    $optDel = [
        'http' => [
            'method'  => 'DELETE',
            'header'  => "Content-Type: application/json\r\n".
                "Authorization: Token ".TOKEN."\r\n",
            'content' => '{
                "table_name": "Admission",
                "other_table_name": "Professeur",
                "link_id": "FG7s",
                "table_row_id": "'.$_POST['rowId'].'",
                "other_table_row_id": "'.$_POST["lastProf"].'"
            }'
        ]
    ];

    $context  = stream_context_create($optDel);
    $result = file_get_contents($url, false, $context);
}

$optLink = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' => '{
            "table_name": "Admission",
            "other_table_name": "Professeur",
            "link_id": "FG7s",
            "table_row_id": "'.$_POST['rowId'].'",
            "other_table_row_id": "'.$_POST['prof'].'"
        }'
    ]
];

$contextLink  = stream_context_create($optLink);
$resultLink = file_get_contents($url, false, $contextLink);
