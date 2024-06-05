
<?php

$conn = mysqli_connect("localhost", "root", "", "aranzulla");

// Verifica se ci sono dati POST
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    
    $query = "SELECT * FROM utente WHERE username = '$username'";
    $res = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($res) > 0) {
       
        echo "<script>alert('Il nome utente esiste già. Scegli un altro nome utente.');</script>";
    } else {
        
        $password_hash = password_hash($password, PASSWORD_BCRYPT); // Hash della password
        $query = "INSERT INTO utente (username, password_hash, email) VALUES ('$username', '$password_hash', '$email')";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registrazione avvenuta con successo!'); window.location.href='mhw3.php';</script>";
        } else {
            echo "<script>alert('Errore durante la registrazione. Riprova.');</script>";
        }
    }
}

mysqli_close($conn);
?>


