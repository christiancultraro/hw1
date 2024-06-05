<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "aranzulla");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

$sql = "SELECT id, titolo, immagine, contenuto FROM articoli WHERE titolo LIKE '%$query%' OR contenuto LIKE '%$query%'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$articoli = [];
while ($row = mysqli_fetch_assoc($result)) {
    $articoli[] = $row;
}

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
</head>
<body>
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
    <form id="searchForm3" action="ricercasenzalogin.php" method="get">
    <input type="text" id="topicInput3" name="query" placeholder="Inserisci un argomento">
        <input type="submit" value="Cerca">
    </form>
        <button id="registrazione" type="button">Registrazione</button>
        <button id="loginbutton" type="button">Login</button>
    </div>
</header>

        <nav>
        <a href="index.php"><img src="aranzulla.png" alt="descrizione" class="immagine-ridotta4"></a> <!-- Aggiungi il collegamento alla homepage qui -->
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
      

        <title>Risultati della ricerca</title>
    <link rel="stylesheet" href="mhw3.css" />
</head>
<body>
    <h2>Risultati della ricerca per "<?php echo htmlspecialchars($query); ?>"</h2>
    <ul>
    <?php foreach ($articoli as $articolo): ?>
        <li>
            <h3><a href="visualizzarticoli.php?id=<?php echo $articolo['id']; ?>"><?php echo htmlspecialchars($articolo['titolo']); ?></a></h3>
            <img src="<?php echo htmlspecialchars($articolo['immagine']); ?>" alt="<?php echo htmlspecialchars($articolo['titolo']); ?>" style="width:200px;height:150px;">
        </li>
    <?php endforeach; ?>
</ul>
    <p>
        <a href="<?php echo isset($_SESSION['user_id']) ? 'home_db.php' : 'mhw3.php'; ?>">
            Torna alla home page
        </a>
    </p>

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




