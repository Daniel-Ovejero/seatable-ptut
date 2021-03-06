<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Seatable - Ma classe</title>
    <?php include '../Includes/import-css.php' ?>
</head>

<body>
    <?php include '../Actions/get-classe.php' ?>
    <?php include '../Includes/navbar.php' ?>

    <main role="main" id="content">

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
    </main>

    <?php include '../Includes/import-js.php'?>
</body>
</html>
