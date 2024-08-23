<?php

$request_uri = $_SERVER['REQUEST_URI'];
$url_inicial = "";
$url_inicial_css = "../";
if($request_uri == "/sistemaescolar/api/index.php" || $request_uri == "/sistemaescolar/api/"){
    $url_inicial_css = "http://localhost/sistemaescolar/api/";
    $url_inicial = "api/";
}

//echo 'url_inicial_css: ' . $url_inicial_css . '<br>';
//echo 'request_uri: ' . $request_uri . '<br>';
//echo 'link css completo: ' . $url_inicial_css . 'css/style.css <br>';

echo '
<!DOCTYPE html>
<html lang="pt-br">
    <head>
          <meta charset="UTF-8">
          <title>Sistema Escolar</title>
          <link rel="stylesheet" href="' . $url_inicial_css . 'css/style.css">
          <link rel="stylesheet" href="' . $url_inicial_css . 'css/button.css">
          <link rel="stylesheet" href="' . $url_inicial_css . 'css/header.css">
    </head>
<body class="background-06">
    <div class="header">
        <ul>
            <li><a href="../' . $url_inicial . 'index.php">Home</a></li>
            <li><a href="../' . $url_inicial . 'aluno/consulta_aluno.php">Alunos</a></li>
            <li><a href="../' . $url_inicial . 'professor/consulta_professor.php">Professor</a></li>
            <li><a href="../' . $url_inicial . 'escola/consulta_escola.php">Escola</a></li>
            <li><a href="../' . $url_inicial . 'geradorboletim/index.html">Boletim Escolar</a></li>
        </ul>
        <hr>
    </div>

    <div class="container">';
// abre o container