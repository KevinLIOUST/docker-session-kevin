<?php
require_once 'users.php';

// var_dump($_POST);

// On lance uniquement quand il y a un formulaire validé via la méthode SESSION
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    if (isset($_POST['email'])) {
        // On va vérifier si c'est vide
        if (empty($_POST['email'])) {
            // je crée une erreur dans mon tableau
            $errors['email'] = 'Mail obligatoire';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Mail non valide';
        } else {
            $email = '';
            $id = 0;
            $role = '';
            for ($i = 0; $i < count($users); $i++) {
                if ($_POST['email'] == $users[$i]['mail']) {
                    $email = $_POST['email'];
                    $_SESSION['email'] = $email;

                    $id = $users[$i]['id'];
                    $_SESSION['id'] = $id;

                    $role = $users[$i]['role'];
                    $_SESSION['role'] = $role;
                    break;
                }
            }
            if ($_POST['email'] != $email) {
                $errors['email'] = 'Mail incorrect';
            }
        }
    }

    if (isset($_POST['mdp'])) {
        $mdp = $_POST['mdp'];
        // On va vérifier si c'est vide
        if (empty($_POST['mdp'])) {
            // je crée une erreur dans mon tableau
            $errors['mdp'] = 'Mot de passe obligatoire';
        } else {
            $mdp = '';
            for ($i = 0; $i < count($users); $i++) {
                if ($_POST['mdp'] == $users[$i]['password']) {
                    $mdp = $_POST['mdp'];
                    $_SESSION['mdp'] = $mdp;
                }
            }
            if ($_POST['mdp'] != $mdp) {
                $errors['mdp'] = 'Mot de passe incorrect';
            }
        }
    }

    for ($i = 0; $i < count($users); $i++) {
        if (($_POST['email'] == $users[$i]['mail']) && ($_POST['mdp'] == $users[$i]['password']) && (empty($errors))) {
            header("Location: espace.php?id=" . $_SESSION["id"] . "?role=" . $_SESSION['role']);
        } elseif (!($_POST['email'] != $users[$i]['mail']) || !($_POST['mdp'] != $users[$i]['password'])) {
            $errors['matchPas'] = 'Le mot de passe et l\'adresse mail ne matchent pas avec le même utilisateur';
        }
    }

    // var_dump($errors);
    // var_dump($_SESSION);
}
?>

<!DOCTYPE html>
<html lang="en">

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
                    <label class="text-left" for="email">Adresse Email <span class="text-danger">*</span><span class="text-danger"><?= isset($errors['email']) ? $errors['email'] : '' ?></span></label>
                </div>
                <div class="text-center">
                    <input class="mt-1 taille-email design-email" id="email" type="text" name="email" placeholder="email" value="<?= $_POST['email'] ?? '' ?>">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div>
                <div>
                    <label class="mt-3 text-left" for="mdp">Mot de passe <span class="text-danger">*</span><span class="text-danger"><?= isset($errors['mdp']) ? $errors['mdp'] : '' ?></span></label>
                </div>
                <div class="text-center">
                    <input class="mt-1 taille-mdp design-mdp" id="mdp" type="password" name="mdp" placeholder="mot de passe" value="<?= $_POST['mdp'] ?? '' ?>">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <span class="text-danger"><?= isset($errors['matchPas']) ? $errors['matchPas'] : '' ?></span>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <input type="submit" class="btn btn-connexion" value="Se connecter">
        </div>
    </form>
</body>

</html>