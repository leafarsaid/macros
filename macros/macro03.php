<?
   // posição inicial de leitura dos dados na linha

   $inicio = @strpos($linha, '$M03$')+5+1;
   //$inicio = $inicio -1;

   

   // lendo os dados da linha

   $dados = explode(";",$linha);

   $mct = @substr($linha, 0, 6);

   $trecho = @intval(@substr($linha, $inicio + 1, 2));

   

   $largada = @substr($linha, $inicio + 4, 2) * 3600;

   $largada += @substr($linha, $inicio + 7, 2) * 60;

   

   $comp1 = @intval(@substr($linha, $inicio + 10, 3));

   

   $cheg1 = @substr($linha, $inicio + 14, 2) * 3600;

   $cheg1 += @substr($linha, $inicio + 17, 2) * 60;

   $cheg1 += @substr($linha, $inicio + 20, 2);

   $cheg1 += @substr($linha, $inicio + 23, 1) / 10;

   

   $comp2 = @intval(@substr($linha, $inicio + 25, 3));

   

   $cheg2 = @substr($linha, $inicio + 29, 2) * 3600;

   $cheg2 += @substr($linha, $inicio + 32, 2) * 60;

   $cheg2 += @substr($linha, $inicio + 35, 2);

   $cheg2 += @substr($linha, $inicio + 38, 1) / 10;

   

   // instrução sql

   $sql1 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($largada, 'L', getTempoStatus($comp1, $trecho, 'L'), getCodigoVeiculo($comp1), $trecho, 'M03', 0, 0)";

   $sql2 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($largada, 'L', getTempoStatus($comp2, $trecho, 'L'), getCodigoVeiculo($comp2), $trecho, 'M03', 0, 0)";

   $sql3 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($cheg1, 'C', getTempoStatus($comp1, $trecho, 'C'), getCodigoVeiculo($comp1), $trecho, 'M03', 0, 0)";

   $sql4 = "INSERT INTO t01_tempos (c01_valor, c01_tipo, c01_status, c03_codigo, c02_codigo, c01_sigla, c01_conta, c01_mct) VALUES ($cheg2, 'C', getTempoStatus($comp2, $trecho, 'C'), getCodigoVeiculo($comp2), $trecho, 'M03', 0, 0)";

   

   // insere o registro no banco

   $obj_controle->executa($sql1);

   $obj_controle->executa($sql2);

   $obj_controle->executa($sql3);

   $obj_controle->executa($sql4);

   

   // escrevendo no arquivo de log

   @fwrite($arquivo_log_novo, $mct . @substr($linha, $inicio, 40) . "\r\n");

   //print_r($mct . @substr($linha, $inicio, 40));

   print_r($sql1."<br>");

   print_r($sql2."<br>");

   print_r($sql3."<br>");

   print_r($sql4."<br><br>");

            

   print_r("$mct " . @substr($linha, $inicio, -1));

     