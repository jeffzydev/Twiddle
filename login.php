<?php
session_start();

include_once("classes/conexao.php");
include_once("classes/manipularDados.php");

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $manipularDados = new ManipularDados();

    if ($manipularDados->verificarCredenciais($username, $password)) {
        $_SESSION["username"] = $username;
        $_SESSION["loggedin"] = true;
        header("Location: index.php");
        exit;
    } else {
        $error_message = "Usuário ou senha incorretos. Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Twiddle</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body class="dark-mode">
    <header>
        <div id="header">Twiddle</div>
    </header>
    <div id="container-loginForm">
    <div id="loginForm">
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Nome de usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit" id="loginButton">Login</button>
            <?php if(isset($error_message)) { ?>
                <p class="error"><?php echo $error_message; }
                ?></p>
                <div id="container-criarConta">
            <a href="cadastro.php" id="criarConta" >Não tenho uma conta</a>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
