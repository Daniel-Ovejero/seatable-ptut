<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mes notes</title>
    <?php include_once '../Includes/import-css.php' ?>
</head>

<body>
    <?php include_once '../Actions/get-classe.php' ?>
    <?php include_once '../Includes/navbar.php' ?>

    <h1 class="text-center"><?php echo $idClasse ?></h1>

    <hr>
    <div class="row justify-content-center">
        <div class="col-3">
            <ul class="list-group list-group-flush text-center">
                <?php foreach ($eleves as $eleve){ ?>
                    <li class="list-group-item"><?php echo $eleve->Nom." ".$eleve->Prenom ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>


</body>
</html>
