<?php
date_default_timezone_set('America/Fortaleza');
include('conect/conexao.php');
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Fri, 01 Jan 1990 00:00:00 GMT");

// Verificar se o usuário já está autenticado
if (isset($_SESSION["user_id"])) {
    header("Location: index.php"); // Redirecionar para a página após o login
    exit();
}

$errorMensage = '';

if (isset($_POST['login_page'])) {
    $email = cleanInput($_POST["email"]);
    $senha = $_POST["senha"];

    // Modificação aqui para incluir o campo tipo_user na consulta
    $sql = "SELECT user_id, username, foto, senha, tipo_user FROM tb_user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($senha, $row["senha"])) {
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["nome_usuario"] = $row["username"];
            $_SESSION["caminho_foto"] = $row["foto"];
            $_SESSION["tipo_usuario"] = $row["tipo_user"]; // Guarda o tipo de usuário na sessão

            // Registro de acesso - adiciona um novo registro na tabela tb_login_history
            $user_id = $row["user_id"];
            $login_time = date("Y-m-d H:i:s"); // Obtém a data e hora atual
            $insert_login_sql = "INSERT INTO tb_login_history (user_id, login_time) VALUES ('$user_id', '$login_time')";
            $conn->query($insert_login_sql);

            // Verifica se "Lembrar-me" está marcado
            if (isset($_POST["lembrar-me"])) {
                // Define um cookie persistente para lembrar o usuário
                $expiracao = time() + 30 * 24 * 60 * 60; // Expira em 30 dias
                setcookie("lembrar_usuario_id", $row["user_id"], $expiracao, "/");
            }

            // Redirecionamento com base no tipo_user
            if ($row["tipo_user"] == '1' || $row["tipo_user"] == '2') {
                header("Location: index.php"); // Redirecionar para a página normal após o login
            } elseif ($row["tipo_user"] == '3') {
                header("Location: adm/index.php"); // Redirecionar para a página de administração
            }
            exit();
        } else {
            $errorMensage = '<div class="alert alert-danger mt-3" style="position:absolute; top:100px; width: 70%;"">
                    <div class="d-flex align-items-center">
                        <span class="mr-2">
                            <i class="fas fa-exclamation-circle"></i> <!-- Ícone de aviso (usando Font Awesome) -->
                        </span>
                        <p class="mb-0">
                            Senha incorreta.
                        </p>
                    </div>
                </div>';
        }
    } else {
        $errorMensage = '<div class="alert alert-danger mt-3" style="position:absolute; top:100px; width: 70%;">
                    <div class="d-flex align-items-center">
                        <span class="mr-2">
                            <i class="fas fa-exclamation-circle"></i> <!-- Ícone de aviso (usando Font Awesome) -->
                        </span>
                        <p class="mb-0">
                            Usuário não encontrado.
                        </p>
                    </div>
                </div>';
    }
}

function cleanInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="shortcut icon" href="icon.png" type="image/x-icon">
    <title>Login</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #000924; /* Cor de fundo ajustada conforme solicitado */
        }

        .card {
            width: 100%;
            max-width: 400px;
            background-color: #000924; /* Cor de fundo do card para combinar com o body */
            color: #ffffff; /* Cor do texto para garantir visibilidade */
        }

        .form-control {
            background-color: #000924; /* Cor de fundo dos inputs para combinar com o body */
            border: 1px solid #ffffff; /* Cor da borda dos inputs para combinar */
            color: #ffffff; /* Cor do texto dos inputs para garantir visibilidade */
        }

        .form-control:focus {
            background-color: #000924; /* Mantém a cor de fundo ao focar */
            border-color: #ffffff; /* Mantém a cor da borda ao focar */
            color: #ffffff; /* Mantém a cor do texto ao focar */
        }

        .btn-primary {
            width: 100%;
            background-color: #ffffff; /* Cor de fundo dos botões */
            border-color: #ffffff; /* Cor da borda dos botões */
            color: #000924; /* Cor do texto dos botões */
        }

        .btn-primary:hover {
            background-color: #ffffff; /* Cor de fundo ao passar o mouse */
            border-color: #ffffff; /* Cor da borda ao passar o mouse */
            color: #000924; /* Cor do texto ao passar o mouse */
        }

        .password-input {
            position: relative;
        }

        .password-icon {
            color: #ffffff; /* Cor do ícone de senha para garantir visibilidade */
            position: absolute;
            right: 10px;
            top: calc(50% - 0.5rem); /* Ajusta a posição do ícone */
            cursor: pointer;
        }

        .logo {
            width: 100%;
            max-width: 200px;
            margin: 0 auto 20px; /* Centraliza a logo e adiciona espaço abaixo */
        }
    </style>
    <script>
        $(document).ready(function () {
            $(".password-icon").click(function () {
                var senhaInput = $("#senha");
                var tipo = senhaInput.attr("type");

                if (tipo === "password") {
                    senhaInput.attr("type", "text");
                    $(this).removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    senhaInput.attr("type", "password");
                    $(this).removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        });
    </script>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="logo.png" alt="Logo" class="logo">
            </div>
            <?php echo $errorMensage; ?>
            <form action="" method="post" id="form-cont">
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Seu e-mail...">
                </div>

                <div class="form-group password-input">
                    <input type="password" class="form-control" id="senha" name="senha" required placeholder="Sua senha...">
                    <i class="fas fa-eye password-icon"></i>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="lembrar-me" name="lembrar-me">
                        <label class="form-check-label" for="lembrar-me">Lembrar-me</label>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" name="login_page">Login</button>
                </div>
            </form>
            <div class="text-center">
                <span>Ainda não tem cadastro? <a href="index.php?acao=cadastro">Faça um agora!</a></span>
            </div>
        </div>
    </div>
</body>
</html>