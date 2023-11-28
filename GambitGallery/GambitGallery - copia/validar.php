<?php

session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "chessdb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar la base de datos para el usuario
$usuario = $_POST['username'];
$password = $_POST['password'];

// Consultar la base de datos para el usuario
$sql = "SELECT id, username, email, password FROM users WHERE usuario = '$usuario'";
$sql2 = "SELECT id, username, email, password FROM users WHERE clave_acceso = '$password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Usuario encontrado, verificar la contraseña
    $row = $result->fetch_assoc();
    if ($sql == $sql2) {
        // Contraseña válida, iniciar sesión
        header("Location: index.html"); // Redirige al dashboard o a la página principal
        exit();
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}

$conn->close();

?>
