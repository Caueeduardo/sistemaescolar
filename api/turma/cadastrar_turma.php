<?php
function alterar_turma(){
    $codigoTurmaAlterar = $_POST["codigo"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    
    $dadosTurmas = @file_get_contents("turmas.json");
    $arDadosTurmas = json_decode($dadosTurmas, true);

    $arDadosTurmasNovo = array();
    foreach($arDadosTurmas as $aDados){
        $codigoAtual = $aDados["codigo"];

        if($codigoTurmaAlterar == $codigoAtual){
            $aDados["nome"] = $nome;
            $aDados["email"] = $email;
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
            // ignora e vai para o proximo registro
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
        $arDadosturmas = json_decode($dadosturmas, true);
    }

    // Armazenar os dados do turma atual, num array associativo

    $aDadosturmaAtual = array();
    $aDadosturmaAtual["codigo"] = getProximoCodigo($arDadosturmas);
    $aDadosturmaAtual["nome"] = $_POST["nome"];
    $aDadosturmaAtual["email"] = $_POST["email"];
    $aDadosturmaAtual["senha"] = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    // Pega os dados atuais do turma e armazena no array que foi lido
    $arDadosturmas[] = $aDadosturmaAtual;

    // Gravar os dados no arquivo
    file_put_contents("turmas.json", json_encode($arDadosturmas));
}

function getProximoCodigo($arDadosturmas){
    $ultimoCodigo = 0;
    foreach($arDadosturmas as $aDados){
        $codigoAtual = $aDados["codigo"];

        if($codigoAtual > $ultimoCodigo){
            $ultimoCodigo = $codigoAtual;
        }      
    }

    return $ultimoCodigo + 1;
}

// PROCESSAMENTO DA PAGINA
// echo "<pre>" . print_r($_POST, true) . "</pre>";return true;
// echo "<pre>" . print_r($_GET, true) . "</pre>";return true;

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
        header('Location: turma.php?ACAO=ALTERAR&codigo=' . $codigoturmaAlterar);
    }
} else {
    // Redireciona para a pagina de consulta de turma
    header('Location: consulta_turma.php');
}
