<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F.R.I.D.A.Y - Anthony Stark</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/projects.css">
</head>
<body>
    <?php 
        require_once(__DIR__."/../config/mysql.php");
        require_once(__DIR__."/../config/databaseconnect.php");

        $fridayStatement = $mysqlClient->prepare("SELECT * from projets WHERE projet_name='F.R.I.D.A.Y'");
        $fridayStatement->execute();
        $friday = $fridayStatement->fetchAll();

        $name = $friday[0]['projet_name'];
        $description = $friday[0]['description'];
        $technoString = $friday[0]['techno'];
        $fonctionString = $friday[0]['fonction'];
        $technoArray = explode(',', $technoString);
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
                <p class="project-subtitle">Interface de gestion intelligente</p>
            </header>

            <section class="project-overview">
                <div class="project-image">
                    <img src="../images/friday.jpg" alt="Interface FRIDAY" id="friday_img">
                </div>
                <div class="project-description">
                    <h2>Vue d'ensemble</h2>
                    <p><?php echo $description;?></p>
                    
                    <h3>Technologies utilisées</h3>
                    <?php 
                        if ($technoString) {
                            echo "<ul class='tech-list'>";
                            foreach ($technoArray as $techno) {
                                echo "<li>" . $techno . "</li>";
                            }
                            echo "</ul>";
                        }
                        else {
                            echo "Aucune technologie trouvée.";
                        }
                    ?>

                    <h3>Fonctionnalités</h3>
                    <?php 
                        if ($fonctionString) {
                            echo "<ul>";
                            foreach($fonctionArray as $fonction) {
                                echo "<li>" . $fonction . "</li>";
                            }
                            echo "</ul>";
                        }
                        else {
                            echo "Aucune fonctionnalitée trouvée.";
                        }
                    ?>
                </div>
            </section>

            <section class="project-details-section">
                <h2>Interface utilisateur</h2>
                <div class="code-example">
                    <pre><code>
import { useFriday } from '@friday/core';

function TaskManager() {
    const { tasks, schedule, optimize } = useFriday();
    
    return (
        <div className="dashboard">
            <TaskList tasks={tasks} />
            <Timeline schedule={schedule} />
            <OptimizeButton onClick={optimize} />
        </div>
    );
}
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