<?php
// var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {

    // La session en question
    session_start();
    // Détruire toutes les variables de session
    session_unset();

    // Détruire la session
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deconnexion</title>

    <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" />

    <!-- Lien vers les icônes Bootstrap -->
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">

    <!-- Lien vers le fichier pour designer le site web -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="d-flex justify-content-center mt-3">
        <h1>Vous avez été déconnecté avec succès !!!!</h1>
    </div>
    <script>
        setTimeout(function() {
            window.location.href="login.php";
        }, 3000);
    </script>
</body>

</html>