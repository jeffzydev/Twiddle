<?php
session_start();

include_once("classes/conexao.php");
include_once("classes/manipularDados.php");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$dados = new ManipularDados();

$_SESSION['bio'] = $dados->recuperarBiografia($_SESSION['username']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['bio'])) {
        $bio = $_POST['bio'];
        $dados->atualizarBiografia($_SESSION['username'], $bio);
        $_SESSION['bio'] = $bio;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurar Perfil - Twiddle</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body class="dark-mode">
<header>
        <div id="header">Twiddle</div>
    </header>
    <div id="container-profileConfig">
    <div id="profileConfigForm">
    <form action="profile.php" method="post">
        <img src="img/profilePicture/defaultIcon.png" id="profile-picture-profile" alt="Foto de Perfil" />
        <br />
        <div id="profile-bio">
            <h1><?php echo $_SESSION['username']; ?></h1>
            <textarea name="bio" placeholder="Digite sua biografia..."><?php echo $_SESSION['bio']; ?></textarea>
            <button type="submit">Salvar</button>
        </div>
    </form>
</div>
    <nav>
        <ul>
        <li><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" class="bi bi-house-door-fill icon" viewBox="0 0 16 16">
                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
              </svg><a href="index.php"> Home</a></li>

            <li><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" class="bi bi-bell icon" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
              </svg><a href="#"> Notifications</a></li>

            <li><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" class="bi bi-envelope icon" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
              </svg><a href="#"> Messages</a></li>

            <li><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" class="bi bi-bookmarks icon" viewBox="0 0 16 16">
                <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1z"/>
                <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1"/>
              </svg><a href="#"> Bookmarks</a></li>

            <li><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" class="bi bi-person-fill icon" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a 3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
              </svg><a href="profile.php"> Profile</a></li>

            <li><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" class="bi bi-three-dots icon" viewBox="0 0 16 16">
                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
              </svg><a href="#"> More</a></li>
        </ul>
    </nav>
    <button id="themeButton">Alternar Tema</button>
    <div id="themeMenu">
    <div class="themeOption" id="lightThemeOption">Tema Claro<br><img src="img/themeIlustration.jpg" id="themeLightIlustration"/></div>
        <div class="themeOption" id="darkThemeOption">Tema Escuro<br><img src="img/themeIlustration.jpg" id="themeBlackIlustration" /></div>
        <div class="themeOption" id="blueThemeOption">Tema Azul (Twitter)<br><img src="img/blueThemeIlustration.jpg" id="themeBlueIlustration" /></div>
        <button id="themeMenuButton">Concluído</button>
      </div>
    <script src="js/script.js"></script>
</div>
</body>
</html>
