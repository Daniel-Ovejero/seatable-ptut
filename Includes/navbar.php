<?php
require_once '../Includes/conf.php';

const BANTABLES = ['Config'];

if (session_status() === PHP_SESSION_DISABLED) { session_start(); }

$opts = [
    'http' => [
        'method'  => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
    ]
];

$optUser = [
    'http' => [
        'method' => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
        'content' =>  '{
            "filters":[
		        {
                    "column_name": "Id",
                    "filter_predicate": "is",
                    "filter_term": "'.$_SESSION["row_id"].'",
                    "filter_term_modifier": ""	
		        }
		    ],
		    "filter_conjunction": "And"
	    }'
    ]
];

$context  = stream_context_create($opts);
$contextUser  = stream_context_create($optUser);

$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/columns/?table_name=".$_SESSION['statut'];
$urlConf = "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/rows/?table_name=Config";
$urlUser = "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/filtered-rows/?table_name=".$_SESSION['statut'];

$result = file_get_contents($url, false, $context);
$result = json_decode($result);

$configTables = file_get_contents($urlConf, false, $context);
$configTables = json_decode($configTables);

$user = file_get_contents($urlUser, false, $contextUser);
$user = json_decode($user)->rows[0];
?>
    <header role="banner">
        <nav class="navbar navbar-expand-lg navbar-light navbar-inverse" style="background-color: #e3f2fd;" role="navigation" aria-label="Menu de navigation">
            <div class="container-fluid collapse navbar-collapse">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Seatable</a>
                </div>
                <ul class="nav navbar-nav me-auto">
<?php
$adminTable = false;
foreach ($result->columns as $res){
    if($res->type == 'link' && !in_array($res->name, BANTABLES)){
        $visible = true;
        foreach ($configTables->rows as $conf) {
            if ($res->name == $conf->Table) {
                $visible = $conf->Visible;
                if (in_array($user->_id, $conf->Admin)) {
                    $visible = true;
                    $adminTable = true;
                }
            }
        }
        if ($visible) {
?>
            <li class="nav-item">
                <a class="nav-link" style="color: rgb(105,105,105) !important;" href="../Templates/<?= strtolower($res->name) ?>.php"><?= $res->name ?></a>
            </li>
<?php
        }
    }
}
?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item">
                        <a class="nav-link" href="../Templates/detail.php">
                            <span data-toggle="tooltip" title="Mes Informations" aria-hidden="true">
                                <i style="font-size: 24px" class="fas fa-id-card"></i>
                            </span>
                            <span class="hors-ecran">Mes informations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Actions/logout.php">
                            <span data-toggle="tooltip" title="Déconnexion" aria-hidden="true">
                                <i style="font-size: 24px" class="fas fa-sign-out-alt"></i>
                            </span>
                            <span class="hors-ecran">Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
