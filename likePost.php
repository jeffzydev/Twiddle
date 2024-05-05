<?php
session_start();

include_once("classes/conexao.php");
include_once("classes/manipularDados.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codPost'])) {
    $codPost = $_POST['codPost'];
    $username = $_SESSION['username'];

    $dados = new ManipularDados();
    echo $dados->adicionarLike($codPost, $username);
}
?>