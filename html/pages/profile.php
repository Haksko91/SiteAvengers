<?php 
        require_once(__DIR__."/../config/mysql.php");
        require_once(__DIR__."/../config/databaseconnect.php");

        $profileStatement = $mysqlClient->prepare("SELECT * FROM users WHERE id=1");
        $profileStatement->execute();
        $profile = $profileStatement->fetchAll();

        $first_name_to_print = $profile[0]['prenom'];
        $second_name_to_print = $profile[0]['nom'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/profile.css">  
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
                <?php if ($hidePage==false): ?>
                    <span class="user-name"><?php echo $_SESSION['prenom'];; ?></span> 
                    <div class="dropdown-content">
                        <a href="pages/profile.php">Profil</a>
                        <a href="pages/logout.php">Déconnexion</a>
                    </div>
                <?php else: ?>
                    <a href="/pages/login.php" class="login-link">Connexion</a> 
                <?php endif; ?>
            </div>
            </div>
        </div>
    </nav>

    <h1>SL</h1>
    <?php session_start(); ?>
    <h3>Bonjours <?php echo $_SESSION['prenom']; echo " "; echo $_SESSION['nom'];?></h3>

    <section id="password-check-section">
        <h1>Tester la sécurité de votre mot de passe !</h1>
        <form id="password-check-form" action="profile.php" method="POST">
            <label>Veuillez entrer votre mot de passe : </label>
            <input name="password_to_check" type="password" required></input>
            <button type="submit">Rechercher</button>
        </form>
        <?php
            // function getApiData($suffix) {
            //     $curl_obj = curl_init();
            //     $cooked_url = "https://api.pwnedpasswords.com/range/" . $suffix;
            //     curl_setopt($curl_obj, CURLOPT_URL, $cooked_url);
            //     $output = curl_exec($curl_obj);
            //     curl_close($curl_obj);
            // }

            // function passwordCheck($password_to_check) {
            //     $hashed_password_to_check = hash('sha1',$password_to_check);
            //     $suffix = substr($hashed_password_to_check, 0, 5);
            //     getApiData($suffix);
            // }

            // $password_to_check = $_POST['password_to_check'];
            // passwordCheck($password_to_check);
        ?> 
    </section>
</body>
</html>