<?php
session_start();
require_once ('../Includes/conf.php');
require_once ('./config.php');

$conf = getConfigByTable('Admission');

$opts = [
    'http' => [
        'method' => 'PUT',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' => '{
            "row": {
                "Visible": "'.$_POST['active'].'"
            },
            "table_name": "Config",
            "row_id": "'.$conf->_id.'"
        }'
    ]
];

$context  = stream_context_create($opts);
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/";
$result = file_get_contents($url, false, $context);

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

$traites = [];
foreach ($admissions as $admission) {
    if ($admission->Traiter == 1) {
        $traites[] = $admission->Id;
    }
}

echo json_encode($traites);
