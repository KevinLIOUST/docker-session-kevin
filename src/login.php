<?php
// Je charge mon fichier users.php
require_once 'users.php';

// je ne lance mes vérifications uniquement lors d'un post de formulaire = a cliquer sur submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // on créé un tableau d'erreurs vide
    $errors = [];

    if (isset($_POST['mail'])) {

        // Nous allons vérifier que le mail est présent dans nos users
        // je créé une variable $found que je mets par defaut en false
        $found = false;

        // je recherche dans le tableau le mail du $_POST, si je trouve je change la variable $found en true
        foreach ($users as $item) {
            if ($item['mail'] === $_POST['mail']) {
                $found = true;
                // je fais un break pour arrêter toute recherche
                break;
            }
        }

        if (empty($_POST['mail'])) {
            $errors['mail'] = 'Veuillez renseigner une adresse mail';
        } else if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $errors['mail'] = 'Mauvais format de mail';
        } else if ($found === false) {
            $errors['mail'] = 'Pas de mail connu';
        }
    }

    // je lance verification du mdp quand paswword est present dans $_POST et qu'il n'y a pas d'erreur de mail
    if (isset($_POST['password']) && !isset($errors['mail'])) {

        // Je crée un $indexUser par défaut et je lui donne la valeur -1
        $indexUser = -1;

        // Je vais rechercher l'index de mon user à l'aide de son mail

        foreach ($users as $index => $item) {
            if ($item['mail'] === $_POST['mail']) {
                $indexUser = $index;
            }
        }

        if (empty($_POST['password'])) {
            $errors['password'] = 'Veuillez saisir un mot de passe';
        } else if (!password_verify($_POST['password'], $users[$indexUser]['password'])) {
            $errors['password'] = 'Mauvais mot de passe';
        }
    }

    // si il n'y a pas d'erreurs (tableau vide), on redirige vers espace.php
    if (empty($errors)) {
        // on demarre une session php, possible ici plus bas car nous n'utilisons pas de variable de session plus haut
        session_start();

        // on créé une variable de session user avec les infos du user
        $_SESSION['user'] = [
            "mail" => $users[$indexUser]['mail'],
            "role" => $users[$indexUser]['role']
        ];

        header('Location: espace.php');
        exit;

    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session !!!!</title>

    <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" />

    <!-- Lien vers les icônes Bootstrap -->
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">

    <!-- Lien vers le fichier pour designer le site web -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="d-flex justify-content-center mt-3">
        <h1>Entrainement pour la connexion à un compte admin ou utilisateur normal !!!!</h1>
    </div>
    <form action="" method="POST">
        <div class="d-flex justify-content-center">
            <div>
                <div>
                    <label class="text-left" for="mail">Adresse Email <span class="text-danger">*</span><span
                            class="text-danger"><?= isset($errors['mail'])
                                ? $errors['mail']
                                : '' ?></span></label>
                </div>
                <div class="text-center">
                    <input class="mt-1 taille-email design-email" id="mail" type="text" name="mail" placeholder="mail"
                        value="<?= $_POST['mail'] ??
                            '' ?>">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div>
                <div>
                    <label class="mt-3 text-left" for="password">Mot de passe <span class="text-danger">*</span><span
                            class="text-danger"><?= isset($errors['password'])
                                ? $errors['password']
                                : '' ?></span></label>
                </div>
                <div class="text-center">
                    <input class="mt-1 taille-mdp design-mdp" id="password" type="password" name="password"
                        placeholder="mot de passe" value="<?= $_POST['password'] ??
                            '' ?>">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <input type="submit" class="btn btn-connexion" value="Se connecter">
        </div>
    </form>
</body>

</html>