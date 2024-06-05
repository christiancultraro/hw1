<?php
// Avvia la sessione
session_start();

// Verifica se l'utente è loggato
if(!isset($_SESSION['username'])) {
    // Vai alla logi
    header("Location: login_db.php");
    exit;
}

// Ottieni l'ID utente dalla sessione
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id === null) {
    echo "User ID in session is not set.";
    exit;
} else {
    echo "User ID in session: " . $user_id;
}

$conn = new mysqli("localhost", "root", "", "aranzulla");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recupera i preferiti dell'utente
$preferiti = [];
if ($user_id) {
    $query = "SELECT articolo_id FROM preferiti WHERE utente_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $preferiti[] = $row['articolo_id'];
    }
    $stmt->close();

}
$num_preferiti = count($preferiti);
$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
    <title>aranzulla.it</title>
    <link rel="stylesheet" href="mhw3.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="mhw3.js" defer></script>
    <script src="login_db.js" defer></script>
    <script src="caricarticoli.js" defer></script>
    <script>
        // Passa gli ID degli articoli preferiti da PHP al JavaScript utilizzando attributi data
        const user_id = <?php echo json_encode($user_id); ?>;
        const preferiti = <?php echo json_encode($preferiti); ?>;
    </script>

    <script src="gestionepreferiti.js" defer></script>
</head>
<body data-user-id="<?php echo $user_id; ?>" data-preferiti="<?php echo json_encode($preferiti); ?>">
<div class="form-container">
    <button id="close" type="button">X</button>
    <h3>Registrazione Utente</h3>
    <form id="registration-form" action="registrazione.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        
        <input type="submit" value="Registrati">
    </form>
</div>
<div class="form-container2">
    <button id="close2" type="button">X</button>
    <h2>Accesso Utente</h2>
    <form id="login-form" action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
    
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
    
        <input type="submit" value="Accedi">
    </form>
</div>
   
<div class="marginleft"> 
<header>
    <div class="left-content">
        <p>Questo sito contribuisce alla audience di</p>
        <img src="Il_Messaggero.png.png" alt="descrizione" class="immagine-ridotta">
    </div>
    <div class="right-content">
    <p><a href='preferiti.php' class="link-preferiti">| I tuoi preferiti (<?php echo $num_preferiti; ?>) |</a></p>
        <h3>Benvenuto/a <?php echo $_SESSION["username"]; ?>!</h3>
        <p><a href='logout_db.php'>Esci</a></p>
    </div>
</header>
<nav>
<a href="home_db.php"><img src="aranzulla.png" alt="descrizione" class="immagine-ridotta4"></a> <!-- Aggiungi il collegamento alla homepage qui -->
    <span class="blocco1">
        <a href="https://www.aranzulla.it/computer" class="link-personalizzato">Computer</a> |
        <a href="https://www.aranzulla.it/telefonia" class="link-personalizzato">Telefonia</a> |
        <a href="https://www.aranzulla.it/internet" class="link-personalizzato">Internet</a>
    </span>
    <form id="searchForm">
        <input type="text" id="topicInput" placeholder="Cerca una notizia">
        <input type="submit" value="Cerca">
    </form>
    <section id="notizie-view"></section> 
</nav>
<div class="contenitore">
    <div class="block1">
        <img src="ciao.jpg" alt="descrizione" class="immagine-ridotta3">
        <p>Canale Offerte e Sconti su Telegram</p>
    </div>
    <div class="block2">
        <p>Scopri <strong>le migliori offerte</strong> sul canale Telegram ufficiale.</p>
        <a href="https://www.aranzulla.it/computer" class="link-personalizzato2">
  </a>
  <form id="searchForm3" action="ricercarticoli.php" method="get">
    <input type="text" id="topicInput3" name="query" placeholder="Inserisci un argomento">
        <input type="submit" value="Cerca">
    </form>
    </div>
</div>
<div id="api"></div>
<div class="marginleft2">
    <section>
        <div>
            <p>Ultimi articoli pubblicati</p>
        </div>
    </section>
    <main>
        <div id="contenitore-principale">
            <div id="articolo-principale">
                <!-- Contenuto dell'articolo principale -->
                <div class="cuoricino"></div>
            </div>
            <div id="biocompleta">
                <img src="aranzulla2.png" alt="descrizione" class="immagine-ridotta5">
                <div id="bio">
                    <p class="autore">AUTORE --> clicca la foto per farlo sorridere</p>
                    <p class="nome1">Salvatore Aranzulla</p>
                    <p class="bio">Salvatore Aranzulla è il blogger e divulgatore informatico più letto in Italia. Noto per aver scoperto delle vulnerabilità nei siti di Google e Microsoft.</p>
                    <p class="bio">Collabora con riviste di informatica e cura la rubrica tecnologica del quotidiano Il Messaggero. Ha pubblicato per Mondadori e Mondadori Informatica.</p>
                    <p class="bio">È il fondatore di Aranzulla.it, uno dei trenta siti più visitati d'Italia, nel quale risponde con semplicità a migliaia di dubbi di tipo informatico.</p>
                </div>
            </div>
            <div id="articoli-container">
                <!-- Contenuto degli articoli -->
               
            </div>
        </div>
    </main>
    <form id="searchForm2">
        Cerca tra gli album musicali preferiti di Aranzulla
        <input type='text' id='album'>
        <input type='submit' id='submit' value='Cerca'>
    </form>
    <section id="album-view"></section>
    <div class="spazio2"></div>
    <div class="footer1">
        <p>Homepage</p> |
        <p>Chi è Salvatore Aranzulla</p> |
        <p>Iscrizione alla newsletter</p> |
        <p>Contatti</p> |
        <p>Pubblicità</p> |
        <p>Offerte di lavoro</p> |
        <p>Privacy policy</p> |
        <p>Cookie policy</p> |
        <p>Preferenze privacy</p>
    </div>
    <div class="footer2">
        <p>© Aranzulla Srl a socio unico - Piazza della Repubblica 10 - 20121 Milano (MI) - CF e P.IVA: 08200970963 - N. REA: MI 2009810 - C.S.: 10.000,00 € i.v.</p>
    </div>
</div>
</body>
</html>
