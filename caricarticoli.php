<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "aranzulla");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$query = "SELECT id, titolo, immagine, contenuto FROM articoli ORDER BY id DESC LIMIT 11";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$articoli = [];
while ($row = mysqli_fetch_assoc($result)) {
    $articoli[] = $row;
}


$main_article = null;
if (!empty($articoli)) {
    $main_article = array_shift($articoli);
}

mysqli_close($conn);

echo json_encode(['articolo_principale' => $main_article, 'articoli' => $articoli]);
?>







