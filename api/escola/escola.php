<?php
require_once("../core/header.php");

function getDadosEscola($codigoAlterar){
    $descricao = "";
    $cidade = "";

    $dados = @file_get_contents("escola.json");

    // TRANSFORMAR EM ARRAY
    $arDados = json_decode($dados, true);

    $tipo_ensino_creche="";
    $tipo_ensino_basico = "";
    $tipo_ensino_fundamental = "";    
    $tipo_ensino_medio = "";
    $tipo_ensino_profissional = "";
    $tipo_ensino_tecnico = "";
    $tipo_ensino_superior = "";

    $encontrouEscola = false;
    foreach($arDados as $aDados){
        $codigoAtual = $aDados["codigo"];
        if($codigoAlterar == $codigoAtual){
            $encontrouEscola = true;
            $descricao = $aDados["descricao"];
            $cidade = $aDados["cidade"];
            
            if($aDados["tipo_ensino_creche"] == 1){
                $tipo_ensino_creche = " checked ";
            }
            if($aDados["tipo_ensino_basico"] == 1){
                $tipo_ensino_basico = " checked ";
            }
            if($aDados["tipo_ensino_fundamental"] == 1){
                $tipo_ensino_fundamental = " checked ";
            }
            if($aDados["tipo_ensino_medio"] == 1){
                $tipo_ensino_medio = " checked ";
            }
            if($aDados["tipo_ensino_profissional"] == 1){
                $tipo_ensino_profissional = " checked ";
            }
            if($aDados["tipo_ensino_tecnico"] == 1){
                $tipo_ensino_tecnico = " checked ";
            }
            if($aDados["tipo_ensino_superior"] == 1){
                $tipo_ensino_superior = " checked ";
            }

            // para a execução do loop
            break;
        }
    }

    return array(
        $descricao,
        $cidade,
        $tipo_ensino_creche,
        $tipo_ensino_basico,
        $tipo_ensino_fundamental,
        $tipo_ensino_medio,
        $tipo_ensino_profissional,
        $tipo_ensino_tecnico,
        $tipo_ensino_superior,
        $encontrouEscola
    );
}

// Verificar se existe acao
$codigo = "";
$descricao = "";
$cidade = "";

// TIPOS DE ENSINO 
$tipo_ensino_creche = "";
$tipo_ensino_basico = "";
$tipo_ensino_fundamental = "";
$tipo_ensino_medio = "";
$tipo_ensino_profissional = "";
$tipo_ensino_tecnico = "";
$tipo_ensino_superior = "";

// CIDADES
$selected_1 = "";
$selected_2 = "";
$selected_3 = "";
$selected_4 = "";
$selected_5 = "";
$selected_6 = "";

$encontrouEscola = false;
$mensagemEscolaNaoEncontrada = "Não foi encontrado nenhuma escola para o codigo informado!Código: ";

$acaoFormulario = "INCLUIR";
if(isset($_GET["ACAO"])){
    $acao = $_GET["ACAO"];
    if($acao == "ALTERAR"){
        $acaoFormulario = "ALTERAR";

        $display = "none;";
        $codigo = $_GET["codigo"];
        list(
            $descricao,
            $cidade,

            $tipo_ensino_creche,
            $tipo_ensino_basico,
            $tipo_ensino_fundamental,
            $tipo_ensino_medio,
            $tipo_ensino_profissional,
            $tipo_ensino_tecnico,
            $tipo_ensino_superior,
            $encontrouEscola) = getDadosEscola($codigo);

        switch($cidade){
            case 1:
                $selected_1 = " selected ";
                break;
            case 2:
                $selected_2 = " selected ";
                break;
            case 3:
                $selected_3 = " selected ";
                break;
            case 4:
                $selected_4 = " selected ";
                break;
            case 5:
                $selected_5 = " selected ";
                break;
            case 6:
                $selected_6 = " selected ";
                break;
        }


        if($encontrouEscola){
            // Limpa a mensagem de erro
            $mensagemEscolaNaoEncontrada = "";
        } else {
            // Adiciona o codigo da escola no fim
            $mensagemEscolaNaoEncontrada .= $codigoEscola;
        }
    }
}

$sHTML = '<div> <link rel="stylesheet" href="../css/formulario.css">';
$sHTML .= '
<script>
    function pesquisaCep(){
        const cep = document.querySelector("#cep").value;
        const method = "GET";
        const rota = "https://brasilapi.com.br/api/cep/v1/" + cep;
        callApi(method, rota, function (data) {
            console.log(data);
        });
    }
</script>';

// FORMULARIO DE CADASTRO DE ALUNOS
$sHTML .= '<h2 style="text-align:center;">Formulário de Escola</h2>
    <h3>' . $mensagemEscolaNaoEncontrada . '</h3>
    <form action="cadastrar_escola.php" method="POST">
        <input type="hidden" id="ACAO" name="ACAO" value="' . $acaoFormulario . '">

        <label for="codigo">Código:</label>
        <input type="hidden" id="codigo" name="codigo" value="' . $codigo . '" required>
        <input type="text" id="codigoTela" name="codigoTela" value="' . $codigo . '" disabled>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required value="' . $descricao . '">
        
        <div style="display:none;"> <!--USAR DISPLAY BLOCK PARA MOSTRAR -->       
            <button onclick="pesquisaCep()">Pesquisar CEP</button>
            <input type="text" id="cep">
        </div>

        <label for="cidade">Cidade:</label>
        <select id="cidade" name="cidade">
            <option value="1" ' . $selected_1 . '>Rio do Sul</option>
            <option value="2" ' . $selected_2 . '>Ibirama</option>
            <option value="3" ' . $selected_3 . '>Ituporanga</option>
            <option value="4" ' . $selected_4 . '>Joinvile</option>
            <option value="5" ' . $selected_5 . '>Florianópolis</option>
            <option value="6" ' . $selected_6 . '>Blumenau</option>
        </select> 
        <br>      
        <br>      
        
        <label for="">Tipo Ensino:</label>
        
        <div style="display:flex;width:85%;flex-wrap:wrap;">
            <label for="tipo_ensino_creche">Creche:</label>
            <input type="checkbox" id="tipo_ensino_creche" name="tipo_ensino_creche" ' . $tipo_ensino_creche . '>
            
            <label for="tipo_ensino_basico">Básico:</label>
            <input type="checkbox" id="tipo_ensino_basico" name="tipo_ensino_basico" ' . $tipo_ensino_basico . '>
            
            <label for="tipo_ensino_fundamental">Fundamental:</label>
            <input type="checkbox" id="tipo_ensino_fundamental" name="tipo_ensino_fundamental" ' . $tipo_ensino_fundamental . '>
                        
            <label for="tipo_ensino_medio">Médio:</label>
            <input type="checkbox" id="tipo_ensino_medio" name="tipo_ensino_medio" ' . $tipo_ensino_medio . '>
            
            <label for="tipo_ensino_profissional">Profissional:</label>
            <input type="checkbox" id="tipo_ensino_profissional" name="tipo_ensino_profissional" ' . $tipo_ensino_profissional . '>
            
            <label for="tipo_ensino_tecnico">Técnico:</label>
            <input type="checkbox" id="tipo_ensino_tecnico" name="tipo_ensino_tecnico" ' . $tipo_ensino_tecnico . '>

            <label for="tipo_ensino_superior">Superior:</label>
            <input type="checkbox" id="tipo_ensino_superior" name="tipo_ensino_superior" ' . $tipo_ensino_superior . '>
        <div>

        <br>      
        <br> 

        <input type="submit" value="Enviar">
    </form>';

$sHTML .= '</div>';

echo $sHTML;

require_once("../core/footer.php");
