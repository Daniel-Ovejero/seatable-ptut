<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Seatable - Mes informations</title>
    <?php include '../Includes/import-css.php' ?>
</head>
<body>

<?php include '../Actions/get-entreprise.php'?>
<?php include '../Includes/navbar.php'?>


<main role="main" id="content">

    <div class="container">
        <h2 class="mt-5">Mon entreprise</h2>
        <hr>

        <form id="formCompany" action="../Actions/action-company-update.php" method="post" enctype="multipart/form-data">

            <input type="hidden" id="row_id" name="row_id" value="<?= isset($companys[0]) ? $companys[0]['_id'] : 'new' ?>">

            <?php
            foreach ($companyFields as $field) {
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
                               value="<?= isset($companys[0][$field->name]) ? $companys[0][$field->name] : "" ?>"
                            <?= ($field->type == 'checkbox' && (isset($object[$field->name]) && $object[$field->name] == '1')) ? 'checked' : '' ?>
                               disabled>
                    </div>
                    <?php
                }
            }
            ?>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                <button id="btnUpdCompany" class="btn btn-outline-info" type="button" title="Modifier mon entreprise">
                    <span aria-hidden="true"><i class="fas fa-user-edit"></i></span> Modifier
                </button>

                <button id="btnSaveCompany" class="btn btn-outline-success ml-1 d-none" type="submit" title="Enregistrer mon entreprise">
                    <span aria-hidden="true"><i class="far fa-save"></i></span> Enregistrer
                </button>
            </div>

        </form>

    </div>
</main>
<?php include '../Includes/import-js.php'?>
</body>
</html>
