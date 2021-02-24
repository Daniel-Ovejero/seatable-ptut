<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Seatable</title>
    <?php include '../Includes/import-css.php' ?>
</head>
<body>

<?php include '../Actions/get-admission.php'?>
<?php include '../Includes/navbar.php'?>

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
            <th></th>
        </thead>
        <tbody>
        <?php
            foreach ($admissions as $admission) {
                if (in_array($admission->_id, $user->Admission)) {
        ?>
                    <form action="../Actions/action-admission-update.php" class="formAdmission" method="post">
                        <input type="hidden" name="row_id" id="row_id" value="<?= $admission->_id ?>">
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
                                <input type="text" name="avis" id="avis" value="<?= isset($admission->Avis) ? $admission->Avis : '' ?>">
                            </td>
                            <td>
                                <textarea name="commentaire" id="commentaire" cols="40" rows="2"><?= isset($admission->Commentaire) ? $admission->Commentaire : '' ?></textarea>
                            </td>
                            <td>
                                <button id="submitAdmis" data-toggle="tooltip" title="Valider" class="btn btn-success" type="submit"><i class="fas fa-check"></i></button>
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
