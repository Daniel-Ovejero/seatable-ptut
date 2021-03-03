<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <?php include '../Includes/import-css.php' ?>
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
                <div class="col-md-3">
                    <img class="w-100 img-fluid rounded-circle" style="height: 250px; object-fit: cover" src="<?= (empty($object['Photo']) || (!is_file($object['Photo']))) ? '../Assets/images/image_default.png':'../'.$object['Photo'] ?>" alt="">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nameInput">Nom</label>
                        <input type="text" class="form-control" id="nameInput" name="nameInput" value="<?= isset($object["Nom"]) ? $object["Nom"] : "" ?>" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="firstnameInput">Prénom</label>
                        <input type="text" class="form-control" id="firstnameInput" name="firstnameInput" value="<?= isset($object["Prenom"]) ? $object["Prenom"] : "" ?>" disabled>
                    </div>
                </div>
            </div>
            <br>

            <?php
            var_dump((isset($object['Photo']) || (is_file($object['Photo']))));
            foreach ($fields as $field) {
                if($field->name == "Photo"){
                ?>
                    <div class="mb-3">
                        <label class="form-label" for="<?= $field->name ?>Input"><?= $field->name ?></label>
                        <input type="file" class="form-control" id="<?= $field->name ?>Input" name="<?= $field->name ?>" disabled>
                    </div>
                <?php
                }
                else {
                    ?>
                    <div class="mb-3">
                        <label class="form-label" for="<?= $field->name ?>Input"><?= $field->name ?></label>
                        <input type="<?= $field->type ?>" class="form-control" id="<?= $field->name ?>Input"
                               name="<?= $field->name ?>"
                               value="<?= isset($object[$field->name]) ? $object[$field->name] : "" ?>" disabled>
                    </div>
                    <?php
                }
            }
            ?>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                    <button id="btnUpdInfo" class="btn btn-outline-info" type="button"><i class="fas fa-user-edit"></i> Modifier</button>

                    <button id="btnSaveInfo" class="btn btn-outline-success ml-1 d-none" type="submit"><i class="far fa-save"></i> Enregistrer</button>
            </div>

        </form>

    </div>

    <?php include '../Includes/import-js.php'?>
</body>
</html>
