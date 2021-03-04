<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Seatable - Mot de passe oublié</title>
    <?php include '../Includes/import-css.php' ?>
</head>

<body>

<main role="main" id="content">

    <div class="container text-center">
        <h4 class="title-element">Récupération de mot de passe</h4>
        <?php require_once('../Actions/action-mdp-oublie-prof.php'); if(isset($_GET["section"]) && $_GET["section"] == 'code') { ?>
            Un code de vérification vous a été envoyé par mail: <?php if(isset($_SESSION['Mail'])) echo $_SESSION['Mail'];?>
            <br/>
            <form class="connexionForm" method="post" action="">
                <div>
                    <label for="verif_code">Code de Vérification</label>
                </div>
                <div>
                    <input class="form-control main-input" id="verif_code" type="text" placeholder="Code de vérification" title="Code de vérification" name="verif_code" required/><br/>
                </div>
                <div>
                    <button class="btn btn-primary mt-2" type="submit" title="Valider mon code de vérification">Valider</button>
                </div>
                <?php if(isset($error['code'])){?>
                    <div class="alert alert-danger mt-4 w-50" style="margin-left: auto; margin-right: auto;" role="alert">
                        Votre code n'est pas valide !
                    </div>
                <?php }?>
            </form>
        <?php } elseif(isset($_GET["section"]) && $_GET["section"] == "changemdp") { ?>
            Nouveau mot de passe pour <?php if(isset($_SESSION['Mail'])) echo $_SESSION['Mail']; ?>
            <form class="connexionForm" method="post" action="">
                <input class="form-control main-input mt-2" type="password" placeholder="Nouveau mot de passe" title="Nouveau mot de passe" name="change_mdp" required/><br/>
                <input class="form-control main-input mt-2" type="password" placeholder="Confirmation du mot de passe" title="Confirmation du mot de passe" name="change_mdpc" required/><br/>
                <button class="btn btn-primary mt-2" type="submit" value="Valider" name="change_submit">Changer le mot de passe</button>
                <?php if(isset($error['confirm_mdp'])){?>
                    <div class="alert alert-danger mt-4 w-50" style="margin-left: auto; margin-right: auto;" role="alert">
                        Mauvaise confirmation de votre mot de passe
                    </div>
                <?php }?>
            </form>
        <?php } else { ?>
            <form class="connexionForm" method="post" action="">
                <input class="form-control main-input" autocomplete="email" type="email" placeholder="Votre adresse mail" title="Votre adresse mail" name="recup_mail" required/><br/>
                <button class="btn btn-primary mt-2" type="submit" value="Valider" name="recup_submit" title="valider mon adresse mail">Valider</button>
            </form>
            <?php if(isset($error['doublon'])){?>
                <div class="alert alert-danger mt-4 w-50" style="margin-left: auto; margin-right: auto;" role="alert">
                    Cette adresse email est déjà utilisée
                </div>
            <?php }?>
        <?php } ?>
    </div>
</main>
    <?php include '../Includes/import-js.php' ?>
</body>
</html>
