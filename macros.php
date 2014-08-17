<?php

//
$recurso = $_REQUEST['recurso'];
include "parametros/parametros_$recurso.php";

// bibliotecas
# ------------------------------------------------
// BANCO DE DADOS
define("DB_DRIVER", "mysql");
define("DB_DML", "^(INSERT|UPDATE|DELETE)"); // comandos DML permitidos
define("DB_QUERY", "^(\(?SELECT|CALL|SHOW)"); // queries permitidas
define("DB_UNBUFFERED", true); // suporta resultsets "unbuffereds"?

define("DB_PAG_LIMITE", 10); // resultados por pбgina (paginaзгo de resultados)
include "database/ControleBDFactory.class.php";

// criando objetos
$obj_controle = ControleBDFactory::getControlador(DB_DRIVER);

$arquivo_inbox = $arquivo;
echo "arquivo_inbox - ".$arquivo_inbox;
$log = $recurso . '_' . @strtolower($arquivo_inbox);
if (@is_file($caminho.$arquivo_inbox)) {

 // abrindo arquivos
 $arquivo = @fopen($caminho.$arquivo_inbox, 'r');

 // lendo linha por linha do arquivo

 while ($linha = @fgets($arquivo, 4096)) {
  $linha = str_replace("$spcr$spcr","$spcr00$spcr",$linha);
  $sql = null;
  
  /* ----------------------------------------------------------------------------------------------- */
  # largada + ch
  if (@ereg('\$#LP#\$', $linha)) {
include("macros/largada_ch.php");
  /* ----------------------------------------------------------------------------------------------- */
  # somente chegada
  //#$CC$# 001 808 16:20:52:54 <--antigo
  //$C0001 ** 20:23:17,4   12
  //$C0001 ** 11:53:04,9  200
  } elseif (@ereg('[0-9]{4} \*\*', $linha)) {
  include("macros/chegada.php");
   /* ----------------------------------------------------------------------------------------------- */
  # somente chegada - modelo antigo  
  //0001 ** 11:53:04,9  200
  } elseif (@ereg('[0-9]{4} \* ', $linha)) {
 include("macros/chegada_antigo.php");
  /* ----------------------------------------------------------------------------------------------- */
  # largada + reaзгo ---> $#LR#$ 001 700 08:03:00 - 0,64
  } elseif (@ereg('\$#LR#\$', $linha)) {
 include("macros/largada_reacao.php");   
  /* ----------------------------------------------------------------------------------------------- */
  # largada 
  } elseif (@ereg('\$#LL#\$', $linha)) {
  include("macros/largada.php");
   /* ----------------------------------------------------------------------------------------------- */
   # largada cancelada 
   } elseif (@ereg('\$#LC#\$', $linha)) {
  include("macros/largada_cancelada.php");
    /* ----------------------------------------------------------------------------------------------- */
   # ch 
   } elseif (@ereg('\$#LH#\$', $linha)) {
   include("macros/ch.php");
  /* ----------------------------------------------------------------------------------------------- */
  # macro1 
  } elseif (@ereg('\$M01\$', $linha)) {
   include("macros/macro01.php");
   /* ----------------------------------------------------------------------------------------------- */
  # macro3 
  } elseif (@ereg('\$M03\$', $linha)) {
   include("macros/macro03.php");
   /* ----------------------------------------------------------------------------------------------- */
  # macro11 
  } elseif (@ereg('\$M11\$', $linha)) {
  include("macros/macro11.php"); 
    /* ----------------------------------------------------------------------------------------------- */
  # macro22 
  } elseif (@ereg('\$M22\$', $linha)) {
	include("macros/macro22.php");
  /* ----------------------------------------------------------------------------------------------- */
  # macro23 
  } elseif (@ereg('\$M23\$', $linha)) {
  include("macros/macro23.php");
  /* ----------------------------------------------------------------------------------------------- */
  # macro24
  } elseif (@ereg('\$M24\$', $linha)) {
 include("macros/macro24.php"); 
  /* ----------------------------------------------------------------------------------------------- */
  # macro31
   // $M31$-05-100-11-00-31-11-00-32-TESTE 
  } elseif (@ereg('\$M31\$', $linha)) {
 include("macros/macro31.php");
  /* ----------------------------------------------------------------------------------------------- */
  # macro6
  } elseif (@ereg('\$M06\$', $linha)) {
  include("macros/macro06.php");
  /* ----------------------------------------------------------------------------------------------- */
  # macro40 
  } elseif (@ereg('\$M40\$', $linha)) {
 include("macros/macro40.php"); 
  }

  // inserindo no banco de dados
  if (! @empty($sql)) $obj_controle->executa($sql);
 }
 // fechando os arquivos
 @fclose($arquivo);

 // gerando cуpia do arquivo INBOX.TXT
 $log = @fopen("logs/".$log, 'a+');
 @fwrite($log, @file_get_contents($caminho.$arquivo_inbox) . "\r\n");
 @fclose($log);

 // excluindo arquivo base
 @unlink($caminho.$arquivo_inbox);
}
?>