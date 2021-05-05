<?php
include '../Actions/get-information.php';

$companyFields = [];
$companys = [];

$optsCompany = [
    'http' => [
        'method'  => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
    ]
];

$contextCompany  = stream_context_create($optsCompany);
$urlCompany =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/?table_name=Entreprise";
$resultCompany = file_get_contents($urlCompany, false, $contextCompany);
$repCompany = json_decode($resultCompany, true)['rows'];

$contextFieldsCompany  = stream_context_create($optsCompany);
$urlFieldsCompany =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/columns/?table_name=Entreprise";
$resultFieldsCompany = file_get_contents($urlFieldsCompany, false, $contextFieldsCompany);
$resultFieldsCompany = json_decode($resultFieldsCompany);

foreach ($resultFieldsCompany->columns as $column) {
    if ($column->type !== "link" && !in_array($column->name, $banColumn)) {
        $companyFields[] = $column;
    }
}
foreach ($repCompany as $company) {
    if (in_array($company['_id'], $object['Entreprise'])) {
        $companys[] = $company;
    }
}