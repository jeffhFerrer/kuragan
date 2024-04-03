<?php
session_start();
session_destroy(); // Encerrar a sessão

// Remover o cookie "lembrar_usuario_id" se existir
if (isset($_COOKIE["lembrar_usuario_id"])) {
    setcookie("lembrar_usuario_id", "", time() - 3600, "/");
}

// Redirecionar para a página de login
header("Location: index.php");
exit();
?>