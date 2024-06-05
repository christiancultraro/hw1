<?php
session_start();

// Verifica se l'utente è loggato
if(!isset($_SESSION['username'])) {
    // Vai alla pagina di login
    header("Location: login_db.php");
    exit;
}

// Ottieni l'ID utente dalla sessione
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id === null) {
    echo "User ID in session is not set.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "aranzulla");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recupera gli ID degli articoli preferiti dell'utente
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

$conn->close();

// Restituisci gli ID degli articoli preferiti come risposta JSON
echo json_encode($preferiti);
?>


