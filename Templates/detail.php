<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
</head>
<body>

    <?php include '../Actions/get-information.php'?>
    <?php include '../Includes/navbar.php'?>

    <div class="container">
        <h2 class="mt-5">Mes informations</h2>
        <hr>

        <form id="formInfo" action="../Actions/action-update.php" method="post" enctype="multipart/form-data">

            <input type="hidden" id="row_id" name="row_id" value="<?= $object["_id"] ?>">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nameInput">Nom</label>
                        <input type="text" class="form-control" id="nameInput" name="nameInput" value="<?= isset($object["Nom"]) ? $object["Nom"] : "" ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstnameInput">Prénom</label>
                        <input type="text" class="form-control" id="firstnameInput" name="firstnameInput" value="<?= isset($object["Prenom"]) ? $object["Prenom"] : "" ?>" disabled>
                    </div>
                </div>
            </div>
            <br>

            <?php
            foreach ($fields as $field) {
            ?>
                <div class="form-group">
                    <label for="<?= $field->name ?>Input"><?= $field->name ?></label>
                    <input type="text" class="form-control" id="<?= $field->name ?>Input" name="<?= $field->name ?>" value="<?= isset($object[$field->name]) ? $object[$field->name] : "" ?>" disabled>
                </div>
            <?php
            }
            ?>

            <div class="row text-right mt-5">
                <div class="col align-self-end">

                    <button id="btnUpdInfo" class="btn btn-outline-info" type="button"><i class="fas fa-user-edit"></i> Modifier</button>

                    <button id="btnSaveInfo" class="btn btn-outline-success ml-1 d-none" type="submit"><i class="far fa-save"></i> Enregistrer</button>
                </div>
            </div>

        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../Assets/js/app.js"></script>
</body>
</html>
