<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seatable - Partiels</title>
    <?php include_once '../Includes/import-css.php' ?>
</head>

<body>
<?php include_once '../Actions/get-all-anciens.php' ?>
<?php include_once '../Includes/navbar.php' ?>

<main role="main" id="content">

    <div class="container">
        <h2 class="mt-5">Anciens étudiants</h2>
        <hr>

        <div class="accordion" id="accordionId">
            <?php foreach ($anciens as $key => $ancien) { ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="<?= '#' . 'accordion' . $key ?>" aria-expanded="false" aria-controls="<?= 'accordion' . $key ?>">
                            <?php echo $ancien->Nom . ' ' . $ancien->Prenom ?>
                        </button>
                    </h2>
                    <div id="<?= 'accordion' . $key ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionId">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><i class="fas fa-phone"></i> <?= $ancien->Telephone ?? '' ?></p>
                                    <p><i class="fas fa-envelope"></i> <?= $ancien->Email ?? '' ?></p>
                                    <p><i class="fas fa-home"></i> <?= $ancien->Adresse ?? '' ?> <br> <?= $ancien->CodePostal ?? '' ?> <?= $ancien->Ville ?? '' ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><i class="fas fa-building"></i> <?= sizeof($ancien->Entreprise) != 0 ? $companys[$key] : '' ?></p>
                                    <p>
                                        <i class="fas fa-fw fa-circle text-<?= (isset($ancien->RechercheEmploi) && $ancien->RechercheEmploi == '1') ? 'success' : 'danger' ?>"></i><?= (isset($ancien->RechercheEmploi) && $ancien->RechercheEmploi == '1') ? 'Recherche un emploi' : 'Ne recherche pas d\'emploi' ?>
                                    </p>
                                </div>
                            </div>
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