<?php
require_once '../Includes/conf.php';

if (session_status() === PHP_SESSION_DISABLED) { session_start(); }

$opts = [
    'http' => [
        'method'  => 'GET',
        'header'  => "Content-Type: application/json\r\n".
            "Authorization: Token ".TOKEN."\r\n",
    ]
];

$context  = stream_context_create($opts);
$url =  "https://cloud.seatable.io/dtable-server/api/v1/dtables/".UUID."/columns/?table_name=".$_SESSION['statut'];
$result = file_get_contents($url, false, $context);


$result = json_decode($result);
?>
        <nav class="navbar navbar-expand-lg navbar-light navbar-inverse" style="background-color: #e3f2fd;">
            <div class="container-fluid collapse navbar-collapse">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Seatable</a>
                </div>
                <ul class="nav navbar-nav mr-auto">
<?php
foreach ($result->columns as $res){
    if($res->type == 'link'){
?>
                    <li class="nav-item">
                        <a class="nav-link" href="../Templates/<?= $_SESSION['statut'] ?>/<?= strtolower($res->name) ?>.php"><?= $res->name ?></a>
                    </li>
<?php
    }
}
?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item">
                        <a title="Mes Informations" class="nav-link" href="../Templates/detail.php"><i style="font-size: 24px" class="fas fa-id-card"></i></a>
                    </li>
                    <li class="nav-item">
                        <a title="Déconnexion" class="nav-link" href="../Actions/logout.php"><i style="font-size: 24px" class="fas fa-sign-out-alt"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
