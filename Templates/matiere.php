<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seatable - Partiels</title>
    <?php include_once '../Includes/import-css.php' ?>
</head>

<body>
<?php include_once '../Actions/get-information-matiere.php' ?>
<?php include_once '../Includes/navbar.php' ?>

<main role="main" id="content">

    <div class="container">
        <h2 class="mt-5">Matières</h2>
        <hr>

        <div class="accordion" id="accordionId">
            <?php foreach ($matieres as $key => $matiere) { ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="<?= '#' . 'accordion' . $key ?>" aria-expanded="false" aria-controls="<?= 'accordion' . $key ?>">
                            <?php echo $matiere->LibelleMatiere ?>
                        </button>
                        <a href="formulaire-ajout-partiel.php?matiere=<?php echo $matiere->LibelleMatiere ?>" title="ajouter un partiel">+</a>

                    </h2>
                    <div id="<?= 'accordion' . $key ?>" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionId">
                        <div class="accordion-body">
                            <ul class="list-group">
                                <?php foreach ($partiels as $partiel) {
                                    if(in_array($partiel->_id, $matiere->Partiel)) { ?>
                                        <li class="list-group-item">
                                            <a href="note-edit.php<?= "?id=".$partiel->Id?>"><?php echo $partiel->LibellePartiel . ' | coefficient : ' . $partiel->CoefficientPartiel . ' | Date du partiel :'. $partiel->DatePartiel  ?></a>
                                        </li>
                                    <?php } } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</main>
<?php include_once '../Includes/import-js.php' ?>
</body>
</html>