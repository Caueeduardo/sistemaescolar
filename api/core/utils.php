<?php

function processaDadosUtil($pagina){
    // Verificar se esta setado o $_POST
    if(isset($_POST["ACAO"])){
        $acao = $_POST["ACAO"];
        if($acao == "INCLUIR"){
            incluir_escola();// PRECISA DE ORIENTACAO OBJETOS!!!

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

function formataData($data){
    return implode('/', array_reverse(explode('-', $data)));

    echo 'DATA ATUAL: <br>' . $data;
    // // // CHAMA A FUNCAO JAVASCRIPT
    // // echo "<script>
    // //         alert(converteData('2024-08-28'));
    // //       </script>";
    // // return 1;

    // Para formato Brasileiro
    $dataArray = explode('-', $data);

    echo 'DATA ARRAY - 01: ' . json_encode($dataArray);
    echo 'DATA ARRAY - 02 - reverse: ' . json_encode(array_reverse($dataArray));

    
    $data_array_reverse = array_reverse($dataArray);

    $dataFinal = implode('/', $data_array_reverse);
    
    echo 'DATA FINAL: ' . $dataFinal;

    $dataNova = implode('/', array_reverse(explode('-', $data)));

    // E Passando do formato brasileiro para formato americano:
    // implode('-', array_reverse(explode('/', $data)));

    return $dataFinal;
}
