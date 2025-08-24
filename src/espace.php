<?php
require_once 'users.php';

// var_dump($_GET);

// $email = '';
// $role = '';
// $id = 0;

if (isset($_GET['id']) && isset($_GET['role'])) {
    $role = htmlspecialchars($_GET['role']);
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    $email = $users[$id]['mail'];
}

// header("Location: logout.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace personnel !!!!</title>

    <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" />

    <!-- Lien vers les icônes Bootstrap -->
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">

    <!-- Lien vers le fichier pour designer le site web -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="cat">
                <img class="taille-logo" src="assets/img/Logo_Doctogeek_3.png" alt="assets/img/Logo_Doctogeek_3.png">
            </div>
            <div class="d-flex justify-content-end align-items-center w-100">
                <?php if ($role == "admin") { ?>
                    <button class="btn design-button ms-3 design-btn-admin">Gérer les utilisateurs</button>
                    <button class="btn design-button ms-3 design-btn-admin">Gérer les rendez-vous</button>
                <?php } ?>
                <button class="btn design-button ms-3">Consulter mes rendez-vous</button>
                <button class="btn design-button ms-3">Prendre un rendez-vous</button>
                <p class="mx-3 mt-3"><?= $email ?></p>
            </div>
            <form class="d-flex" method="POST" action="logout.php">
                <input class="btn design-button" type="submit" name="logout" value="Déconnexion">
            </form>
        </div>
    </nav>
</body>

</html>