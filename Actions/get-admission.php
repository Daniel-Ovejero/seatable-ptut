<?php
include '../Actions/current-user.php';

$user = getCurrentUser();

$optsAdmiss = [
    'http' => [
        'method'  => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
    ]
];

$contextAdmis  = stream_context_create($optsAdmiss);
$urlAdmission = "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/?table_name=Admission";
$admissions = file_get_contents($urlAdmission, false, $contextAdmis);
$admissions = json_decode($admissions)->rows;

