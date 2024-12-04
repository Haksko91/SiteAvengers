<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Ultron - Anthony Stark</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/projects.css">
</head>
<body>

    <?php 
    
    require_once(__DIR__."/../config/mysql.php");
    require_once(__DIR__."/../config/databaseconnect.php");

    $ultronStatement = $mysqlClient->prepare("SELECT * FROM projets WHERE projet_name='Projet Ultron'");
    $ultronStatement->execute();
    $ultron = $ultronStatement->fetchAll();

    $name = $ultron[0]['projet_name'];
    $description = $ultron[0]['description'];
    $technoString = $ultron[0]['techno'];
    $fonctionString = $ultron[0]['fonction'];
    $technoArray = explode(',',$technoString);
    $fonctionArray = explode(',', $fonctionString);

    ?>

<nav>
        <div class="nav-content">
            <div class="logo">A.S</div>
            <div class="nav-links">
                <a href="../index.php" class="active">Accueil</a>
                <a href="../pages/about.php">À propos</a>
                <a href="../pages/contact.php">Contact</a>
                <a href="../pages/login.php">Login</a>
            </div>
        </div>
    </nav>

    <main>
        <article class="project-details">
            <header class="project-header">
                <h1><?php echo $name;?></h1>
                <p class="project-subtitle">Système de sécurité intelligent</p>
            </header>

            <section class="project-overview">
                <div class="project-image">
                    <img src="../images/ultron.jpg" alt="Interface Ultron" id="ultron_img">
                </div>
                <div class="project-description">
                    <h2>Vue d'ensemble</h2>
                    <p><?php echo $description;?></p>
                    
                    <h3>Technologies utilisées</h3>
                    <?php 
                        if ($technoString){
                            echo "<ul class='tech-list'>";
                            foreach ($technoArray as $techno) {
                                echo "<li>" . $techno . "</li>";
                            }
                            echo "</ul>";
                        }
                        else{
                            echo "Aucune technologie trouvée.";
                        }
                    ?>

                    <h3>Fonctionnalités</h3>
                    <?php 
                    echo "<ul>";
                    foreach ($fonctionArray as $fonction) {
                        echo "<li>" . $fonction . "</li>";
                    }
                    echo "</ul>";
                    ?>
                </div>
            </section>

            <section class="project-details-section">
                <h2>Architecture du système</h2>
                <div class="code-example">
                    <pre><code>
from ultron.core import SecuritySystem
from ultron.detectors import AnomalyDetector

system = SecuritySystem()
detector = AnomalyDetector(
    threshold=0.85,
    mode='realtime'
)

@system.on_threat_detected
async def handle_threat(threat_data):
    await system.trigger_alert(threat_data)
    await system.log_incident(threat_data)
                    </code></pre>
                </div>
            </section>
        </article>
    </main>

    <?php
    if (!isset($_SESSION['id'])) {
        
        $hidePage = true;  
        echo "<footer class='fixeddd'> <p>© 2024 Anthony Stark. Tous droits réservés.</p> </footer>";
    } else {
        $hidePage = false;  
        echo "<footer> <p>© 2024 Anthony Stark. Tous droits réservés.</p> </footer>";
        
    }
?>

</body>
</html>