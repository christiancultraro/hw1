<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['articoloId'])) {
    echo json_encode(['success' => false, 'error' => 'Missing article ID']);
    exit;
}

$articolo_id = $data['articoloId'];

$conn = new mysqli("localhost", "root", "", "aranzulla");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$query = "SELECT * FROM preferiti WHERE utente_id = ? AND articolo_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $articolo_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'error' => 'Article already a favorite']);
    exit;
}

$query = "INSERT INTO preferiti (utente_id, articolo_id) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $articolo_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Database error']);
}

$stmt->close();
$conn->close();
?>
