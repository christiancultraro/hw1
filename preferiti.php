<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$conn = mysqli_connect("localhost", "root", "", "aranzulla");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Recupera gli articoli preferiti dell'utente
$preferiti_query = "SELECT a.titolo, a.immagine, a.contenuto FROM preferiti AS p JOIN articoli AS a ON p.articolo_id = a.id WHERE p.utente_id = $user_id";
$preferiti_res = mysqli_query($conn, $preferiti_query);

if (!$preferiti_res) {
    die("Query failed: " . mysqli_error($conn));
}

$preferiti = [];
while ($row = mysqli_fetch_assoc($preferiti_res)) {
    $preferiti[] = $row;
}
$num_preferiti = count($preferiti);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>I tuoi preferiti</title>
    <link rel="stylesheet" href="mhw3.css" />
    <link rel="stylesheet" href="preferiti.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="mhw3.js" defer></script>
    <script src="login_db.js" defer></script>
    <script src="caricarticoli.js" defer></script>
    <script src="gestionepreferiti.js" defer></script>
    
    <script>
        const userPreferiti = <?php echo json_encode($preferiti); ?>;
    </script>
</head>
<body data-user-id="<?php echo $user_id; ?>">
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
                <p><a href='preferiti.php'>| I tuoi preferiti (<?php echo $num_preferiti; ?>) |</a></p>
                <h3>Benvenuto/a <?php echo $_SESSION["username"]; ?>!</h3>
                <p><a href='logout_db.php'>Esci</a></p>
            </div>
        </header>

        <nav>
        <a href="home_db.php"><img src="aranzulla.png" alt="descrizione" class="immagine-ridotta4"></a> 
            <span class="blocco1">
                <a href="https://www.aranzulla.it/computer" class="link-personalizzato">Computer</a> |
                <a href="https://www.aranzulla.it/telefonia" class="link-personalizzato">Telefonia</a> |
                <a href="https://www.aranzulla.it/internet" class="link-personalizzato">Internet</a>
            </span>
            <form id="searchForm">
                <input type="text" id="topicInput" placeholder="Inserisci un argomento">
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
                    <div class="block3"><p>Guarda su telegram</p></div>
                </a>
            </div>
        </div>

        <div id="api"></div>

        <div class="marginleft2">
      

            <h2>I tuoi preferiti</h2>
            <ul>
                <?php foreach ($preferiti as $preferito): ?>
                    <li class="articolo">
                        <img src="<?php echo $preferito['immagine']; ?>" alt="<?php echo $preferito['titolo']; ?>">
                        <div>
                            <h3><?php echo $preferito['titolo']; ?></h3>
                            <p><?php echo $preferito['contenuto']; ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

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
