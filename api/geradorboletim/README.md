# Gerador de Boletim

> Gerador de boletim baseado no modelo do Colégio Municipal Luiz Viana Filho

O Gerado obtém datados de um cvs com as notas das disciplias e gera o boletim para cada aluno de forma
automatizada, usando PHP.

## Comando para adicionar composer
composer require dompdf/dompdf

* Uso do DOMPDF
```
require 'vendor/autoload.php';
```

## Habilitar a dll de imagem
No Windows, você irá incluir a DLL do GD php_gd.dll como uma extensão no php.ini. Antes do PHP 8.0.0 a DLL se chamava php_gd2.dll.
Copiar da pasta "EXT" o arquivo php_gd.dll e colocar na raiz

Adicionar no fim do arquivo PHP.ini a extensao abaixo. 
extension=php_gd.dll





