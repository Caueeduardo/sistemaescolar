<?php

$request_uri = $_SERVER['REQUEST_URI'];

$url_inicial = "";
if($request_uri == "/sistemaescolar/api/index.php"){
    $url_inicial = "api/";
}

echo '
<!DOCTYPE html>
<html lang="pt-br">
    <head>
          <meta charset="UTF-8">
          <title>Sistema Escolar</title>
          <link rel="stylesheet" href="../css/style.css">
          <link rel="stylesheet" href="../css/button.css">
    </head>
<body class="background-06">
    <div class="header">
        <ul>
            <li><a href="../' . $url_inicial . 'index.php">Home</a></li>
            <li><a href="../' . $url_inicial . 'aluno/consulta_aluno.php">Alunos</a></li>
            <li><a href="../' . $url_inicial . 'professor/consulta_professor.php">Professor</a></li>
            <li><a href="../' . $url_inicial . 'professor/consulta_professor.php">Professor</a></li>
        </ul>
    </div>

    <div class="container">';
// abre o container