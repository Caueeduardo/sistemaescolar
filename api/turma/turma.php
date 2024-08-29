<?php
require_once("../core/header.php");

function getComboEscola($codigoEscola = false){
    $arDadosEscolas = array();
    $dadosEscolas = @file_get_contents("../escola/escola.json");
    if($dadosEscolas){
        // transforma os dados lidos em ARRAY, que estavam em JSON
        $arDadosEscolas = json_decode($dadosEscolas, true);
    }

    $html = '<div style="display:flex;gap:5px;flex-direction:row;">';

    $html .= '  <label for="escola">Escola:</label>';
    $html .= '  <select id="escola" name="escola">';
    $html .= '    <option value="0">Selecione</option>';

    //  preencher com php - mais options de ESCOLA
    foreach($arDadosEscolas as $aDados){
        $selected = "";
        if($codigoEscola == $aDados["codigo"]){
            $selected = " selected ";                    
        }

        $html .= '<option value="'. $aDados["codigo"] .'" ' . $selected .'>' . $aDados["descricao"] . '</option>';
    }

    $html .= '</select>';
    $html .= '</div>';

    return $html;
}

function getDadosTurma($codigoTurmaAlterar){
    $codigo = "";
    $escola = "";
    $nome = "";
    $datainicio = "";
    $datafim = "";
    $status = "";
    $periodo = "";

    $dadosTurmas = @file_get_contents("turmas.json");
    $arDadosTurmas = json_decode($dadosTurmas, true);

    $encontrouTurma = false;
    foreach($arDadosTurmas as $aDados){
        $codigoAtual = $aDados["codigo"];
        if($codigoTurmaAlterar == $codigoAtual){
            $encontrouTurma = true;            
            $escola       = $aDados["escola"];
            $nome         = $aDados["nome"];
            $datainicio   = $aDados["datainicio"];
            $datafim      = $aDados["datafim"];
            $status       = $aDados["statuscurso"];
            $periodo      = $aDados["periodocurso"];
            break;
        }
    }

    return array(
        $codigoTurmaAlterar,
        $escola,
        $nome,
        $datainicio,
        $datafim,
        $status,
        $periodo, 
        $encontrouTurma
    );
}

// Verificar se existe acao
$codigoTurma = "";
$escola = "";
$nome = "";
$datainicio = "";
$datafim = "";
$status = "";
$periodo = "";

$display = "block;";
$encontrouTurma = false;
$mensagemTurmaNaoEncontrado = "";

$selected_status_curso_1 = "";
$selected_status_curso_2 = "";
$selected_status_curso_3 = "";

$selected_status_periodo_1 = "";
$selected_status_periodo_2 = "";
$selected_status_periodo_3 = "";

$codigoEscola = false;
$acaoFormulario = "INCLUIR";
if(isset($_GET["ACAO"])){
    $acao = $_GET["ACAO"];
    if($acao == "ALTERAR"){
        $acaoFormulario = "ALTERAR";

        $display = "none;";
        $codigoTurma = $_GET["codigo"];
        
        list($codigoTurma,
            $escola,
            $nome,
            $datainicio,
            $datafim,
            $status,
            $periodo, 
            $encontrouTurma) = getDadosTurma($codigoTurma);

            if($status == "ABERTO"){
                $selected_status_curso_1 = " selected ";
            }            
            if($status == "ANDAMENTO"){
                $selected_status_curso_2 = " selected ";
            }
            if($status == "CONCLUIDO"){
                $selected_status_curso_3 = " selected ";
            }

            if($periodo == "Matutino"){
                $selected_status_periodo_1 = " selected ";
            }            
            if($periodo == "Vespertino"){
                $selected_status_periodo_2 = " selected ";
            }
            if($periodo == "Noturno"){
                $selected_status_periodo_3 = " selected ";
            }

        if($encontrouTurma){
            $codigoEscola = $escola;

            // Limpa a mensagem de erro
            $mensagemTurmaNaoEncontrado = "";
        } else {
            // Adiciona o codigo do aluno no fim
            $mensagemTurmaNaoEncontrado = "Não foi encontrado nenhuma turma para o codigo informado!Código: ";
            $mensagemTurmaNaoEncontrado .= $codigo;
        }
    }
}

$sHTML = '<div><link rel="stylesheet" href="../css/formulario.css">';

$comboEscola = getComboEscola($codigoEscola);

// FORMULARIO DE CADASTRO DE TURMAS
$sHTML .= '<h2 style="text-align:center;">Formulário de Turma</h2>
    <h3>' . $mensagemTurmaNaoEncontrado . '</h3>
    <form action="cadastrar_turma.php" method="POST">
        <input type="hidden" id="ACAO" name="ACAO" value="' . $acaoFormulario . '">

        <label for="codigo">Código:</label>
        <input type="hidden" id="codigo" name="codigo" value="' . $codigoTurma . '" required>
        <input type="text" id="codigoTela" name="codigoTela" value="' . $codigoTurma . '" disabled>
        
        ' . $comboEscola . '
        
        <br>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required value="' . $nome . '">

        <div style="display:flex;justify-content:space-between;">
            <div style="display:flex;flex-direction:column;">
                <label for="datainicio">Data Início:</label>
                <input type="date" id="datainicio" name="datainicio" required value="' . $datainicio . '">
            </div>
            <div style="display:flex;flex-direction:column;">
                <label for="datafim">Data Fim:</label>
                <input type="date" id="datafim" name="datafim" required value="' . $datafim . '">
            </div>
        </div>
        <br>
        <div style="display:flex;flex-direction:row;justify-content:space-between;">
            <div style="display:flex;flex-direction:column;">
                <label for="statuscurso">Status da Turma:</label>
                <select id="statuscurso" name="statuscurso">
                    <option value="ABERTO" ' . $selected_status_curso_1 . '>ABERTO</option>
                    <option value="ANDAMENTO" ' . $selected_status_curso_2 . '>ANDAMENTO</option>
                    <option value="CONCLUIDO" ' . $selected_status_curso_3 . '>CONCLUIDO</option>
                </select>
            </div>

            <div style="display:flex;flex-direction:column;">
                <label for="periodocurso">Período:</label>
                <select id="periodocurso" name="periodocurso">
                    <option value="Matutino" ' . $selected_status_periodo_1 . '>Matutino</option>
                    <option value="Vespertino" ' . $selected_status_periodo_2 . '>Vespertino</option>
                    <option value="Noturno" ' . $selected_status_periodo_3 . '>Noturno</option>
                </select>
            </div>
        </div>
        <br>
        <input type="submit" value="Enviar">
    </form>';

// CONSULTA DE ALUNOS
$sHTML .= '</div>';

echo $sHTML;

require_once("../core/footer.php");
