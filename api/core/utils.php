<?php

function processaDadosUtil($pagina){
    // Verificar se esta setado o $_POST
    if(isset($_POST["ACAO"])){
        $acao = $_POST["ACAO"];
        if($acao == "INCLUIR"){
            incluir_escola();/// PRECISA DE ORIENTACAO OBJETOS!!!

            // Redireciona para a pagina de consulta
            header('Location: consulta_' . $pagina . '.php');
        } else if($acao == "ALTERAR"){        
            alterar_aluno();

            // Redireciona para a pagina de consulta
            header('Location: consulta_' . $pagina . '.php');
        }
    } else if(isset($_GET["ACAO"])){
        $acao = $_GET["ACAO"];
        if($acao == "EXCLUIR"){
            excluir_aluno();
            
            // Redireciona para a pagina de consulta
            header('Location: consulta_' . $pagina . '.php');
        } else if($acao == "ALTERAR"){
            $codigoAlterar = $_GET["codigo"];

            // Redireciona para a pagina
            header('Location: ' . $pagina . '.php?ACAO=ALTERAR&codigo=' . $codigoAlterar);
        }
    } else {
        // Redireciona para a pagina de consulta
        header('Location: consulta_' . $pagina . '.php');
    }
}
