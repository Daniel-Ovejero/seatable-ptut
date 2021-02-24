<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mes notes</title>
    <?php include_once '../Includes/import-css.php' ?>
</head>

<body>
    <?php include_once '../Actions/get-notes-etu.php' ?>
    <?php include_once '../Includes/navbar.php' ?>
    <div class="accordion" id="accordionId">
            <?php foreach ($matieres as $key => $matiere) {?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="<?= '#' . 'accordion' . $key ?>" aria-expanded="false" aria-controls="<?= 'accordion' . $key ?>">
                        <?php echo $matiere->LibelleMatiere?>
                        <span class="ms-2 text-secondary"> ~
                            <?php
                                $moy = 0;
                                $countNote = 0;
                                foreach ($partiels as $partiel) {
                                    if(in_array($partiel->_id, $matiere->Partiel)) {
                                        foreach ($notes as $note){
                                            if(in_array($partiel->_id, $note->Partiel)) {
                                                $countNote += 1*$partiel->CoefficientPartiel;
                                                $moy += $note->Note * $partiel->CoefficientPartiel;
                                            }
                                        }
                                    }
                                }
                                echo $moy / $countNote;
                            ?>
                        </span>
                        <span class="ms-4 text-secondary"> <?php echo 'Coef: ' . $matiere->CoefficientMatiere ?></span>
                    </button>
                </h2>
                <div id="<?= 'accordion' . $key ?>" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionId">
                    <div class="accordion-body">
                        <ul class="list-group">
                            <?php foreach ($partiels as $partiel) {
                                if(in_array($partiel->_id, $matiere->Partiel)) { ?>
                                <li class="list-group-item">
                                    <?php echo $partiel->LibellePartiel . ': ' ?>
                                    <?php
                                        foreach ($notes as $note){
                                            if(in_array($partiel->_id, $note->Partiel)){
                                                echo $note->Note;
                                            }
                                        }
                                    ?>
                                </li>
                            <?php } } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    <?php include_once '../Includes/import-js.php' ?>
</body>
</html>

