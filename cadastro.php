<?php
include_once("classes/conexao.php");
include_once("classes/manipularDados.php");

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $manipularDados = new ManipularDados();

    if ($manipularDados->cadastrarUsuario($username, $password)) {
        header("Location: login.php");
        exit;
    } else {
        $error_message = "Erro ao cadastrar usuário. Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Twiddle</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body class="dark-mode">
    <header>
        <div id="header">Twiddle</div>
    </header>
    <div id="container-loginForm">
        <div id="loginForm">
            <form action="cadastro.php" method="post">
                <input type="text" name="username" placeholder="Nome de usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <button type="submit" id="cadastroButton">Cadastrar</button>
                <?php if(isset($error_message)) { ?>
                    <p class="error"><?php echo $error_message; } ?></p>
                <div id="container-voltarLogin">
                    <a href="login.php" id="voltarLogin">Já tenho uma conta</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
