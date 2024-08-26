<?php
function alterar_escola(){
    $codigoAlterar = $_POST["codigo"];

    // Pega os dados da tela
    $descricao = $_POST["descricao"];
    $cidade = $_POST["cidade"];
    
    list(
        $tipo_ensino_creche,
        $tipo_ensino_basico,
        $tipo_ensino_fundamental,
        $tipo_ensino_medio,
        $tipo_ensino_profissional,
        $tipo_ensino_tecnico,
        $tipo_ensino_superior) = getTipoEnsino();

    $arDados = @file_get_contents("escola.json");
    $arDados = json_decode($arDados, true);

    $arDadosNovo = array();
    foreach($arDados as $aDados){
        $codigoAtual = $aDados["codigo"];
        if($codigoAlterar == $codigoAtual){
            // Passa os dados da tela para o array atual
            $aDados["descricao"] = $descricao;
            $aDados["cidade"] = $cidade;
            $aDados["tipo_ensino_creche"] = $tipo_ensino_creche;
            $aDados["tipo_ensino_basico"] = $tipo_ensino_basico;
            $aDados["tipo_ensino_fundamental"] = $tipo_ensino_fundamental;
            $aDados["tipo_ensino_medio"] = $tipo_ensino_medio;
            $aDados["tipo_ensino_profissional"] = $tipo_ensino_profissional;
            $aDados["tipo_ensino_tecnico"] = $tipo_ensino_tecnico;
            $aDados["tipo_ensino_superior"] = $tipo_ensino_superior;
        }

        $arDadosNovo[] = $aDados;
    }

    // Gravar os dados no arquivo
    file_put_contents("escola.json", json_encode($arDadosNovo));
}

function excluir_registro($pagina){
    $codigoExcluir = $_GET["codigo"];

    $arDados = @file_get_contents($pagina . ".json");
    $arDados = json_decode($arDados, true);

    $arDadosNovo = array();
    foreach($arDados as $aDados){
        $codigoAtual = $aDados["codigo"];
        if($codigoExcluir == $codigoAtual){
            continue;
        }
        $arDadosNovo[] = $aDados;
    }

    // Gravar os dados no arquivo
    file_put_contents($pagina . ".json", json_encode($arDadosNovo));
}

function getTipoEnsino(){
    $tipo_ensino_creche = 0;
    $tipo_ensino_basico = 0;
    $tipo_ensino_fundamental = 0;
    $tipo_ensino_medio = 0;
    $tipo_ensino_profissional = 0;
    $tipo_ensino_tecnico = 0;
    $tipo_ensino_superior = 0;

    if(isset($_POST['tipo_ensino_creche'])){
        $tipo_ensino_creche = 1;        
    }
    if(isset($_POST['tipo_ensino_basico'])){
        $tipo_ensino_basico = 1;        
    }
    if(isset($_POST['tipo_ensino_fundamental'])){
        $tipo_ensino_fundamental = 1;        
    }
    if(isset($_POST['tipo_ensino_medio'])){
        $tipo_ensino_medio = 1;        
    }
    if(isset($_POST['tipo_ensino_profissional'])){
        $tipo_ensino_profissional = 1;        
    }
    if(isset($_POST['tipo_ensino_tecnico'])){
        $tipo_ensino_tecnico = 1;        
    }
    if(isset($_POST['tipo_ensino_superior'])){
        $tipo_ensino_superior = 1;        
    }

    return array(
        $tipo_ensino_creche,
        $tipo_ensino_basico,
        $tipo_ensino_fundamental,
        $tipo_ensino_medio,
        $tipo_ensino_profissional,
        $tipo_ensino_tecnico,
        $tipo_ensino_superior
    );
}

function incluir_escola(){
    $arDadosEscola = array();
    $arDadosEscola = @file_get_contents("escola.json");
    if($arDadosEscola){
        $arDadosEscola = json_decode($arDadosEscola, true);
    }

    list(
        $tipo_ensino_creche,
        $tipo_ensino_basico,
        $tipo_ensino_fundamental,
        $tipo_ensino_medio,
        $tipo_ensino_profissional,
        $tipo_ensino_tecnico,
        $tipo_ensino_superior) = getTipoEnsino();

    $aDadosEscolaAtual = array();
    $aDadosEscolaAtual["codigo"] = getProximoCodigo($arDadosEscola);
    $aDadosEscolaAtual["descricao"] = $_POST["descricao"];
    $aDadosEscolaAtual["cidade"] = $_POST["cidade"];

    $aDadosEscolaAtual["tipo_ensino_creche"] = $tipo_ensino_creche;
    $aDadosEscolaAtual["tipo_ensino_basico"] = $tipo_ensino_basico;
    $aDadosEscolaAtual["tipo_ensino_fundamental"] = $tipo_ensino_fundamental;
    $aDadosEscolaAtual["tipo_ensino_medio"] = $tipo_ensino_medio;
    $aDadosEscolaAtual["tipo_ensino_profissional"] = $tipo_ensino_profissional;
    $aDadosEscolaAtual["tipo_ensino_tecnico"] = $tipo_ensino_tecnico;
    $aDadosEscolaAtual["tipo_ensino_superior"] = $tipo_ensino_superior;
    
    // Pega os dados atuais do aluno e armazena no array que foi lido
    $arDadosEscola[] = $aDadosEscolaAtual;

    // Gravar os dados no arquivo
    file_put_contents("escola.json", json_encode($arDadosEscola));
}

function getProximoCodigo($arDados){
    $ultimoCodigo = 0;
    foreach($arDados as $aDados){
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

function processaDados($pagina){
    // Verificar se esta setado o $_POST
    if(isset($_POST["ACAO"])){
        $acao = $_POST["ACAO"];
        if($acao == "INCLUIR"){
            incluir_escola();            
        } else if($acao == "ALTERAR"){        
            alterar_escola();
        }
        header('Location: consulta_' . $pagina . '.php');
    } else if(isset($_GET["ACAO"])){
        $acao = $_GET["ACAO"];
        if($acao == "EXCLUIR"){
            excluir_registro($pagina);
            header('Location: consulta_' . $pagina . '.php');
        } else if($acao == "ALTERAR"){
            $codigoAlterar = $_GET["codigo"];
            header('Location: ' . $pagina . '.php?ACAO=ALTERAR&codigo=' . $codigoAlterar);
        }
    } else {
        // Redireciona para a pagina de consulta de aluno
        header('Location: consulta_' . $pagina . '.php');
    }
}

$pagina = "escola";
processaDados($pagina);
    