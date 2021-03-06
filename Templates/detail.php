<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Seatable - Mes informations</title>
    <?php include '../Includes/import-css.php' ?>
</head>
<body>

    <?php include '../Actions/get-information.php'?>
    <?php include '../Includes/navbar.php'?>


    <main role="main" id="content">

    <div class="container">
        <h2 class="mt-5">Mes informations</h2>
        <hr>

        <form id="formInfo" action="../Actions/action-update.php" method="post" enctype="multipart/form-data">

            <input type="hidden" id="row_id" name="row_id" value="<?= $object["_id"] ?>">

            <div class="row">
                <div class="col-md-3">
                    <img class="w-100 img-fluid rounded-circle" style="height: 250px; object-fit: cover" src="<?= (empty($object['Photo'])) ? '../Assets/images/image_default.png':'..'.$object['Photo'] ?>" alt="photo de profil">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nameInput">Nom</label>
                        <input type="text" class="form-control" id="nameInput" name="nameInput" required value="<?= isset($object["Nom"]) ? $object["Nom"] : "" ?>" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="firstnameInput">Prénom</label>
                        <input type="text" class="form-control" id="firstnameInput" name="firstnameInput" required value="<?= isset($object["Prenom"]) ? $object["Prenom"] : "" ?>" disabled>
                    </div>
                </div>
            </div>
            <br>

            <?php
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
                        <input type="<?= $field->type ?>" class="<?= $field->type == 'checkbox' ? 'form-check-input' : 'form-control' ?>" id="<?= $field->name ?>Input"
                               name="<?= $field->name ?>"
                               value="<?= isset($object[$field->name]) ? $object[$field->name] : "" ?>"
                               <?= ($field->type == 'checkbox' && (isset($object[$field->name]) && $object[$field->name] == '1')) ? 'checked' : '' ?>
                               disabled>
                    </div>
                    <?php
                }
            }
            ?>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                    <button id="btnUpdInfo" class="btn btn-outline-info" type="button" title="Modifier mes informations personnelles">
                        <span aria-hidden="true"><i class="fas fa-user-edit"></i></span> Modifier
                    </button>

                    <button id="btnSaveInfo" class="btn btn-outline-success ml-1 d-none" type="submit" title="Enregistrer mes informations personnelles">
                        <span aria-hidden="true"><i class="far fa-save"></i></span> Enregistrer
                    </button>
            </div>

        </form>

    </div>
    </main>
    <?php include '../Includes/import-js.php'?>
</body>
</html>
