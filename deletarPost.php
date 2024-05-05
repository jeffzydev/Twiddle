<?php

session_start();
include_once("classes/conexao.php");
include_once("classes/manipularDados.php");


if(isset($_POST['postId'])){
    $postId = $_POST['postId'];
    $dados = new ManipularDados();
    $dados->deletarPost($postId);
}

?>
