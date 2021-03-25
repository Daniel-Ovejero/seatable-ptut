<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Seatable - Connexion</title>
    <?php include '../Includes/import-css.php' ?>
    <link rel="stylesheet" href="../Assets/css/connexion.css">
</head>

<body>

<main role="main" id="content">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <form class="connexionForm" method="post" action="../Actions/action-connexion-etu.php">
                    <div>
                        <label class="form-label" for="username">Email</label>
                        <input class="form-control" id="username" autocomplete="username" name="username" title="Nom d'utilisateur" required placeholder="Nom d'utilisateur">
                    </div>
                    <div class="mt-xl-5">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control" id="password" name="password" placeholder="mot de passe" title="mot de passe" required type="password">
                    </div>
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="ancien" id="ancien" value="true">
                        <label class="form-check-label" for="ancien">Ancien étudiant</label>
                    </div>
                    <div class="mt-xl-5 text-center">
                        <button class="btn btn-primary" type="submit" title="se connecter en tant qu'étudiant">Se Connecter</button>
                        <a class="btn btn-secondary" style="width: 200px; height: 40px" href="mdp-oublie.php">Mot de passe oublié</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
