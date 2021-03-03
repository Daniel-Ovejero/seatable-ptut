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

    $profs = getAllProf();
?>

<div class="container">
    <h2 class="mt-5">Les Admissions</h2>
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
                                <input class="form-control" type="text" name="avis" id="avis" value="<?= isset($admission->Avis) ? $admission->Avis : '' ?>">
                            </td>
                            <td>
                                <textarea class="form-control" name="commentaire" id="commentaire" cols="40" rows="2"><?= isset($admission->Commentaire) ? $admission->Commentaire : '' ?></textarea>
                            </td>
                            <?php
                                if ($adminTable) {
                            ?>
                                    <td>
                                        <select class="form-select select-prof" name="profAdmiss" id="profAdmiss">
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
                                <?php
                                    foreach ($configTables->rows as $conf) {
                                        if ($conf->Table == 'Admission' && $conf->Visible) {
                                ?>
                                            <button id="submitAdmis" data-toggle="tooltip" title="Valider" class="btn btn-success" type="submit"><i class="fas fa-check"></i></button>
                                <?php
                                        }
                                    }
                                ?>
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
