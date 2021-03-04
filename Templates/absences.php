<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mes absences</title>
    <link rel="stylesheet" href="../Assets/css/note.css">
    <?php include_once '../Includes/import-css.php' ?>
</head>

<body>
    <?php include_once '../Actions/get-absences-etu.php' ?>
    <?php include_once '../Includes/navbar.php' ?>

    <main role="main" id="content">
    <div class="container">
        <h2 class="mt-5">Mes absences</h2>
        <hr>

        <div class="accordion accordion-flush" id="accordionId">
            <?php foreach ($matieres as $key => $matiere) {?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="<?= '#' . 'accordion' . $key ?>" aria-expanded="false" aria-controls="<?= 'accordion' . $key ?>">
                            <span class="span-header"><?php echo $matiere->LibelleMatiere?></span>
                            <span class="span-header-alert ms-2 text-danger">
                                <?php
                                    $countAbsence = 0;
                                    foreach ($absences as $absence) {
                                        if(in_array($absence->_id, $matiere->Absence)) {
                                            if($absence->Justifie === 0) {
                                                ++$countAbsence;
                                            }
                                        }
                                    }
                                    echo $countAbsence . ($countAbsence > 1 ? ' absences injustifiées' : ' absence injustifiée');
                                ?>
                            </span>
                        </button>
                    </h2>
                    <div id="<?= 'accordion' . $key ?>" class="accordion-collapse collapse" aria-labelledby="headingOne">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($absences as $absence) {
                                    if(in_array($absence->_id, $matiere->Absence)) { ?>
                                        <?php if($absence->Justifie === 0) {?>
                                            <li class="list-group-item text-danger">
                                                <span class="span-content"><?php echo $absence->DateAbsence ?></span>
                                                <span class="span-content">Injustifiée</span>
                                            </li>
                                        <?php } else {?>
                                            <li class="list-group-item text-success">
                                                <span class="span-content"><?php echo $absence->DateAbsence ?></span>
                                                <span class="span-content">Justifiée</span>
                                            </li>
                                        <?php }?>
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


