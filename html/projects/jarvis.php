<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J.A.R.V.I.S - Anthony Stark</title>
    <link rel="stylesheet" href="../css/projects.css">
    <link rel="stylesheet" href="../css/style.css">
    
</head>
<body>
    <?php
        require_once(__DIR__."/../config/mysql.php");
        require_once(__DIR__."/../config/databaseconnect.php");
    $jarvisStatement = $mysqlClient->prepare('SELECT * FROM projets WHERE projet_name="J.A.R.V.I.S" ');
    $jarvisStatement->execute();
    $jarvis = $jarvisStatement->fetchAll();
    $technoString = $jarvis[0]['techno'];
    $technoArray = explode(',', $technoString);
    $fonctionString = $jarvis[0]['fonction'];
    $fonctionArray = explode(',', $fonctionString)
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
                <h1><?php echo $jarvis[0]['projet_name'];?></h1>
                <p class="project-subtitle">Assistant virtuel intelligent</p>
            </header>

            <section class="project-overview">
                <div class="project-image">
                    <div class="chat-container">
                        <div class="messages" id="messages"></div>
                        <form id="chatForm">
                          <input type="text" id="userInput" placeholder="Posez une question..." required>
                          <button type="submit">Envoyer</button>
                        </form>
                      </div>
                </div>
                <div class="project-description">
                    <h2>Vue d'ensemble</h2>
                    <p><?php echo $jarvis[0]['description'];?></p>
                    
                    <h3>Technologies utilisées</h3>

                    <?php 
                    if ($technoString) {
                      echo '<ul class="tech-list">';
                      foreach ($technoArray as $techno) {
                        echo '<li>' . $techno . '</li>';
                      }
                      echo '</ul>';
                    } else {
                      echo 'Aucune technologie trouvée.';
                    }?>

                    <h3>Fonctionnalités clés</h3>
                    <?php 
                      echo "<ul>";
                      foreach ($fonctionArray as $fonction) {
                        echo "<li>$fonction</li>";
                      }
                      echo "</ul>";
                    ?>
                </div>
            </section>

            <section class="project-details-section">
                <h2>Défis techniques</h2>
                <p>L'un des principaux défis était d'implémenter un système de traitement du langage naturel performant qui puisse comprendre le contexte des projets de développement.</p>
                
                <div class="code-example">
                    <h3>Exemple d'utilisation</h3>
                    <pre><code>
const jarvis = new JARVISAssistant();
await jarvis.analyzeProject({
    repository: 'user/project',
    branch: 'main'
});

const suggestions = await jarvis.getSuggestions();
                    </code></pre>
                </div>
            </section>
        </article>
    </main>

    <script>
        const apiKey = "9da34235df0343818e3ba571127a0fc7";
        const baseURL = "https://api.aimlapi.com";
        const systemPrompt = "You are a JARVIS the assistant of Anthony Stark AKA IronMan act like it whatever we tell you. Start your responses with J.A.R.V.I.S:";
    
        const messagesContainer = document.getElementById("messages");
        const chatForm = document.getElementById("chatForm");
        const userInput = document.getElementById("userInput");
    
        // Ajoute un message dans l'interface
        const addMessage = (text, sender) => {
          const message = document.createElement("div");
          message.className = `message ${sender}`;
          message.textContent = sender === 'user' ? `Vous : ${text}` : text;
          messagesContainer.appendChild(message);
          messagesContainer.scrollTop = messagesContainer.scrollHeight;
        };
    
        // Envoie une requête à l'API
        const callAPI = async (userPrompt) => {
          const response = await fetch(`${baseURL}/chat/completions`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "Authorization": `Bearer ${apiKey}`,
            },
            body: JSON.stringify({
              model: "gpt-3.5-turbo",
              messages: [
                { role: "system", content: systemPrompt },
                { role: "user", content: userPrompt },
              ],
              temperature: 0.7,
              max_tokens: 256,
            }),
          });
    
          const data = await response.json();
          return data.choices[0].message.content;
        };
    
        // Gestion de l'envoi de message
        chatForm.addEventListener("submit", async (e) => {
          e.preventDefault();
          const userMessage = userInput.value;
          addMessage(userMessage, "user");
          userInput.value = "";
    
          try {
            const aiResponse = await callAPI(userMessage);
            addMessage(aiResponse, "ai");
          } catch (error) {
            addMessage("Erreur lors de la connexion à l'API", "ai");
            console.error("Erreur :", error);
          }
        });
      </script>

    <footer>
        <p>© 2024 Anthony Stark. Tous droits réservés.</p>
    </footer>

</body>
</html>