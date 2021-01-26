<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/css/connexion.css">
</head>

<body>
<div class="container text-center">
    <form class="connexionForm" method="post" action="../Actions/connexion_prof.php">
        <div>
            <label for="username">Email</label>
        </div>
        <div>
            <input class="form-control main-input" id="username" name="username" placeholder="username">
        </div>
        <div class="mt-xl-5">
            <label for="password">Password</label>
        </div>
        <div>
            <input class="form-control main-input" id="password" name="password" placeholder="password" type="password">
        </div>
        <div class="mt-xl-5">
            <button class="btn btn-primary" type="submit">Connexion</button>
            <a class="btn btn-secondary" style="width: 200px; height: 40px" href="mdp-oublie.php">Mot de passe oublié</a>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>