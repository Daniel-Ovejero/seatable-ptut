<?php
require_once '../Includes/conf.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }

function getAllProf() {
    $options = [
        'http' => [
            'method'  => 'GET',
            'header'  => "Content-Type: application/json\r\n".
                "Authorization: Token ".TOKEN."\r\n",
        ]
    ];

    $context = stream_context_create($options);
    $url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/?table_name=Professeur";
    $profs = file_get_contents($url, false, $context);
    $profs = json_decode($profs)->rows;

    return $profs;
}
