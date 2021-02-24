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
        </thead>
        <tbody>
        <?php
            foreach ($admissions as $admission) {
                if (in_array($admission->_id, $user->Admission)) {
        ?>
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
                        <td><?= isset($admission->Avis) ? $admission->Avis : '' ?></td>
                        <td><?= isset($admission->Commentaire) ? $admission->Commentaire : '' ?></td>
                    </tr>
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
