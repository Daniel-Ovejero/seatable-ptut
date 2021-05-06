<?php
require_once '../Includes/conf.php';
session_start();

$companys = [];

$optsAnciens = [
    'http' => [
        'method'  => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
    ]
];

$context  = stream_context_create($optsAnciens);
$url = "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/?table_name=Anciens";
$anciens = file_get_contents($url, false, $context);
$anciens = json_decode($anciens)->rows;

foreach ($anciens as $key => $value) {
    if (sizeof($value->Entreprise) != 0) {
        $urlCompany = "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/".$value->Entreprise[0]."/?table_id=Mo01&convert=true";
        $company = file_get_contents($urlCompany, false, $context);
        $company = json_decode($company);

        $strCompany = '';
        $strAdresse = '';
        if (isset($company->RaisonSocial)) { $strCompany .= $company->RaisonSocial . '<br>'; }

        if (isset($company->Adresse)) { $strAdresse .= $company->RaisonSocial . ' - '; }
        if (isset($company->CodePostal)) { $strAdresse .= $company->CodePostal . ' '; }
        if (isset($company->Ville)) { $strAdresse .= $company->Ville . '<br>'; }

        $strCompany .= $strAdresse;

        if (isset($company->Telephone)) { $strCompany .= $company->Telephone . '<br>'; }
        if (isset($company->Email)) { $strCompany .= $company->Email; }

        $companys[$key] = $strCompany;
    }
}
