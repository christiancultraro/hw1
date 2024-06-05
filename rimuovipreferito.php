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
    echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

$query = "DELETE FROM preferiti WHERE utente_id = ? AND articolo_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $articolo_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>


