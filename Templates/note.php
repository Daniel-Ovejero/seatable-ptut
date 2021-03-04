<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Seatable - Mes notes</title>
    <link rel="stylesheet" href="../Assets/css/note.css">
    <?php include_once '../Includes/import-css.php' ?>
</head>

<body>
    <?php include_once '../Actions/get-notes-etu.php' ?>
    <?php include_once '../Includes/navbar.php' ?>

    <main role="main" id="content">

    <div class="container">
        <h2 class="mt-5">Mes notes</h2>
        <hr>

        <div class="accordion accordion-flush" id="accordionId">
                <?php foreach ($matieres as $key => $matiere) {?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="<?= '#' . 'accordion' . $key ?>" aria-expanded="false" aria-controls="<?= 'accordion' . $key ?>">
                            <span class="span-header"><?php echo $matiere->LibelleMatiere?></span>
                            <span class="span-header ms-2 text-secondary"> ~
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
                            <span class="span-header ms-4 text-secondary"> <?php echo 'Coef: ' . $matiere->CoefficientMatiere ?></span>
                        </button>
                    </h2>
                    <div id="<?= 'accordion' . $key ?>" class="accordion-collapse collapse" aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
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
    </div>
    </main>
    <?php include_once '../Includes/import-js.php' ?>
</body>
</html>

