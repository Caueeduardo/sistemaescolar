<?php
function alterar_turma(){

    $codigoTurmaAlterar = $_POST["codigo"];    
    $escola       = $_POST["escola"];
    $nome         = $_POST["nome"];
    $datainicio   = $_POST["datainicio"];
    $datafim      = $_POST["datafim"];
    $statuscurso  = $_POST["statuscurso"];
    $periodocurso = $_POST["periodocurso"];
    
    $dadosTurmas = @file_get_contents("turmas.json");
    $arDadosTurmas = json_decode($dadosTurmas, true);

    $arDadosTurmasNovo = array();
    foreach($arDadosTurmas as $aDados){
        $codigoAtual = $aDados["codigo"];

        if($codigoTurmaAlterar == $codigoAtual){
            $aDados["nome"] = $nome;
            $aDados["escola"] = (int)$escola;
            $aDados["datainicio"] = $datainicio;
            $aDados["datafim"] = $datafim;
            $aDados["statuscurso"] = $statuscurso;
            $aDados["periodocurso"] = $periodocurso;
        }

        $arDadosTurmasNovo[] = $aDados;
    }

    // Gravar os dados no arquivo
    file_put_contents("turmas.json", json_encode($arDadosTurmasNovo));
}

function excluir_turma(){
    $codigoTurmaExcluir = $_GET["codigo"];

    $dadosTurmas = @file_get_contents("turmas.json");
    $arDadosTurmas = json_decode($dadosTurmas, true);

    $arDadosturmasNovo = array();
    foreach($arDadosTurmas as $aDados){
        $codigoAtual = $aDados["codigo"];
        if($codigoTurmaExcluir == $codigoAtual){
            continue;
        }

        $arDadosTurmasNovo[] = $aDados;
    }

    // Gravar os dados no arquivo
    file_put_contents("turmas.json", json_encode($arDadosTurmasNovo));
}

function incluir_turma(){
    $arDadosturmas = array();

    // Primeiro, verifica se existe dados no arquivo json
    // @ na frente do metodo, remove o warning
    $dadosturmas = @file_get_contents("turmas.json");
    if($dadosturmas){
        // transforma os dados lidos em ARRAY, que estavam em JSON
        $arDadosTurmas = json_decode($dadosturmas, true);
    }

    // Armazenar os dados do turma atual, num array associativo

    $aDadosTurmaAtual = array();
    $aDadosTurmaAtual["codigo"] = getProximoCodigo($arDadosTurmas);

    $aDadosTurmaAtual["escola"]       = $_POST["escola"];
    $aDadosTurmaAtual["nome"]         = $_POST["nome"];
    $aDadosTurmaAtual["datainicio"]   = $_POST["datainicio"];
    $aDadosTurmaAtual["datafim"]      = $_POST["datafim"];
    $aDadosTurmaAtual["statuscurso"]  = $_POST["statuscurso"];
    $aDadosTurmaAtual["periodocurso"] = $_POST["periodocurso"];
    
    // Pega os dados atuais do turma e armazena no array que foi lido
    $arDadosTurmas[] = $aDadosTurmaAtual;

    // Gravar os dados no arquivo
    file_put_contents("turmas.json", json_encode($arDadosTurmas));
}

function getProximoCodigo($arDadosTurmas){
    $ultimoCodigo = 0;
    foreach($arDadosTurmas as $aDados){
        $codigoAtual = $aDados["codigo"];

        if($codigoAtual > $ultimoCodigo){
            $ultimoCodigo = $codigoAtual;
        }      
    }

    return $ultimoCodigo + 1;
}

// echo "<pre>" . print_r($_POST, true) . "</pre>";return true;

// Verificar se esta setado o $_POST
if(isset($_POST["ACAO"])){
    $acao = $_POST["ACAO"];
    if($acao == "INCLUIR"){
        incluir_turma();

        // Redireciona para a pagina de consulta de turma
        header('Location: consulta_turma.php');
    } else if($acao == "ALTERAR"){        
        alterar_turma();

        // Redireciona para a pagina de consulta de turma
        header('Location: consulta_turma.php');
    }
} else if(isset($_GET["ACAO"])){
    $acao = $_GET["ACAO"];
    if($acao == "EXCLUIR"){
        excluir_turma();
        
        // Redireciona para a pagina de consulta de turma
        header('Location: consulta_turma.php');
    } else if($acao == "ALTERAR"){
        // CAMEL CASE
        $codigoTurmaAlterar = $_GET["codigo"];
        
        // Redireciona para a pagina de turma
        header('Location: turma.php?ACAO=ALTERAR&codigo=' . $codigoTurmaAlterar);
    }
} else {
    // Redireciona para a pagina de consulta de turma
    header('Location: consulta_turma.php');
}
