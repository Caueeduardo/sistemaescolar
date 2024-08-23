<?php
/**
 * Created by PhpStorm.
 * User: gelva
 * Date: 22/08/2024
 * Time: 11:37
 */
header("Content-Type: text/html; charset=UTF-8");

use Dompdf\Dompdf;
require_once 'vendor/autoload.php';

$html = file_get_contents("boletim_gerado_atual.html");

$ano = "2024";
$turma = "JOVEM_PROGRAMADOR";
$folder = "Boletins_PDF";

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

// (Opcional) Configurando o tamanho do papel e orientação
$dompdf->setPaper('A4', 'landscape');

// Renderizando o HTML como PDF
$dompdf->render();

// Caminho + nome do arquivo
$file_to_save = $path . "/" . $folder . "" . $name;
$dompdf->set_base_path('localhost/Gerador-Boletim/style.css');

// Criando a saida do PDF gerado para o Navegador
$output = $dompdf->output();

$name = "Boletim_" . $ano . "" . $turma;

// Caminho + nome do arquivo
$file_to_save = $path . "/" . $folder . "" . $name . '.pdf';

// Salvando o PDF no servidor
file_put_contents($file_to_save, $dompdf->output());

// Print the pdf file to the screen for saving
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $turma . "_" . $turno . '.pdf"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file_to_save));
header('Accept-Ranges: bytes');

readfile($file_to_save);
