<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des Messages</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin_panel.css">
</head>
<body>

<nav>
    <div class="nav-content">
        <div class="logo">AS</div>
        <div class="nav-links">
            <a href="../index.php">Accueil</a>
            <a href="about.php">À propos</a>
            <a href="contact.php">Contact</a>
        </div>
        <div class="nav-img">
            <img src="../images/user.png" alt="User Icon" class="user-icon">
            <div class="dropdown">
                <span class="user-name">Alex</span>
                <div class="dropdown-content">
                    <a href="profile.php">Profil</a>
                    <a href="logout.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>
</nav>

    <div id="titre_admin"><h1>Message reçu</h1></div>
    <?php

    require_once(__DIR__ . "/../config/mysql.php");
    require_once(__DIR__ . "/../config/databaseconnect.php");
    require_once(__DIR__ . "/../security/sessions.php");

    $messagesStatement = $mysqlClient->prepare("SELECT * from messages");
    $messagesStatement->execute();
    $messages = $messagesStatement->fetchAll();

    foreach ($messages as $message) {
        $nom = $message['nom'];
        $email = $message['email'];
        $message_content = $message['message'];
        echo "<div class='about-content1'>";
        echo "<div class='message-entry'>";
        echo "<p><strong>Nom:</strong> " . htmlspecialchars($nom) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
        echo "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message_content)) . "</p>";
        echo "</div>";
        echo "</div>";
    }
    ?>


<footer>
        <p>© 2024 Anthony Stark. Tous droits réservés.</p>
    </footer>

</body>
</html>