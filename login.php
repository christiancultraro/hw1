<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: home_db.php");
    exit;
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $conn = mysqli_connect("localhost", "root", "", "aranzulla");

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM utente WHERE username = '$username' AND password_hash = '$password'";
    $res = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION["username"] = $row["username"];
        $_SESSION["user_id"] = $row["utente_id"];
        header("Location: home_db.php");
        exit;
    } else {
        $errore = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Accesso Utente</h2>
    <form action="" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Accedi">
    </form>

    <?php
    if (isset($errore)) {
        echo "<p class='errore'>Credenziali non valide.</p>";
    }
    ?>
</body>
</html>

