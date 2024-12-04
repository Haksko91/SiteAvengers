<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<nav>
    <div class="nav-links">
        <a href="../index.php">Accueil</a>
        <a href="about.php">À propos</a>
        <a href="contact.php">Contact</a>
    </div>
    <div class="nav-img">
        <img src="../images/user.png" alt="User Icon" class="user-icon">
        <div class="dropdown">
            <span class="user-name">Alexandre</span>
            <div class="dropdown-content">
                <a href="profile.php">Profil</a>
                <a href="logout.php">Déconnexion</a>
            </div>
        </div>
    </div>
</nav>

<main>
<section class="login"> 
<div class="form">
<form id="form_login" action="login.php" method="POST">
    <label for="username">Nom d'utilisateur</label>
    <input name="username" type="text" required>
    
    <label for="password">Mot de passe</label>
    <input name="password" type="password" required>
    
    <button type="submit">Se connecter</button>
</form>
<div class="register-a">
<a href="register.php">Créer un compte</a>
</div>
</div>
</section>




<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once(__DIR__.'/../config/mysql.php');
    $connexion = mysqli_connect(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DB_NAME);

    if (!$connexion) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    $sql = "SELECT id, prenom, nom, admin FROM users WHERE username = ? AND password = ?";
    if ($stmt = mysqli_prepare($connexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $prenom, $nom, $admin);
        mysqli_stmt_fetch($stmt);

        if ($id) {
            $_SESSION['id'] = $id;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['nom'] = $nom;
            $_SESSION['admin'] = $admin;
            $_SESSION['username'] = $username;
            header("Location: /../index.php"); 
            exit();
        } else {
            $error_message = "Nom d'utilisateur et/ou mot de passe incorrect.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Erreur de préparation de la requête : " . mysqli_error($connexion);
    }

    mysqli_close($connexion);
}
?>

<?php
if (isset($error_message)) {
    echo "<div id='center_echo'>$error_message</div>";
}
?>
</main>
<footer>
    <p>© 2024 Anthony Stark. Tous droits réservés.</p>
</footer>
</body>
</html>