<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <?php

    include_once '../Includes/import-css.php';
    require_once '../Includes/conf.php';
    session_start();

    ?>
</head>
<body>

<?php include '../Includes/navbar.php';
      include '../Actions/get-all-classe.php';
?>

<div class="container">
    <h2 class="mt-5">Mes informations</h2>
    <hr>

    <form id="formInfo" action="../Actions/action-add-partiel.php" method="post" enctype="multipart/form-data">

        <input type="hidden" id="matiere" name="matiere" value="<?= $_GET["matiere"] ?>">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nameInput">Nom du partiel</label>
                    <input type="text" class="form-control" id="LibellePartiel" name="LibellePartiel">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="firstnameInput">Coefficient</label>
                    <input type="text" class="form-control" id="CoefficientPartiel" name="CoefficientPartiel">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nameInput">Date du partiel</label>
                    <input type="date" class="form-control" id="DatePartiel" name="DatePartiel">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="firstnameInput">Classe</label>
                    <select name="classe" class="form-select">
                        <?php
                        foreach ($classes as $classe){
                        ?>
                        <option><?php echo $classe->LibelleClasse ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <br>

        <div class="row text-right mt-5">
            <div class="col align-self-end">

                <button id="btnSaveInfo" class="btn btn-outline-success ml-1" type="submit"> Enregistrer</button>
            </div>
        </div>

    </form>

</div>

<script type="text/javascript" src="../Assets/js/app.js"></script>
</body>
</html>
