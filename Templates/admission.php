<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Seatable</title>
    <?php include '../Includes/import-css.php' ?>
</head>
<body>

<?php
    include '../Actions/get-admission.php';
    include '../Actions/prof.php';
    include '../Includes/navbar.php';
    include '../Actions/config.php';

    $profs = getAllProf();
    $conf = getConfigByTable('Admission');
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-6">
            <h2>Les Admissions</h2>
        </div>
        <?php
            if ($adminTable) {
        ?>
                <div class="col-md-6 mt-3">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="switchAdmission" <?= $conf->Visible ? 'checked' : '' ?>>
                            <label class="form-check-label" for="switchAdmission">Activer la phase d'admission</label>
                        </div>
                    </div>
                </div>
        <?php
            }
        ?>
    </div>

    <hr>

    <table class="table table-hover">
        <thead>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Fichiers</th>
            <th>Avis</th>
            <th>Commentaire</th>
            <?php
                if ($adminTable) {
            ?>
                    <th>Attribution professeur</th>
            <?php
                }
            ?>
            <th></th>
        </thead>
        <tbody>
        <?php
            foreach ($admissions as $admission) {
                if (in_array($admission->_id, $user->Admission) || $adminTable) {
        ?>
                    <form action="../Actions/action-admission-update.php" class="formAdmission" method="post">
                        <input type="hidden" name="row_id" id="row_id" value="<?= $admission->_id ?>">
                        <input type="hidden" name="prof_id" id="prof_id" value="<?= isset($admission->Professeur[0]) ? $admission->Professeur[0] : '' ?>">
                        <tr>
                            <td><?= isset($admission->Nom) ? $admission->Nom : '' ?></td>
                            <td><?= isset($admission->Prenom) ? $admission->Prenom : '' ?></td>
                            <td>
                                <?php
                                    if (isset($admission->Fichier) && !empty($admission->Fichier)) {
                                        foreach ($admission->Fichier as $file) {
                                ?>
                                            <a target="_blank" href="<?= $file->url ?>"><?= $file->name ?></a>
                                <?php
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <input class="form-control" type="text" name="avis" id="avis" value="<?= isset($admission->Avis) ? $admission->Avis : '' ?>" <?= (isset($admission->Traiter) && $admission->Traiter) ? 'disabled' : '' ?>>
                            </td>
                            <td>
                                <textarea class="form-control" name="commentaire" id="commentaire" cols="40" rows="2" <?= (isset($admission->Traiter) && $admission->Traiter) ? 'disabled' : '' ?>><?= isset($admission->Commentaire) ? $admission->Commentaire : '' ?></textarea>
                            </td>
                            <?php
                                if ($adminTable) {
                            ?>
                                    <td>
                                        <select class="form-select select-prof" name="profAdmiss" id="profAdmiss" <?= $conf->Visible ? 'disabled' : '' ?>>
                                            <option value=""></option>
                                            <?php
                                                foreach ($profs as $prof) {
                                                    $selected = '';
                                                    if (!empty($admission->Professeur)) {
                                                        if ($admission->Professeur[0] == $prof->_id) {
                                                            $selected = 'selected';
                                                        }
                                                    }
                                            ?>
                                                    <option value="<?= $prof->_id ?>" <?= $selected ?>><?= $prof->Nom . ' ' . $prof->Prenom ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                            <?php
                                }
                            ?>
                            <td>
                                <button <?= (($conf->Visible) && (!isset($admission->Traiter) || !$admission->Traiter)) ? : 'hidden' ?> name="submitAdmis" id="submitAdmis" data-toggle="tooltip" title="Valider" class="btn btn-success submit-admiss" type="submit"><i class="fas fa-check"></i></button>
                            </td>
                        </tr>
                    </form>
        <?php
                }
            }
        ?>
        </tbody>
    </table>

</div>

<?php include '../Includes/import-js.php'?>
</body>
</html>
