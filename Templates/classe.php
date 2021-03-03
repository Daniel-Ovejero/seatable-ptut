<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes notes</title>
    <?php include_once '../Includes/import-css.php' ?>
</head>

<body>
    <?php include_once '../Actions/get-classe.php' ?>
    <?php include_once '../Includes/navbar.php' ?>

    <div class="container">
        <h2 class="mt-5"><?php echo $idClasse ?></h2>
        <hr>

        <div class="row justify-content-center">
            <div class="col-3">
                <ul class="list-group text-center">
                    <?php foreach ($eleves as $eleve){ ?>
                        <li class="list-group-item"><?php echo $eleve->Nom." ".$eleve->Prenom ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>



</body>
</html>
