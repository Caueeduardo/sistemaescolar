<?php

function getAcaoExcluirTurma($codigo){
    $sHTML = "<a id='acaoExcluir' href='http://localhost/sistemaescolar/api/turma/cadastrar_turma.php?ACAO=EXCLUIR&codigo=" . $codigo . "'>Excluir</a>";
    return $sHTML;
}

function getAcaoAlterarTurma($codigo){
    $sHTML = "<a id='acaoAlterar' href='http://localhost/sistemaescolar/api/turma/cadastrar_turma.php?ACAO=ALTERAR&codigo=" . $codigo . "'>Alterar</a>";
    return $sHTML;
}

require_once("../core/header.php");

echo '<h3 style="text-align:center;">CONSULTA DE TURMA</h3>';

$htmlTabelaTurmas = "<a href='turma.php'><button class='button' type='button'>Incluir<button></a>";
$htmlTabelaTurmas .= "<table border='1'>";

// HEADER DA TABLE
$htmlTabelaTurmas .= "<head>";

// TITULOS DA TABLE
$htmlTabelaTurmas .= "<tr>";
$htmlTabelaTurmas .= "  <th>Código</th>";
$htmlTabelaTurmas .= "  <th>Escola</th>";// Nome da Escola - buscar pelo codigo
$htmlTabelaTurmas .= "  <th>Nome</th>";
$htmlTabelaTurmas .= "  <th>Data Início</th>";
$htmlTabelaTurmas .= "  <th>Data Fim</th>";
$htmlTabelaTurmas .= "  <th>Status</th>";
$htmlTabelaTurmas .= "  <th>Período</th>";
$htmlTabelaTurmas .= "  <th colspan='2'>Ações</th>";
$htmlTabelaTurmas .= "</tr>";

$htmlTabelaTurmas .= "</head>";
$htmlTabelaTurmas .= "<tbody>";

$arDadosTurmas = array();

$dadosTurmas = @file_get_contents("turmas.json");
if($dadosTurmas){
    $arDadosTurmas = json_decode($dadosTurmas, true);
}

foreach($arDadosTurmas as $aDados){
    // ABRIR UMA NOVA LINHA
    $htmlTabelaTurmas .= "<tr>";
    $htmlTabelaTurmas .= "<td align='center'>" . $aDados["codigo"] . "</td>";

    $nomeEscola = "ESCOLA TESTES"; // Funcao - Buscar pelo codigo, que nem a cidade em Escola

    $htmlTabelaTurmas .= "<td>" . $nomeEscola . "</td>";

    $htmlTabelaTurmas .= "<td>" . $aDados["nome"] . "</td>";
    $htmlTabelaTurmas .= "<td>" . $aDados["datainicio"] . "</td>";
    $htmlTabelaTurmas .= "<td>" . $aDados["datafim"] . "</td>";
    $htmlTabelaTurmas .= "<td>" . $aDados["status"] . "</td>";
    $htmlTabelaTurmas .= "<td>" . $aDados["periodo"] . "</td>";

    // Adiciona a ação de excluir aluno
    $codigo = $aDados["codigo"];

    $htmlTabelaTurmas .= '<td>';
    $htmlTabelaTurmas .= getAcaoExcluirTurma($codigo);
    $htmlTabelaTurmas .= '</td>';

    $htmlTabelaTurmas .= '<td>';
    $htmlTabelaTurmas .= getAcaoAlterarTurma($codigo);
    $htmlTabelaTurmas .= '</td>';

    // FECHAR A LINHA ATUAL
    $htmlTabelaTurmas .= "</tr>";
}

$htmlTabelaTurmas .= "</tbody>";
$htmlTabelaTurmas .= "</table>";

echo $htmlTabelaTurmas;

require_once("../core/footer.php");
