<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seatable - Note Edition</title>
    <?php include_once '../Includes/import-css.php' ?>
</head>

<body>
<?php include_once '../Actions/get-note-edit.php' ?>
<?php include_once '../Includes/navbar.php' ?>

<main role="main" id="content">

    <div class="container">
        <h2 class="mt-5">Notes - <?= $partiel->LibellePartiel ?></h2>
        <hr>

        <form id="formNote" action="../Actions/action-add-note.php" method="post">
            <input id="partielId" name="partielId" class="d-none" value="<?= $partiel->_id ?>">
            <?php foreach ($notes as $key=>$note){ ?>
                <div class="row mb-3">
                    <h3 class="col-8" style="font-size: 20px"><?= $note["eleve"] ?></h3>
                    <input id="<?= $key ?>" class="col-4" value="<?= $note["note"] ?>" name="<?= $note["eleveId"] ?>">
                    <input class="d-none" value="<?= $note["eleveRowId"] ?>" name="<?= $note["eleveRowId"] ?>">
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary ">Valider</button>
        </form>

    </div>

</main>
<?php include_once '../Includes/import-js.php' ?>
</body>
</html>
