# Cadastros a serem criados

## Tela inicial - Sou Professor ou Sou Aluno
* Ao clicar em "Sou Professor", deve ir para a pasta professor
* Ao clicar em "Sou Aluno", deve ir para a pasta aluno
## Aluno - ok
  * Colunas
    * codigo
    * nome 
    * email
    * senha
## Professor - fazendo... - 21-08-2024
  * Colunas
     * codigo
     * nome 
     * email
     * senha

## Cadastro de Escola, Universidade, etc
### Escolas: SENAC, SENAI, 
### Escolas: IFC, UDESC, UNIDAVI, IMA, DOM BOSCO, SESI, UNINTER
   * Colunas
     * codigo
     * descrição 
     * cidade - combobox de cidade com as cidades abaixo
       * 1 - Rio do Sul 
       * 2 - Ibirama
       * 3 - Ituporanga
       * 4 - Joinville
       * 5 - Florianópolis
       * 6 - Blumenau
     * Tipo Ensino - checkbox
       * 1 - Creche
       * 2 - Ensino Básico
       * 3 - Ensino Fundamental
       * 4 - Ensino Médio
       * 5 - Ensino Profissionalizante
       * 6 - Ensino Técnico
       * 7 - Ensino Superior
     
## Cadastro de Turmas(Curso):
* Colunas
  * codigo da turma
  * codigo da Escola - COMBOBOX - DEVE LISTAR UMA LISTA DE SELECT DE ESCOLA
  * nome do curso/ OU ano da escola...- Exemplo 2 Série - A
  * data inicio do curso
  * data fim do curso
  * status do curso - INICIADO, ANDAMENTO, CONCLUIDO
  * Período - Matutino/Vespertino/Noturno

* Exemplo de Escolas/Universidades
* Senac
  * Jovem Programador
  * Marketing e Vendas
* UNIDAVI
  * Sistemas de Informação
* IFC
  * Física
  * Ciência da Computação
* UDESC
  * Engenharia de Software
* UNINTER    
  * Analise e Desenvolvimento de Sistemas

## Materia
* Colunas 
  * codigo
  * descricao
  * Curso - código do curso - COMBOBOX

## Avaliacao
* Colunas 
  * codigo
  * descricao
  * data
  * codigo da materia - combobox de materias
  * status - ABERTO/ANDAMENTO/CONCLUIDO

## Boletim Escolar
* Escola-Fundamental e Medio - Bimestre
* Escola Superior - Semestre

* Superior
* Matéria 1º Semestre 2ºSemestre

#### 1.6. Módulo de Turmas/Cursos - Fazer na sala
- **Associação de Alunos às Turmas**: O sistema deve permitir associar alunos às turmas.
- **Associação de Professores às Turmas**: O sistema deve permitir associar professores às turmas.
- **Associação de Alunos aos Cursos**: O sistema deve permitir associar professores às turmas.

# NOTAS DOS ALUNOS
* Formulario de Notas
* codigo do aluno 
   * COMBOBOX DE ALUNO - LISTAR DO ARQUIVO DE NOME "ALUNOS.JSON"
* Código da Materia
   * COMBOBOX DE MATERIA - LISTAR DO ARQUIVO DE NOME "MATERIAS.JSON"
* Código da Avaliação
   * COMBOBOX DE AVALIACAO - LISTAR DO ARQUIVO DE NOME "avaliacao.JSON"
* Deve gerar o arquivo de nome "NOTAS.JSON"
* Notas - nota entre 1 e 10 - INFORMAR NA TELA.

  | Aluno      | Avaliação               | Nota| 
  |------------|-------------------------|-----|                   
  | Romulo     | 1 - Prova de Matematica | 8.5 |
  | Adriano    | 1 - Prova de Matematica | 8.5 |
  | Cauê       | 1 - Prova de Matematica | 8.5 |
  | Vinícius   | 1 - Prova de Matematica | 8.5 |
  | Bruna      | 1 - Prova de Matematica | 8.5 |
  | Helton     | 1 - Prova de Matematica | 8.5 |
  | Ryan       | 1 - Prova de Matematica | 8.5 |


  | Aluno      | Avaliação               | Nota| 
  |------------|-------------------------|-----|                   
  | Romulo     | 2 - Prova de Matematica | 6.5 |
  | Adriano    | 2 - Prova de Matematica | 6.5 |
  | Cauê       | 2 - Prova de Matematica | 6.5 |
  | Vinícius   | 2 - Prova de Matematica | 6.5 |
  | Bruna      | 2 - Prova de Matematica | 6.5 |
  | Helton     | 2 - Prova de Matematica | 6.5 |
  | Ryan       | 2 - Prova de Matematica | 6.5 |


  | Aluno      | Avaliação               | Nota| 
  |------------|-------------------------|-----|                   
  | Romulo     | 3 - Prova de Matematica | 7.5 |
  | Adriano    | 3 - Prova de Matematica | 7.5 |
  | Cauê       | 3 - Prova de Matematica | 7.5 |
  | Vinícius   | 3 - Prova de Matematica | 7.5 |
  | Bruna      | 3 - Prova de Matematica | 7.5 |
  | Helton     | 3 - Prova de Matematica | 7.5 |
  | Ryan       | 3 - Prova de Matematica | 7.5 |


## Media Calcular no PHP
* MEDIA = SOMA DAS 3 NOTAS DIVIDIDO POR 3.

# AVALIAR PRA INTEGRAR BOLETIM COM AS NOTAS - PROFESSOR
* Arquivo "notas.json"










