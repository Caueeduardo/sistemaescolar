<?php
function alterar_aluno(){
    $codigoAlunoAlterar = $_POST["codigo"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    
    $dadosAlunos = @file_get_contents("alunos.json");
    $arDadosAlunos = json_decode($dadosAlunos, true);

    $arDadosAlunosNovo = array();
    foreach($arDadosAlunos as $aDados){
        $codigoAtual = $aDados["codigo"];

        if($codigoAlunoAlterar == $codigoAtual){
            $aDados["nome"] = $nome;
            $aDados["email"] = $email;
        }

        $arDadosAlunosNovo[] = $aDados;
    }

    // Gravar os dados no arquivo
    file_put_contents("alunos.json", json_encode($arDadosAlunosNovo));
}

function excluir_aluno(){
    $codigoAlunoExcluir = $_GET["codigo"];

    $dadosAlunos = @file_get_contents("alunos.json");
    $arDadosAlunos = json_decode($dadosAlunos, true);

    $arDadosAlunosNovo = array();
    foreach($arDadosAlunos as $aDados){
        $codigoAtual = $aDados["codigo"];

        if($codigoAlunoExcluir == $codigoAtual){
            // ignora e vai para o proximo registro
            continue;
        }

        $arDadosAlunosNovo[] = $aDados;
    }

    // Gravar os dados no arquivo
    file_put_contents("alunos.json", json_encode($arDadosAlunosNovo));
}

function incluir_escola(){
    $arDadosAlunos = array();

    // Primeiro, verifica se existe dados no arquivo json
    // @ na frente do metodo, remove o warning
    $dadosAlunos = @file_get_contents("alunos.json");
    if($dadosAlunos){
        // transforma os dados lidos em ARRAY, que estavam em JSON
        $arDadosAlunos = json_decode($dadosAlunos, true);
    }

    // Armazenar os dados do aluno atual, num array associativo

    // DADOS DE ENSINO - INCLUIR/ALTERAR ESCOLA
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



    $aDadosAlunoAtual = array();
    $aDadosAlunoAtual["codigo"] = getProximoCodigo($arDadosAlunos);
    $aDadosAlunoAtual["nome"] = $_POST["nome"];
    $aDadosAlunoAtual["email"] = $_POST["email"];
    $aDadosAlunoAtual["senha"] = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    // Pega os dados atuais do aluno e armazena no array que foi lido
    $arDadosAlunos[] = $aDadosAlunoAtual;

    // Gravar os dados no arquivo
    file_put_contents("alunos.json", json_encode($arDadosAlunos));
}

function getProximoCodigo($arDadosAlunos){
    $ultimoCodigo = 0;
    foreach($arDadosAlunos as $aDados){
        $codigoAtual = $aDados["codigo"];

        if($codigoAtual > $ultimoCodigo){
            $ultimoCodigo = $codigoAtual;
        }      
    }

    return $ultimoCodigo + 1;
}

// PROCESSAMENTO DA PAGINA
echo "<pre>" . print_r($_POST, true) . "</pre>";return true;
// echo "<pre>" . print_r($_GET, true) . "</pre>";return true;

function processaDados($pagina){
    // Verificar se esta setado o $_POST
    if(isset($_POST["ACAO"])){
        $acao = $_POST["ACAO"];
        if($acao == "INCLUIR"){
            incluir_escola();

            // Redireciona para a pagina de consulta de aluno
            header('Location: consulta_aluno.php');
        } else if($acao == "ALTERAR"){        
            alterar_aluno();

            // Redireciona para a pagina de consulta de aluno
            header('Location: consulta_' . $pagina . '.php');
        }
    } else if(isset($_GET["ACAO"])){
        $acao = $_GET["ACAO"];
        if($acao == "EXCLUIR"){
            excluir_aluno();
            
            // Redireciona para a pagina de consulta de aluno
            header('Location: consulta_aluno.php');
        } else if($acao == "ALTERAR"){
            $codigoAlunoAlterar = $_GET["codigo"];

            // Redireciona para a pagina de aluno
            header('Location: aluno.php?ACAO=ALTERAR&codigo=' . $codigoAlunoAlterar);
        }
    } else {
        // Redireciona para a pagina de consulta de aluno
        header('Location: consulta_aluno.php');
    }
}

$pagina = "aluno";
processaDados($pagina);
    